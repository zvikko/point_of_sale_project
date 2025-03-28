/**
 * @author Tres Finocchiaro
 *
 * Copyright (C) 2013 Tres Finocchiaro, QZ Industries
 *
 * IMPORTANT: This software is dual-licensed
 *
 * LGPL 2.1 This is free software. This software and source code are released
 * under the "LGPL 2.1 License". A copy of this license should be distributed
 * with this software. http://www.gnu.org/licenses/lgpl-2.1.html
 *
 * QZ INDUSTRIES SOURCE CODE LICENSE This software and source code *may* instead
 * be distributed under the "QZ Industries Source Code License", available by
 * request ONLY. If source code for this project is to be made proprietary for
 * an individual and/or a commercial entity, written permission via a copy of
 * the "QZ Industries Source Code License" must be obtained first. If you've
 * obtained a copy of the proprietary license, the terms and conditions of the
 * license apply only to the licensee identified in the agreement. Only THEN may
 * the LGPL 2.1 license be voided.
 *
 */

package qz.common;

import org.eclipse.jetty.server.Connector;
import org.eclipse.jetty.server.Server;
import org.eclipse.jetty.server.ServerConnector;
import org.eclipse.jetty.websocket.client.WebSocketClient;
import org.jdesktop.swinghelper.tray.JXTrayIcon;
import qz.auth.Certificate;
import qz.deploy.DeployUtilities;
import qz.deploy.WindowsDeploy;
import qz.ui.*;
import qz.deploy.LinuxCertificate;
import qz.ui.tray.ClassicTrayIcon;
import qz.ui.tray.ModernTrayIcon;
import qz.utils.FileUtilities;
import qz.utils.MacUtilities;
import qz.utils.SystemUtilities;
import qz.utils.UbuntuUtilities;
import qz.utils.ShellUtilities;
import qz.ws.PrintSocket;
import qz.ws.SingleInstanceChecker;

import javax.swing.*;
import java.awt.*;
import java.awt.event.*;
import java.io.File;
import java.io.IOException;
import java.util.Date;
import java.util.concurrent.atomic.AtomicBoolean;
import java.util.concurrent.atomic.AtomicInteger;
import java.util.logging.*;

/**
 * Manages the icons and actions associated with the TrayIcon
 *
 * @author Tres Finocchiaro
 */
public class TrayManager {
    // The cached icons
    private final IconCache iconCache;

    JXTrayIcon tray;

    private ConfirmDialog confirmDialog;
    private GatewayDialog gatewayDialog;
    private AboutDialog aboutDialog;
    private LogDialog logDialog;
    private SiteManagerDialog sitesDialog;

    // Need a class reference to this so we can set it from the request dialog window
    private JCheckBoxMenuItem anonymousItem;

    // Dedicated log handler for web socket activity
    private final Logger trayLogger;
    private FileHandler logHandler;

    // The name this UI component will use, i.e "QZ Print 1.9.0"
    private final String name;

    // The shortcut and startup helper
    private final DeployUtilities shortcutCreator;

    private final PropertyHelper prefs;
    private String notificationsKey = "tray.notifications";

    // Action to run when reload is triggered
    private Thread reloadThread;

    /**
     * Create a AutoHideJSystemTray with the specified name/text
     */
    public TrayManager() {
        name = Constants.ABOUT_TITLE + " " + Constants.VERSION;

        // Setup the web socket log file writer
        trayLogger = Logger.getLogger(TrayManager.class.getName());
        addLogHandler(trayLogger);

        prefs = new PropertyHelper(SystemUtilities.getDataDirectory() + File.separator + Constants.PREFS_FILE + ".properties");

        // Setup the shortcut name so that the UI components can use it
        shortcutCreator = DeployUtilities.getSystemShortcutCreator();
        shortcutCreator.setShortcutName(Constants.ABOUT_TITLE);

        SystemUtilities.setSystemLookAndFeel();

        if (SystemTray.isSupported()) {
            // Accommodate some OS-specific tray bugs
            Image blank = new ImageIcon(new byte[1]).getImage();
            if (SystemUtilities.isWindows()) {
                tray = new JXTrayIcon(blank);
            } else if (SystemUtilities.isMac()) {
                tray = new ClassicTrayIcon(blank);
            } else {
                tray = new ModernTrayIcon(blank);
            }

            // Iterates over all images denoted by IconCache.getTypes() and caches them
            iconCache = new IconCache(tray.getSize());
            tray.setImage(iconCache.getImage(IconCache.Icon.DANGER_ICON));
            tray.setToolTip(name);

            try {
                SystemTray.getSystemTray().add(tray);
            } catch (AWTException awt) {
                trayLogger.log(Level.SEVERE, "Could not attach tray", awt);
            }
        } else {
            iconCache = new IconCache();
        }

        // OS-specific tasks
        if (SystemUtilities.isLinux()) {
            // Fix the tray icon to look proper on Ubuntu
            UbuntuUtilities.fixTrayIcons(iconCache);
            // Install cert into user's nssdb for Chrome, etc
            LinuxCertificate.installCertificate();
        } else if (SystemUtilities.isWindows()) {
            // Configure IE intranet zone via registry to allow websockets
            WindowsDeploy.configureIntranetZone();
            WindowsDeploy.configureEdgeLoopback();
        }

        // The allow/block dialog
        gatewayDialog = new GatewayDialog(null, "Action Required", iconCache);

        // The ok/cancel dialog
        confirmDialog = new ConfirmDialog(null, "Please Confirm", iconCache);

        addMenuItems();
    }

