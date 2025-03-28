<?php
session_start();
if (!$_SESSION['userName'] || $_SESSION['departmentID'] != 4) {
    header("Location: index.php");
} else {
    $userName = $_SESSION['userName'];
}
include_once("./connection/connect.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RestauPOS</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="./dist/css/adminlte.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
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
                                <img src="./dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
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
                                <img src="./dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
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
                                <img src="./dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
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
            <a href="../../index3.html" class="brand-link">
                <img src="./dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
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
                            <a href="./" class="nav-link alert alert-warning">
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
                <fieldset class="border p-2">
                    <!-- jQuery -->
                    <script src="./plugins/jquery/jquery.min.js"></script>
                    <?php
                    $qry = mysqli_query($sq, "SELECT * FROM company");

                    $rows = mysqli_fetch_array($qry);
                    ?>
                    <legend class="w-auto">Company Profile</legend>
                    <form style="width: 800px;" enctype="multipart/form-data" action="./database/edit.php" method="POST" class="form">
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
                                <img style="width: 300px;" class="brand-image elevation-3" src="./uploads/<?php if (isset($rows['companyLogo'])) {
                                                                                                                echo $rows['companyLogo'];
                                                                                                            } ?>" alt="">
                            </div>
                        </div>
                        <button name="saveComp" type="submit" id="save" class="btn btn-outline-success">SAVE</button>
                    </form>
                </fieldset>
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
    <script src="./plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="./dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="./dist/js/demo.js"></script>
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

        $(document).on('click', '.otherOptionBtn', function() {
            var itemID = $(this).attr("id");
            $.ajax({
                url: "./database/process.php",
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