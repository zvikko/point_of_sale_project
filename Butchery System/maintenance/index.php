<?php
session_start();
if (isset($_SESSION['userName']) || $_SESSION['departmentID'] == 4) {
    $userName = $_SESSION['userName'];
} else {
    header("location: ../");
}
include_once("../connection/connect.php");
$getUser = mysqli_query($sq, "SELECT * FROM users WHERE userName = '$userName'");
$ro = mysqli_fetch_array($getUser);
$dptID = $ro['departmentID'];
$maintananceAndSecurity = 21;
$getPrivileges1 = mysqli_query($sq, "SELECT * FROM privileges WHERE dptID = '$dptID' AND privilageID = '$maintananceAndSecurity'");
$ro1 = mysqli_fetch_array($getPrivileges1);
if ($ro1['privilageCode'] == 0) {
    echo '
    <script>
        alert("You have no right to view this page. Please contact the adminstrator for help");
    </script>
    ';
    header("refresh:0.0; url=../dashboard");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Maintenance</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/dataTables v2.0.1/css/buttons.dataTables.css">
    <link rel="stylesheet" href="../plugins/dataTables v2.0.1/css/dataTables.dataTables.css">
    <!-- <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css"> -->
    <style>
        @media print {
            input[type="checkbox"] {
                display: inline !important;
                /* or display: block !important; */
            }

            table {
                page-break-inside: avoid;
            }
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="admin.php" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link"></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <!-- <a class="nav-link" data-toggle="dropdown" href="#"> -->
                    <!-- <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">3</span> -->
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="../dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="../dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">I got your message bro</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="../dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">The subject goes here</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <!-- <a class="nav-link" data-toggle="dropdown" href="#"> -->
                    <!-- <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span> -->
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="../dashboard/" class="brand-link">
                <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">RestauPOS</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <!-- <img src="./dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?= $userName; ?></a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item menu-is-opening">
                            <a href="admin.php" class=" nav-link">
                                <i class="nav-icon fas fa-cash-register"></i>
                                <p>
                                    POS
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="admin.php" class="nav-link ">
                                        <i class="far fa-circle nav-icon"></i>

                                        <p>Orders</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Billing</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Cash up</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-cookie"></i>
                                <p>
                                    Items
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>New item</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Price Control</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="edit items.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Edit an item</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Users
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="all users.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All users</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="add users.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add users</p>
                                    </a>
                                </li>


                            </ul>

                        </li>
                        <li class="nav-item">
                            <a href="tools.php" class="nav-link active">
                                <i class="nav-icon fas fa-tools"></i>
                                <p>
                                    Tools
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                        </li>
                        <li class="nav-item menu-is-opening menu-open">
                            <a href="../" class="nav-link alert alert-warning">
                                <i class="nav-icon fas fa-sign-out-alt"></i>

                                <p>
                                    Logout
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Tools</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Tools</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <style>
                    legend.scheduler-border {
                        width: inherit;
                        /* Or auto */
                        padding: 0 10px;
                        /* To give a bit of padding on the left and right */
                        border-bottom: none;
                    }
                </style>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-10">
                            <div class="card card-default collapsed-card">
                                <div class="card-header ui-sortable-handle">
                                    <h3 class="card-title">Define User Group</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <?php
                                $getDpt = mysqli_query($sq, "SELECT * FROM `departments`");
                                ?>
                                <div class="card-body">
                                    <table id="example1" class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>User Group</th>
                                                <th>Define User Group</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($t = mysqli_fetch_assoc($getDpt)) {
                                            ?>
                                                <tr>
                                                    <td scope="row"><?= $t['id']; ?></td>
                                                    <td><?= $t['departmentName']; ?></td>
                                                    <td><?php
                                                        $getPriv = mysqli_query($sq, "SELECT * FROM `privilegenames`");
                                                        while ($rw = mysqli_fetch_assoc($getPriv)) {
                                                            $privid = $rw['id'];
                                                            $dptID = $t['id'];
                                                            $check3 = mysqli_query($sq, "SELECT * FROM `privileges` WHERE privilageID = '$privid' AND dptID='$dptID'");
                                                            $row = mysqli_fetch_array($check3);
                                                            $privCode = $row['privilageCode'];
                                                        ?>
                                                            <div class="d-inline-flex p-3 form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" <?php print($privCode == 1 ? "checked" : ""); ?> class="priv form-check-input" name="" id="<?= $dptID . ',' . $privid; ?>" value="checkedValue">
                                                                    <?= $rw['privilageName']; ?>
                                                                </label>
                                                            </div>
                                                        <?php
                                                        }
                                                        // $dptID = $t['dptID'];
                                                        // $getDptName = mysqli_query($sq, "SELECT * FROM departments WHERE id = '$dptID'");
                                                        // $dpt = mysqli_fetch_array($getDptName);
                                                        // echo $dpt['departmentName'];
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <!-- <button type="button" data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-outline-primary">ADD PRIVILEGES</button> -->
                                                    <form id="privileges">
                                                        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">New Privilage</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div id="success"></div>
                                                                        <div class="form-group">
                                                                            <label for="privilegeName" class="col-form-label">Privilege Name</label>
                                                                            <input type="text" class="form-control" id="privilegeName">
                                                                        </div>
                                                                        <!-- <div class="form-group">
                                                                        <label for="message-text" class="col-form-label">Message:</label>
                                                                        <textarea class="form-control" id="message-text"></textarea>
                                                                    </div> -->

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" id="savePriv" class="btn btn-primary">Save</button>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div id="success2"></div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <!-- Visit <a href="https://github.com/istvan-ujjmeszaros/bootstrap-duallistbox#readme">Bootstrap Duallistbox</a> for more examples and information about
                                    the plugin. -->
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                        <div class="col-10">
                            <div class="card card-default collapsed-card">
                                <div class="card-header ui-sortable-handle">
                                    <h3 class="card-title">User Group Assignment</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Departments</label>
                                                <?php
                                                $getDepartments = mysqli_query($sq, "SELECT * FROM departments");
                                                ?>
                                                <select id="filterDpt" class="form-control select2">
                                                    <option value="" selected disabled></option>
                                                    <?php
                                                    while ($a = mysqli_fetch_assoc($getDepartments)) {
                                                    ?>
                                                        <option value="<?= $a['id']; ?>"><?= $a['departmentName']; ?></option>
                                                    <?php
                                                    }
                                                    ?>

                                                </select>
                                            </div>
                                            <div id="dptResults" class="form-group">
                                                <label for="">Users</label>
                                                <select class="form-control" multiple="multiple" name="" id="dptUsers">
                                                </select>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <style>
                                            .btnSize {
                                                width: 50px;
                                                margin: 2px;
                                                position: relative;
                                                left: 50%;
                                                transform: translate(-50%, -50%);
                                            }
                                        </style>
                                        <div class="col">
                                            <button id="leftBtn" type="button" class="btnSize btn btn-primary"><i class="fa fa-arrow-left"></i></button><br>
                                            <button type="button" class="btnSize btn btn-primary"><i class="fa fa-arrow-right"></i></button><br>
                                            <button type="button" class="btnSize btn btn-primary"><i class="fa fa-arrow-left"></i><i class="fa fa-arrow-left"></i></button><br>
                                            <button type="button" class="btnSize btn btn-primary"><i class="fa fa-arrow-right"></i><i class="fa fa-arrow-right"></i></button>

                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Users</label>
                                                <?php
                                                $getUsers = mysqli_query($sq, "SELECT * FROM `users`")
                                                ?>
                                                <select id="allUsers" class="form-control" multiple="multiple" name="" id="">
                                                    <?php
                                                    while ($b = mysqli_fetch_assoc($getUsers)) {
                                                    ?>
                                                        <option value="<?= $b['id']; ?>"><?= $b['userName']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <!-- Visit <a href="https://github.com/istvan-ujjmeszaros/bootstrap-duallistbox#readme">Bootstrap Duallistbox</a> for more examples and information about
                                    the plugin. -->
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                    <div class="col-10">
                        <div class="card card-default collapsed-card">
                            <div class="card-header ui-sortable-handle ">
                                <h3 class="card-title">Company Profile</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- jQuery -->
                                <script src="../plugins/jquery/jquery.min.js"></script>
                                <?php
                                $qry = mysqli_query($sq, "SELECT * FROM company");

                                $rows = mysqli_fetch_array($qry);
                                ?>
                                <form style="width: 800px;" enctype="multipart/form-data" action="../database/edit.php" method="POST" class="form">
                                    <div id="alert" class="alert">
                                        <?php
                                        if (isset($_GET['message'])) {
                                            $message = $_GET['message'];
                                            if ($message == "large") {
                                                echo '
                                    <script>
                                        $("#alert").css("Display", "block");
                                        $("#alert").addClass("alert-warning"); 
                                    
                                        </script>';
                                                $err = "The file is too large";
                                            } elseif ($message == "success") {
                                                echo '
                                                                <script>
                                        $("#alert").css("Display", "block");
                                        $("#alert").addClass("alert-success"); 
                                        
                                    </script>';
                                                $err = "Successfully saved!";
                                            }
                                        } else {
                                            $message = '';
                                            echo '<script>document.getElementById("alert").style.display="none"</script>';
                                        }
                                        ?>
                                        <?php
                                        if (isset($err)) {
                                            echo $err;
                                        }
                                        ?>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="companyName" class="form-label">Name</label>
                                            <input required name="companyName" value="<?php if (isset($rows['companyName'])) {
                                                                                            echo $rows['companyName'];
                                                                                        } ?>" id="companyName" type="text" class="form-control" aria-label="Company Name">
                                        </div>
                                        <div class="col">
                                            <label for="companyEmail" class="form-label">Email</label>
                                            <input value="<?php if (isset($rows['companyEmail'])) {
                                                                echo $rows['companyEmail'];
                                                            } ?>" required name="companyEmail" id="companyEmail" type="email" class="form-control" aria-label="Email">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="phone" class="form-label">Phone</label>
                                            <input value="<?php if (isset($rows['companyPhone'])) {
                                                                echo $rows['companyPhone'];
                                                            } ?>" required name="phone" id="phone" type="text" class="form-control" aria-label="Phone number">
                                        </div>
                                        <div class="col">
                                            <label for="companyDesc" class="form-label">Decription</label>
                                            <textarea class="form-control" aria-label="Company Description" name="companyDesc" id="companyDesc" cols="10" rows="5"><?php if (isset($rows['companyDesc'])) {
                                                                                                                                                                        echo $rows['companyDesc'];
                                                                                                                                                                    } ?></textarea>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="vat" class="form-label">VAT Number</label>
                                            <input value="<?php if (isset($rows['vatNo'])) {
                                                                echo $rows['vatNo'];
                                                            } ?>" name="vat" id="vat" type="text" class="form-control" aria-label="Phone number">
                                        </div>
                                        <div class="col">
                                            <label for="address" class="form-label">Address</label>
                                            <textarea required class="form-control" aria-label="Address" name="address" id="address" cols="10" rows="5"><?php if (isset($rows['companyAddress'])) {
                                                                                                                                                            echo $rows['companyAddress'];
                                                                                                                                                        } ?></textarea>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="fax" class="form-label">Fax</label>
                                            <input value="<?php if (isset($rows['companyFax'])) {
                                                                echo $rows['companyFax'];
                                                            } ?>" name="fax" id="fax" type="text" class="form-control" aria-label="Fax number">
                                        </div>
                                        <div class="col">
                                            <label for="logo" class="form-label">Logo</label>
                                            <input name="logo" id="logo" type="file" class="form-control" aria-label="logo">
                                            <img style="width: 300px;" class="brand-image elevation-3" src="../uploads/<?php if (isset($rows['companyLogo'])) {
                                                                                                                            echo $rows['companyLogo'];
                                                                                                                        } ?>" alt="">
                                        </div>
                                    </div>
                                    <button name="saveComp" type="submit" id="save" class="btn btn-outline-success">SAVE</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            </section>
            <div id="feedback"></div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 1.0.0
            </div>
            <strong>Copyright &copy; 2022 <a href="#">ZC</a>.</strong> All rights reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <!-- Select2 -->
    <script src="../plugins/select2/js/select2.full.min.js"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
    <!-- InputMask -->
    <script src="../plugins/moment/moment.min.js"></script>
    <script src="../plugins/inputmask/jquery.inputmask.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../plugins/jszip/jszip.min.js"></script>
    <script src="../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script>
        // $(document).on('click', '#save', function() {
        //     var companyName = $("#companyName").val();
        //     var companyEmail = $("#companyEmail").val();
        //     var phone = $("#phone").val();
        //     var companyDesc = $("#companyDesc").val();
        //     var vat = $("#vat").val();
        //     var address = $("#address").val();
        //     var fax = $("#fax").val();
        //     var logo = $("#logo").val();
        //     $.ajax({
        //         url: "./database/edit.php",
        //         type: "post",

        //         data: {
        //             "saveComp": 1,
        //             "companyName": companyName,
        //             "companyEmail": companyEmail,
        //             "phone": phone,
        //             "companyDesc": companyDesc,
        //             "vat": vat,
        //             "address": address,
        //             "fax": fax,
        //             "logo": logo

        //         },
        //         beforeSend: function() {
        //             $(".loading").css("visibility", "visible");
        //         },
        //         success: function(data) {
        //             $("#feedback").html(data);
        //             $(".loading").css("visibility", "hidden");

        //         }
        //     })

        // })
        $(function() {
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
            //Bootstrap Duallistbox
            $('.duallistbox').bootstrapDualListbox()
            var table = $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "columnDefs": [{
                    targets: 'no-print',
                    visible: false
                }],
                "buttons": ["copy", "csv", "excel", "pdf", {
                    extend: 'print',
                    customize: function(win) {
                        $(win.document.body).find('input[type="checkbox"]').each(function() {
                            // Check if the checkbox is checked
                            var isChecked = $(this).prop('checked');

                            // Replace checkbox with a span containing Unicode character based on the checked status
                            var replacement = isChecked ? '&#9745;' : '&#9744;';
                            $(this).replaceWith('<span>' + replacement + '</span>');
                        });
                    }
                }, "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $("#leftBtn").on("click", function() {
                var selectedUserID = $("#allUsers").val();
                var selectedDpt = $("#filterDpt").val();
                // alert(selectedUser);
                if (selectedUserID != "" && selectedDpt != null) {
                    $.ajax({
                        url: "../database/process.php",
                        type: "post",
                        data: {
                            "assignUser": 1,
                            "selectedDpt": selectedDpt,
                            "selectedUserID": selectedUserID
                        },
                        success: function(data) {
                            $("#dptResults").html(data);
                        }
                    })
                }
            })
            $("#filterDpt").on("change", function() {
                var dptID = $(this).val();
                // alert(dptID);
                $.ajax({
                    url: "../database/process.php",
                    type: "post",
                    //async: false,
                    data: {
                        "filterDpt": 1,
                        "dptID": dptID
                    },
                    success: function(data) {
                        $("#dptResults").html(data);
                    }
                })
            })
            $(".priv").on("change", function() {
                var isChecked = $(this).prop('checked');
                var unsperatedNum = $(this).attr("id");
                var separatedNums = unsperatedNum.split(',');
                var userGrpID = separatedNums[0];
                var dfnUserGrpNameID = separatedNums[1];
                if (isChecked) {
                    var dfnUserGrp = 1;
                } else {
                    var dfnUserGrp = 0;
                }
                $.ajax({
                    url: "../database/process.php",
                    type: "post",
                    //async: false,
                    data: {
                        "savePriv2": 1,
                        "dfnUserGrpNameID": dfnUserGrpNameID,
                        "userGrpID": userGrpID,
                        "dfnUserGrp": dfnUserGrp,

                    },
                    success: function(data) {
                        $("#success2").html(data);
                    }
                })
                // console.log(userGrpID + " " + dfnUserGrpNameID + " " + dfnUserGrp)
                // alert($(this).attr("id") + " " + isChecked)
            })
            // $('#example').DataTable({
            //     columnDefs: [{
            //         targets: 'no-print',
            //         visible: false
            //     }]
            // });
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });

        });
        $(document).on('submit', '#privileges', function(e) {
            var privilegeName = $("#privilegeName").val();
            $.ajax({
                url: "../database/process.php",
                type: "post",
                //async: false,
                data: {
                    "savePriv": 1,
                    "privilegeName": privilegeName

                },
                success: function(data) {
                    $("#success").html(data);
                }
            })
            e.preventDefault();
        })
        $(document).on('click', '.otherOptionBtn', function() {
            var itemID = $(this).attr("id");
            $.ajax({
                url: "../database/process.php",
                type: "post",
                //async: false,
                data: {
                    "showList2": 1,
                    "itemID": itemID

                },
                beforeSend: function() {
                    $(".loading").css("visibility", "visible");
                },
                success: function(data) {
                    $("#items").html(data);
                    $(".loading").css("visibility", "hidden");

                }
            })

        })

        // $(document).on('click', '.otherOptionBtn', function() {

        //     var orderNum = parseInt(document.getElementById("orderNum").innerHTML);
        //     if (orderNum == "NaN") {
        //         orderNum = 0;
        //         orderNum = orderNum + 1;
        //         document.getElementById("orderNum").innerHTML = orderNum;
        //     } else {
        //         orderNum = orderNum + 1;
        //         document.getElementById("orderNum").innerHTML = orderNum;
        //     }
        // })
    </script>

</body>

</html>