    /**
     * Stand-alone invocation of TrayManager
     *
     * @param args arguments to pass to main
     */
    public static void main(String args[]) {
        SwingUtilities.invokeLater(new Runnable() {
            @Override
            public void run() {
                new TrayManager();
            }
        });
    }

    /**
     * Builds the swing pop-up menu with the specified items
     */
    private void addMenuItems() {
        JPopupMenu popup = new JPopupMenu();

        JMenu advancedMenu = new JMenu("Advanced");
        advancedMenu.setMnemonic(KeyEvent.VK_A);
        advancedMenu.setIcon(iconCache.getIcon(IconCache.Icon.SETTINGS_ICON));

        JMenuItem sitesItem = new JMenuItem("Site Manager...", iconCache.getIcon(IconCache.Icon.SAVED_ICON));
        sitesItem.setMnemonic(KeyEvent.VK_M);
        sitesItem.addActionListener(savedListener);
        sitesDialog = new SiteManagerDialog(sitesItem, iconCache);

        anonymousItem = new JCheckBoxMenuItem("Block Anonymous Requests");
        anonymousItem.setToolTipText("Blocks all requests that do no contain a valid certificate/signature");
        anonymousItem.setMnemonic(KeyEvent.VK_K);
        anonymousItem.setState(PrintSocket.UNSIGNED.isBlocked());
        anonymousItem.addActionListener(anonymousListener);

        JMenuItem logItem = new JMenuItem("View Logs...", iconCache.getIcon(IconCache.Icon.LOG_ICON));
        logItem.setMnemonic(KeyEvent.VK_L);
        logItem.addActionListener(logListener);
        logDialog = new LogDialog(logItem, iconCache);

        JCheckBoxMenuItem notificationsItem = new JCheckBoxMenuItem("Show all notifications");
        notificationsItem.setToolTipText("Shows all connect/disconnect messages, useful for debugging purposes");
        notificationsItem.setMnemonic(KeyEvent.VK_S);
        notificationsItem.setState(prefs.getBoolean(notificationsKey, false));
        notificationsItem.addActionListener(notificationsListener);

        JMenuItem openItem = new JMenuItem("Open file location", iconCache.getIcon(IconCache.Icon.FOLDER_ICON));
        openItem.setMnemonic(KeyEvent.VK_O);
        openItem.addActionListener(openListener);

        JMenuItem desktopItem = new JMenuItem("Create Desktop shortcut", iconCache.getIcon(IconCache.Icon.DESKTOP_ICON));
        desktopItem.setMnemonic(KeyEvent.VK_D);
        desktopItem.addActionListener(desktopListener);

        advancedMenu.add(sitesItem);
        advancedMenu.add(anonymousItem);
        advancedMenu.add(logItem);
        advancedMenu.add(notificationsItem);
        advancedMenu.add(new JSeparator());
        advancedMenu.add(openItem);
        advancedMenu.add(desktopItem);


        JMenuItem reloadItem = new JMenuItem("Reload", iconCache.getIcon(IconCache.Icon.RELOAD_ICON));
        reloadItem.setMnemonic(KeyEvent.VK_R);
        reloadItem.addActionListener(reloadListener);

        JMenuItem aboutItem = new JMenuItem("About...", iconCache.getIcon(IconCache.Icon.ABOUT_ICON));
        aboutItem.setMnemonic(KeyEvent.VK_B);
        aboutItem.addActionListener(aboutListener);
        aboutDialog = new AboutDialog(aboutItem, iconCache, name);
        aboutDialog.addPanelButton(sitesItem);
        aboutDialog.addPanelButton(logItem);
        aboutDialog.addPanelButton(openItem);

        if (SystemUtilities.isMac()) {
            MacUtilities.registerAboutDialog(aboutDialog);
            MacUtilities.registerQuitHandler(this);
        }

        JSeparator separator = new JSeparator();

        JCheckBoxMenuItem startupItem = new JCheckBoxMenuItem("Automatically start");
        startupItem.setMnemonic(KeyEvent.VK_S);
        startupItem.setState(shortcutCreator.hasStartupShortcut());
        startupItem.addActionListener(startupListener);

        JMenuItem exitItem = new JMenuItem("Exit", iconCache.getIcon(IconCache.Icon.EXIT_ICON));
        exitItem.addActionListener(exitListener);

        popup.add(advancedMenu);
        popup.add(reloadItem);
        popup.add(aboutItem);
        popup.add(startupItem);
        popup.add(separator);
        popup.add(exitItem);

        tray.setJPopupMenu(popup);
    }


