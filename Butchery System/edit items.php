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
    <title>RestauPOS | Items</title>

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
                    <a href="../../index3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
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

                <li class="nav-item dropdown">
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
                        <li class="nav-item ">
                            <a href="admin.php" class="active nav-link">
                                <i class="nav-icon fas fa-cash-register"></i>
                                <p>
                                    POS
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="" class="nav-link ">
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
                        <li class="nav-item menu-is-opening menu-open">
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
                                    <a href="edit items.php" class="nav-link active">
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
                            <h1>Edit Items</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Edit Items</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                <div style="display: flex;" class="row">
                    <!-- Default box -->
                    <div class="card alloca">
                        <div class="card-header">
                            <h3 class="card-title">Items Database</h3><br>
                            <!-- <p style="font-size: 12px;">Order # <span id="orderNum">0</span></p> -->
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div id="items" class="card-body">
                            <?php
                            $getItems = mysqli_query($sq, "SELECT * FROM items");
                            ?>
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Item</th>
                                        <th>Description</th>
                                        <th>Price (USD)</th>
                                        <th>Price (ZWL)</th>
                                        <th>Type</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($rows = mysqli_fetch_assoc($getItems)) {
                                    ?>
                                        <tr>
                                            <td><?= $rows['id']; ?>
                                            </td>
                                            <td><?= $rows['itemName']; ?>
                                            </td>
                                            <td><?= $rows['itemDescription']; ?>
                                            </td>
                                            <td><?= $rows['priceUSD']; ?>
                                            </td>
                                            <td><?= $rows['priceZWL']; ?>
                                            </td>
                                            <td>
                                                <?php
                                                $itemID = $rows['itemTypeID'];
                                                $getType = mysqli_query($sq, "SELECT * FROM itemtypes WHERE id = '$itemID'");
                                                $rww = mysqli_fetch_array($getType);
                                                echo $rww['itemTypeDesc'];

                                                ?>
                                            </td>
                                            <td><a href="#" data-toggle="modal" data-target="#bd-example-modal-lg"><i id="<?= $rows['id']; ?>" class="edit fas fa-pen-alt"></i></a></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal fade bd-example-modal-lg" tabindex="-1" id="bd-example-modal-lg" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">

                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit an item</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div style="padding: 10px; width:700px;" id="resu">

                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button id="saveChanges" type="button" class="btn btn-primary">Save
                                            changes</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal fade bd-example-modal-lg" tabindex="-1" id="bd-example-modal-lg2" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">

                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">New Item</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div style="padding: 10px; width:700px;">
                                        <form>
                                            <div class="form-group">
                                                <label for="barCode">Bar Code</label>
                                                <input type="text" class="form-control" id="barCode" placeholder="Bar Code">
                                            </div>
                                            <div class="form-group">
                                                <label for="itemName">Item Name</label>

                                                <input type="text" class="form-control" id="itemName">
                                            </div>
                                            <div class="form-group">
                                                <label for="descr">Description</label>
                                                <textarea class="form-control" name="" id="descr" cols="30" rows="5"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="itemType">Item Type</label>
                                                <select class="form-control" name="" id="itemType">
                                                    <?php
                                                    $itemTypeID = $rwsw['itemTypeID'];
                                                    $getType = mysqli_query($sq, "SELECT * FROM itemtypes WHERE id='$itemTypeID'");
                                                    $qry = mysqli_query($sq, "SELECT * FROM itemtypes");
                                                    $typ = mysqli_fetch_array($getType);
                                                    while ($types = mysqli_fetch_assoc($qry)) {
                                                    ?>
                                                        <option value="<?= $types['id']; ?>">
                                                            <?= $types['itemTypeDesc']; ?>
                                                        </option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="priceUSD">Price (USD)</label>
                                                <input type="number" class="form-control" id="priceUSD">
                                            </div>
                                            <div class="form-group">
                                                <label for="formGroupExampleInput2">Price (ZWL)</label>
                                                <input type="number" class="form-control" id="priceZWL">
                                            </div>
                                            <div class="form-group">
                                                <label for="formGroupExampleInput2">Quantity</label>
                                                <input type="number" class="form-control" id="quantity">
                                            </div>

                                        </form>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button id="saveItem" type="button" class="btn btn-primary">Save</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal fade bd-example-modal-lg" tabindex="-1" id="bd-example-modal-lg3" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">

                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Item Type</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div style="padding: 10px; width:700px;">
                                        <div class="form-group">
                                            <label for="typeName">Type Name</label>
                                            <input type="text" class="form-control" id="typeName" placeholder="Type name">
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button id="saveType" type="button" class="btn btn-primary">Save</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <!-- <button class="btn btn-outline-primary" id="createOrder" type="button">Create an order</button> -->
                            <button class="btn btn-outline-info" data-toggle="modal" data-target="#bd-example-modal-lg2" id="addItem" type="button">Add an item</button>
                            <!-- <button class="btn btn-outline-danger">clear</button> -->
                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!-- /.card -->
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add Item types</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div style="display: flex;" class="card-body">
                            <div id="options" class="options">

                                <?php
                                $query =  mysqli_query($sq, "SELECT * FROM `itemtypes` order by itemTypeDesc asc");
                                while ($rows = mysqli_fetch_assoc($query)) {
                                ?>
                                    <button class="optionBtn" id="<?= $rows['id']; ?>" type="button"><?= $rows['itemTypeDesc']; ?></button>
                                <?php
                                }
                                ?>

                            </div>
                            <div id="otherOptions" class="otherOptions">
                                <!-- <button class="otherOptionBtn">Salt</button>
                                <button class="otherOptionBtn">Milk</button><br>
                                <button class="otherOptionBtn">Sugar</button>
                                <button class="otherOptionBtn">Cream</button><br>
                                <button class="otherOptionBtn">Spicy</button>
                                <button class="otherOptionBtn">Tomato</button><br>
                                <button class="otherOptionBtn">Sauce</button>
                                <button class="otherOptionBtn">Ice</button><br>
                                <button class="otherOptionBtn">Tom Ketchup</button>
                                <button class="otherOptionBtn">Chili pepper</button> -->
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button id="addItemType" data-toggle="modal" data-target="#bd-example-modal-lg3" style="width: 100%;" class="btn btn-secondary" type="button">+</button>
                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!-- /.card -->

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
    <script src="./plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="./dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="./dist/js/demo.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="./plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="./plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="./plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="./plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="./plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="./plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="./plugins/jszip/jszip.min.js"></script>
    <script src="./plugins/pdfmake/pdfmake.min.js"></script>
    <script src="./plugins/pdfmake/vfs_fonts.js"></script>
    <script src="./plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="./plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="./plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        })
        $(document).on('click', '.edit', function() {

            var itemID = $(this).attr("id");
            $.ajax({
                url: "./database/edit.php",
                type: "post",
                //async: false,
                data: {
                    "edit": 1,
                    "itemID": itemID

                },
                beforeSend: function() {
                    $(".loading").css("visibility", "visible");
                },
                success: function(data) {

                    $("#resu").html(data);
                    $(".loading").css("visibility", "hidden");

                }
            })

        })
        $(document).on('click', '#saveType', function() {

            var typeName = $("#typeName").val();
            $.ajax({
                url: "./database/edit.php",
                type: "post",
                //async: false,
                data: {
                    "saveType": 1,
                    "typeName": typeName

                },
                beforeSend: function() {
                    $(".loading").css("visibility", "visible");
                },
                success: function(data) {

                    $("#options").html(data);
                    $("#typeName").val("");
                    $(".loading").css("visibility", "hidden");

                }
            })

        })
        $(document).on('click', '#saveItem', function() {
            var itemName = $("#itemName").val();
            var descr = $("#descr").val();
            var itemTypeID = $("#itemType").val();
            var priceUSD = $("#priceUSD").val();
            var priceZWL = $("#priceZWL").val();
            var barCode = $("#barCode").val();
            var quantity = $("#quantity").val();
            $.ajax({
                url: "./database/process.php",
                type: "post",
                //async: false,
                data: {
                    "saveItem": 1,
                    "itemName": itemName,
                    "descr": descr,
                    "itemTypeID": itemTypeID,
                    "priceUSD": priceUSD,
                    "quantity": quantity,
                    "barCode": barCode,
                    "priceZWL": priceZWL

                },
                beforeSend: function() {
                    $(".loading").css("visibility", "visible");
                },
                success: function(data) {
                    $("#items").html(data);
                    $("#itemName").val("");
                    $("#descr").val("");
                    $("#itemType").val("");
                    $("#priceUSD").val("");
                    $("#priceZWL").val("");
                    $("#barCode").val("");
                    $("#quantity").val("");
                    $(".loading").css("visibility", "hidden");

                }
            })
        })
        $(document).on('click', '#saveChanges', function() {
            var itemID = $("#itemID").val();
            var itemName = $("#itemName").val();
            var descr = $("#descr").val();
            var itemTypeID = $("#itemType").val();
            var priceUSD = $("#priceUSD").val();
            var priceZWL = $("#priceZWL").val();
            var barCode = $("#barCode").val();
            $.ajax({
                url: "./database/process.php",
                type: "post",
                //async: false,
                data: {
                    "editItem": 1,
                    "itemID": itemID,
                    "itemName": itemName,
                    "descr": descr,
                    "itemTypeID": itemTypeID,
                    "priceUSD": priceUSD,
                    "barCode": barCode,
                    "priceZWL": priceZWL

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