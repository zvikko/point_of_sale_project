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

package qz.utils;

import qz.common.Constants;

import javax.swing.*;
import java.io.File;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 * Utility class for OS detection functions.
 * @author Tres Finocchiaro
 */
public class SystemUtilities {
    // Name of the os, i.e. "Windows XP", "Mac OS X"
    private static final String OS_NAME = System.getProperty("os.name").toLowerCase();
    private static String uname;
    private static String linuxRelease;
    
     /**
     * Returns a lowercase version of the Operating system name identified by
     * <code>System.getProperty("os.name");</code>.
     *
     * @return Lowercase version of the Operating system name
     */
    public static String getOS() {
        return OS_NAME;
    }


    /**
     * Returns the OS-specific Application Data directory such as:
     *  <code>C:\Users\John\AppData\Roaming\.qz</code> on Windows
     *   -- or --
     *  <code>/Users/John/Library/Application Support/.qz</code> on Mac
     *  -- or --
     *  <code>/home/John/.qz</code> on Linux
     * @return Full path to the Application Data directory
     */
    public static String getDataDirectory() {
        String parent;
        String folder = Constants.DATA_DIR;
        if (isWindows()) {
            parent = System.getenv("APPDATA");
        } else if (isMac()) {
            parent = System.getProperty("user.home") + File.separator + "Library" + File.separator + "Application Support";
        } else if (isUnix()) {
            parent = System.getProperty("user.home");
            folder = "." + folder;
        } else {
            parent = System.getProperty("user.dir");
        }
        return parent + File.separator + folder;
    }

    
    /**
     * Determine if the current Operating System is Windows
     *
     * @return <code>true</code> if Windows, <code>false</code> otherwise
     */
    public static boolean isWindows() {
        return (OS_NAME.contains("win"));
    }

    /**
     * Determine if the current Operating System is Mac OS
     *
     * @return <code>true</code> if Mac OS, <code>false</code> otherwise
     */
    public static boolean isMac() {
        return (OS_NAME.contains("mac"));
    }

    /**
     * Determine if the current Operating System is Linux
     *
     * @return <code>true</code> if Linux, <code>false</code> otherwise
     */
    public static boolean isLinux() {
        return (OS_NAME.contains("linux"));
    }

    /**
     * Determine if the current Operating System is Unix
     *
     * @return <code>true</code> if Unix, <code>false</code> otherwise
     */
    public static boolean isUnix() {
        return (OS_NAME.contains("nix") || OS_NAME.contains("nux") || OS_NAME.indexOf("aix") > 0 || OS_NAME.contains("sunos"));
    }

    /**
     * Determine if the current Operating System is Solaris
     *
     * @return <code>true</code> if Solaris, <code>false</code> otherwise
     */
    public static boolean isSolaris() {
        return (OS_NAME.contains("sunos"));
    }

    /**
     * Returns whether the output of <code>uname -a</code> shell command contains "Ubuntu"
     * @return <code>true</code> if this OS is Ubuntu
     */
    public static boolean isUbuntu() {
        getUname();
        return uname != null && uname.contains("Ubuntu");
    }

    /**
     * Returns whether the output of <code>cat /etc/redhat-release/code> shell command contains "Fedora"
     * @return <code>true</code> if this OS is Fedora
     */
    public static boolean isFedora() {
        getLinuxRelease();
        return linuxRelease != null && linuxRelease.contains("Fedora");
    }

    /**
     * Returns the output of <code>cat /etc/lsb-release</code> or equivalent
     * @return the output of the command or null if not running Linux
     */
    public static String getLinuxRelease()  {
        if (isLinux() && linuxRelease == null) {
            String[] releases = {"/etc/lsb-release", "/etc/redhat-release"};
            for (String release : releases) {
                String result = ShellUtilities.execute(
                        new String[]{"cat", release},
                        null
                );
                if (result != null && !result.isEmpty()) {
                    linuxRelease = result;
                    break;
                }
            }
        }
        return linuxRelease;
    }

    /**
     * Returns the output of <code>uname -a</code> shell command, useful for parsing the Linux Version
     * @return the output of <code>uname -a</code>, or null if not running Linux
     */
    public static String getUname() {
        if (isLinux() && uname == null) {
            uname = ShellUtilities.execute(
                    new String[]{"uname", "-a"},
                    null
            );
        }
        return uname;
    }

    public static boolean setSystemLookAndFeel() {
        try {
            UIManager.getDefaults().put("Button.showMnemonics", Boolean.TRUE);
            UIManager.setLookAndFeel(UIManager.getSystemLookAndFeelClassName());
            return true;
        } catch (Exception e) {
            Logger.getLogger(SystemUtilities.class.getName()).log(Level.WARNING,  "Error getting the default look and feel");
        }
        return false;
    }
}