    private final ActionListener notificationsListener = new ActionListener() {
        @Override
        public void actionPerformed(ActionEvent e) {
            JCheckBoxMenuItem j = (JCheckBoxMenuItem)e.getSource();
            prefs.setProperty(notificationsKey, j.getState());
        }
    };

    private final ActionListener openListener = new ActionListener() {
        public void actionPerformed(ActionEvent e) {
            try {
                // To get Macs to open the package's contents rather than launching it, we -R the package's auth folder to
                // select it in finder. Thus we are opening auth's parent folder rather than the package.
                if (SystemUtilities.isMac()) {
                    ShellUtilities.execute(new String[] {"open", "-R", shortcutCreator.getJarPath()});
                } else {
                    Desktop d = Desktop.getDesktop();
                    d.open(new File(shortcutCreator.getParentDirectory()));
                }
            }
            catch(Exception ex) {
                if (SystemUtilities.isLinux() && ShellUtilities.execute(new String[] {"xdg-open", shortcutCreator.getParentDirectory()})) {
                    // Do nothing
                } else {
                    showErrorDialog("Sorry, unable to open the file browser: " + ex.getLocalizedMessage());
                }
            }
        }
    };

    private final ActionListener desktopListener = new ActionListener() {
        public void actionPerformed(ActionEvent e) {
            shortcutToggle(e, DeployUtilities.ToggleType.DESKTOP);
        }
    };

    private final ActionListener savedListener = new ActionListener() {
        public void actionPerformed(ActionEvent e) {
            sitesDialog.setVisible(true);
        }
    };

    private final ActionListener anonymousListener = new ActionListener() {
        @Override
        public void actionPerformed(ActionEvent e) {
            boolean checkBoxState = true;
            if (e.getSource() instanceof JCheckBoxMenuItem) {
                checkBoxState = ((JCheckBoxMenuItem)e.getSource()).getState();
            }

            System.out.println("Block unsigned: " + checkBoxState);

            if (checkBoxState) {
                blackList(PrintSocket.UNSIGNED);
            } else {
                FileUtilities.deleteFromFile(Constants.BLOCK_FILE, PrintSocket.UNSIGNED.data());
            }
        }
    };

    private final ActionListener logListener = new ActionListener() {
        @Override
        public void actionPerformed(ActionEvent e) {
            logDialog.setVisible(true);
        }
    };

    private final ActionListener startupListener = new ActionListener() {
        public void actionPerformed(ActionEvent e) {
            shortcutToggle(e, DeployUtilities.ToggleType.STARTUP);
        }
    };

    /**
     * Sets the default reload action (in this case, <code>Thread.start()</code>) to be fired
     *
     * @param reloadThread The Thread to call when reload is clicked
     */
    public void setReloadThread(Thread reloadThread) {
        this.reloadThread = reloadThread;
    }

    private ActionListener reloadListener = new ActionListener() {
        public void actionPerformed(ActionEvent e) {
            if (reloadThread == null) {
                showErrorDialog("Sorry, Reload has not yet been implemented.");
            } else {
                reloadThread.start();
            }
        }
    };

    private final ActionListener aboutListener = new ActionListener() {
        public void actionPerformed(ActionEvent e) {
            aboutDialog.setVisible(true);
        }
    };

    private final ActionListener exitListener = new ActionListener() {
        public void actionPerformed(ActionEvent e) {
            boolean showAllNotifications = prefs.getBoolean(notificationsKey, false);
            if (!showAllNotifications || confirmDialog.prompt("Exit " + name + "?")) { exit(0); }
        }
    };

    public void exit(int returnCode) {
        for (Handler h : trayLogger.getHandlers()) {
            trayLogger.removeHandler(h);
        }
        prefs.save();
        System.exit(returnCode);
    }

    /**
     * Process toggle/checkbox events as they relate to creating shortcuts
     *
     * @param e          The ActionEvent passed in from an ActionListener
     * @param toggleType Either ShortcutUtilities.TOGGLE_TYPE_STARTUP or
     *                   ShortcutUtilities.TOGGLE_TYPE_DESKTOP
     */
    private void shortcutToggle(ActionEvent e, DeployUtilities.ToggleType toggleType) {
        // Assume true in case its a regular JMenuItem
        boolean checkBoxState = true;
        if (e.getSource() instanceof JCheckBoxMenuItem) {
            checkBoxState = ((JCheckBoxMenuItem) e.getSource()).getState();
        }

        if (shortcutCreator.getJarPath() == null) {
            showErrorDialog("Unable to determine jar path; " + toggleType + " entry cannot succeed.");
            return;
        }

        if (!checkBoxState) {
            // Remove shortcut entry
            if (confirmDialog.prompt("Remove " + name + " from " + toggleType + "?")) {
                if (!shortcutCreator.removeShortcut(toggleType)) {
                    displayErrorMessage("Error removing " + toggleType + " entry");
                    checkBoxState = true;   // Set our checkbox back to true
                } else {
                    displayInfoMessage("Successfully removed " + toggleType + " entry");
                }
            } else {
                checkBoxState = true;   // Set our checkbox back to true
            }
        } else {
            // Add shortcut entry
            if (!shortcutCreator.createShortcut(toggleType)) {
                displayErrorMessage("Error creating " + toggleType + " entry");
                checkBoxState = false;   // Set our checkbox back to false
            } else {
                displayInfoMessage("Successfully added " + toggleType + " entry");
            }
        }

        if (e.getSource() instanceof JCheckBoxMenuItem) {
            ((JCheckBoxMenuItem) e.getSource()).setState(checkBoxState);
        }
    }

    /**
     * Displays a basic error dialog.
     */
    private void showErrorDialog(String message) {
        JOptionPane.showMessageDialog(null, message, name, JOptionPane.ERROR_MESSAGE);
    }

    public boolean showGatewayDialog(final Certificate cert) {
        return showGatewayDialog(cert, null);
    }

    public boolean showGatewayDialog(final Certificate cert, String printer) {
        if (cert == null) {
            displayErrorMessage("Invalid certificate");
            return false;
        }

        final String msg1 = printer == null ? "access local resources" : "print to " + printer;
        final String msg2 = printer == null ? "accessing local resources" : "printing to " + printer;

        try{
            SwingUtilities.invokeAndWait(new Runnable() {
                @Override
                public void run() {
                    gatewayDialog.prompt("%s wants to " + msg1, cert);
                }
            });
        } catch(Exception ignore){}

        if (gatewayDialog.isApproved()) {
            trayLogger.log(Level.INFO, "Allowed " + cert.getCommonName() + " to " + msg1);
            if (gatewayDialog.isPersistent()) {
                whiteList(cert);
            }
        } else {
            trayLogger.log(Level.INFO, "Blocked " + cert.getCommonName() + " from " + msg2);
            if (gatewayDialog.isPersistent()) {
                if (PrintSocket.UNSIGNED.equals(cert)) {
                    anonymousItem.doClick(); // if always block anonymous requests -> flag menu item
                } else {
                    blackList(cert);
                }
            }
        }

        return gatewayDialog.isApproved();
    }

    private void whiteList(Certificate cert) {
        FileUtilities.printLineToFile(Constants.ALLOW_FILE, cert.data());
        displayInfoMessage(String.format(Constants.WHITE_LIST, "\"" + cert.getOrganization() + "\""));
    }

    private void blackList(Certificate cert) {
        FileUtilities.printLineToFile(Constants.BLOCK_FILE, cert.data());
        displayInfoMessage(String.format(Constants.BLACK_LIST, cert.getOrganization()));
    }

    /**
     * Sets the WebSocket Server instance for displaying port information and restarting the server
     *
     * @param server    The Server instance contain to bind the reload action to
     * @param running   Object used to notify PrintSocket to reiterate its main while loop
     * @param portIndex Object used to notify PrintSocket to reset its port array counter
     */
    public void setServer(final Server server, final AtomicBoolean running, final AtomicInteger portIndex, final Integer[] ports) {
        if (server != null && server.getConnectors().length > 0) {
            singleInstanceCheck(ports, portIndex.get());
            displayInfoMessage("Server started on port(s) " + TrayManager.getPorts(server));
            aboutDialog.setServer(server);
            setDefaultIcon();

            setReloadThread(new Thread(new Runnable() {
                @Override
                public void run() {
                    try {
                        setDangerIcon();
                        server.stop();
                        running.set(false);
                        portIndex.set(-1);
                    } catch (Exception e) {
                        displayErrorMessage("Error stopping print socket: " + e.getLocalizedMessage());
                    }
                }
            }));
        } else {
            displayErrorMessage("Invalid server");
        }
    }

    /**
     * Returns a String representation of the ports assigned to the specified Server
     * @param server
     * @return
     */
    public static String getPorts(Server server) {
        String ports = "";
        for (Connector c : server.getConnectors()) {
            ports = ports + ((ServerConnector)c).getLocalPort() + ", ";
        }

        return ports.replaceAll(", $", "");
    }

    /**
     * Thread safe method for setting an info status message. Messages are suppressed unless "Show all
     * notifications" is checked.
     */
    public void displayInfoMessage(String text) {
        displayMessage(name, text, TrayIcon.MessageType.INFO);
    }

    /**
     * Thread safe method for setting the default icon
     */
    public void setDefaultIcon() {
        setIcon(IconCache.Icon.DEFAULT_ICON);
    }

    /**
     * Thread safe method for setting the error status message
     */
    public void displayErrorMessage(String text) {
        displayMessage(name, text, TrayIcon.MessageType.ERROR);
    }

    /**
     * Thread safe method for setting the danger icon
     */
    public void setDangerIcon() {
        setIcon(IconCache.Icon.DANGER_ICON);
    }

    /**
     * Thread safe method for setting the warning status message
     */
    public void displayWarningMessage(String text) {
        displayMessage(name, text, TrayIcon.MessageType.WARNING);
    }


    /**
     * Thread safe method for setting the warning icon
     */
    public void setWarningIcon() {
        setIcon(IconCache.Icon.WARNING_ICON);
    }

    /**
     * Thread safe method for setting the specified icon
     */
    private void setIcon(final IconCache.Icon i) {
        if (tray != null) {
            SwingUtilities.invokeLater(new Thread(new Runnable() {
                @Override
                public void run() {
                    tray.setImage(iconCache.getImage(i));
                }
            }));
        }
    }

    /**
     * Thread safe method for setting the specified status message
     *
     * @param caption     The title of the tray message
     * @param text        The text body of the tray message
     * @param level The message type: Level.INFO, .WARN, .SEVERE
     */
    private void displayMessage(final String caption, final String text, final TrayIcon.MessageType level) {
        if (tray != null) {
            SwingUtilities.invokeLater(new Thread(new Runnable() {
                @Override
                public void run() {
                    boolean showAllNotifications = prefs.getBoolean(notificationsKey, false);
                    if (showAllNotifications || level == TrayIcon.MessageType.ERROR) {
                        tray.displayMessage(caption, text, level);
                    }
                    trayLogger.log(convertLevel(level), "Tray Message: " + text);
                }
            }));
        }
    }

    public static Level convertLevel(TrayIcon.MessageType level) {
        switch (level) {
            case NONE:
                return Level.FINE;
            case ERROR:
                return Level.SEVERE;
            case WARNING:
                return Level.WARNING;
            default:
                return Level.INFO;
        }
    }

    public void addLogHandler(Logger logger) {
        if (logHandler == null) {
            try {
                logHandler = createLogHandler();
            } catch (IOException e) {
                logger.log(Level.WARNING, String.format("Could not write to log file %s.  " +
                        "Log history be limited to the console only.", Constants.LOG_FILE), e);
            }
        }

        if (logHandler != null) {
            logger.addHandler(logHandler);
        }
    }

    public FileHandler createLogHandler() throws IOException {
        String logFile = SystemUtilities.getDataDirectory() + File.separator + Constants.LOG_FILE + "%g.log";

        FileHandler logHandler = new FileHandler(logFile, Constants.LOG_SIZE, Constants.LOG_ROTATIONS, true);
        logHandler.setFormatter(new Formatter() {
            @Override
            public String format(LogRecord logRecord) {
                return String.format("[%s] %tY-%<tm-%<td %<tH:%<tM:%<tS - %s\r\n", logRecord.getLevel().toString(), new Date(), logRecord.getMessage());
            }
        });
        return logHandler;
    }

    public void singleInstanceCheck(Integer[] ports, Integer ourPortIndex) {
        WebSocketClient client = null;
        for (int i : ports) {
            if (i != ports[ourPortIndex]) {
                new SingleInstanceChecker(client, this, i + 1);
            }
        }
    }
}