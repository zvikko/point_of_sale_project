<?php
session_start();
if (!$_SESSION['userName']) {
    header("Location: index.php");
}
include_once("../connection/connect.php");
$useName = $_SESSION['userName'];
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
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../fonts/fontawesome/css/all.min.css">
    <style>
        .section {
            visibility: hidden;
            width: 100%;
            opacity: 0.5;
            height: 122%;
            left: 16px;
            z-index: 100000;
            /* left: 1000px; */
            position: absolute;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #042104;
            animation: animateBg 10s linear infinite;
        }

        @keyframes animateBg {
            0% {
                filter: hue-rotate(0deg);
            }

            100% {
                filter: hue-rotate(360deg);
            }
        }

        .section .loader {
            position: relative;
            width: 120px;
            height: 120px;
        }

        .section .loader span {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            transform: rotate(calc(18deg * var(--i)));

        }

        .section .loader span::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 15px;
            height: 15px;
            border-radius: 50%;
            background: #00ff0a;
            box-shadow: 0 0 10px #00ff0a,
                0 0 20px #00ff0a,
                0 0 40px #00ff0a,
                0 0 60px #00ff0a,
                0 0 80px #00ff0a,
                0 0 100px #00ff0a;
            animation: animate 2s linear infinite;
            animation-delay: calc(0.1s * var(--i));
        }

        @keyframes animate {
            0% {
                transform: scale(1);
            }

            80%,
            100% {
                transform: scale(0);
            }
        }

        #customModal {
            display: none;
            top: 0;
            left: 0;
            background-color: rgb(2 3 20 / 40%);
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 100000000;
            align-items: center;
        }

        #modalDailog {
            position: relative;
            background: #fff;
            height: auto;
            left: 25%;
            width: 49%;
            /* height: 20%; */
            padding: 10px;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <section class="section">
        <div class="loader">
            <span style="--i:1;"></span>
            <span style="--i:2;"></span>
            <span style="--i:3;"></span>
            <span style="--i:4;"></span>
            <span style="--i:5;"></span>
            <span style="--i:6;"></span>
            <span style="--i:7;"></span>
            <span style="--i:8;"></span>
            <span style="--i:9;"></span>
            <span style="--i:10;"></span>
            <span style="--i:11;"></span>
            <span style="--i:12;"></span>
            <span style="--i:13;"></span>
            <span style="--i:14;"></span>
            <span style="--i:15;"></span>
            <span style="--i:16;"></span>
            <span style="--i:17;"></span>
            <span style="--i:18;"></span>
            <span style="--i:19;"></span>
            <span style="--i:20;"></span>

        </div>
    </section>
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
                    <a href="dashboard.php" class="nav-link">Home</a>
                </li>
                <!-- <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li> -->
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form id="searchForm" class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" id="searchOrder" type="search" placeholder="Search" aria-label="Search">
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
            <a href="" class="brand-link">
                <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">RestauPOS</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?= $useName; ?></a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" id="" placeholder="Search" aria-label="Search">
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
                        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                        <li class="nav-item menu-is-opening">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-cash-register"></i>
                                <p>
                                    POS
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>

                                        <p>Orders</p>
                                    </a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Billing</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Cash up</p>
                                    </a>
                                </li> -->
                            </ul>
                        </li>
                        <li class="nav-item menu-is-opening menu-open">
                            <a href="../" class="nav-link">
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
                            <h1>POS</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">POS</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div id="customModal">
                    <div id="modalDailog">
                        <div class="form-group">
                            <input type="text" id="itemID2" readonly style="visibility: hidden;">
                            <input type="text" id="quantity" readonly style="visibility: hidden;">
                            <label for="pwd">Password</label>
                            <input style="width: 70%;" type="password" readonly onfocus="this.removeAttribute('readonly');" class="form-control" id="pwd" placeholder="Password">
                        </div>
                        <button class="btn btn-warning" id="approve" type="button">APPROVE</button>
                        <button class="btn btn-primary" id="cancelModal" type="button">CANCEL</button>
                    </div>
                </div>
                <div style="display: flex;" class="row">
                    <!-- Default box -->
                    <div id="alloca" class="card alloca">
                        <div class="card-header">
                            <h3 class="card-title">Orders</h3><br>
                            <p id="x" style="font-size: 12px;">Order # <span id="orderNum">0</span></p>
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
                            <table id="tble" class="table">
                                <tr>
                                    <th>#</th>
                                    <th>Items</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Tax</th>
                                    <th>Options</th>
                                </tr>
                                <tr>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button class="btn btn-outline-primary" id="createOrder" type="button">Create an order</button>
                            <button class="btn btn-outline-info" id="createBill" data-toggle="modal" data-target="#modal-secondary" type="button">Add to billing</button>
                            <button class="btn btn-outline-warning" onclick="printContent('alloca');" type="button">Print</button>
                            <button class="btn btn-outline-danger" id="clear">clear</button>
                        </div>
                        <!-- /.card-footer-->
                        <style>
                            .inp {
                                width: 200px;
                                font-size: 20px;
                            }
                        </style>
                    </div>
                    <div class="modal fade" id="modal-secondary">
                        <div class="modal-dialog">
                            <div class="modal-content bg-secondary">
                                <div class="modal-header">
                                    <h4 class="modal-title">Billing</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="amount" class="form-label">Amount</label>
                                        <input data-type='currency' type="text" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" class="inp form-control" id="amount" placeholder="$0.00">
                                    </div>
                                    <div class="mb-3">
                                        <label for="modeOfPayment" class="form-label">Mode of Payment</label>
                                        <select class="inp form-control" name="" id="modeOfPayment">
                                            <option value="cashUSD">Cash USD</option>
                                            <option value="cashZWL">Cash ZWL</option>
                                            <option value="swipeZWL">Swipe ZWL</option>
                                            <option value="ecocash">Ecocash</option>
                                            <option value="directBanking">Direct Banking</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                    <a id="printInvoice" href="" class="btn btn-outline-warning">Print invoice</a>
                                    <!-- <button type="button" class="btn btn-outline-light">Save changes</button> -->
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.card -->
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Items</h3>

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
                            <div class="options">
                                <input style="width: 184px;" id="myInput" class="form-control" type="search" placeholder="Search" aria-label="Search">
                                <?php
                                $query =  mysqli_query($sq, "SELECT * FROM `itemtypes` order by itemTypeDesc asc");
                                while ($rows = mysqli_fetch_assoc($query)) {
                                ?>
                                    <button class="optionBtn" id="<?= $rows['id']; ?>" type="button"><?= $rows['itemTypeDesc']; ?></button>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="otherOptions">
                                <div id="otherOptions">

                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">

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
    <!-- ../wrapper -->

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <script>
        //search
        $(document).on('submit', '#searchForm', function(e) {
            var searchOrder = $("#searchOrder").val();
            $.ajax({
                url: "../database/edit.php",
                type: "post",
                //async: false,
                data: {
                    "search1": 1,
                    "searchOrder": searchOrder
                },
                beforeSend: function() {
                    $(".section").css("visibility", "visible");
                },
                success: function(data) {
                    $("#items").html(data);
                    $(".section").css("visibility", "hidden");

                }
            })
            $.ajax({
                url: "../database/edit.php",
                type: "post",
                //async: false,
                data: {
                    "search2": 1,
                    "searchOrder": searchOrder
                },
                beforeSend: function() {
                    $(".section").css("visibility", "visible");
                },
                success: function(data) {
                    $("#orderNum").html(data);
                    $(".section").css("visibility", "hidden");

                }
            })
            e.preventDefault();
        })
        //Custom modal
        $(document).on('click', '#cancelModal', function() {
            $("#customModal").css("display", "none");
        })
        $(document).on('click', '#approve', function() {
            var itemID = $("#itemID2").val();
            var pwd = $("#pwd").val();
            var qty = $("#quantity").val();
            var orderNum = $("#orderNum").html();
            $.ajax({
                url: "../database/process.php",
                type: "post",
                //async: false,
                data: {
                    "removeItem": 1,
                    "pwd": pwd,
                    "orderNum": orderNum,
                    "qty": qty,
                    "itemID": itemID

                },
                beforeSend: function() {
                    $(".loading").css("visibility", "visible");
                },
                success: function(data) {
                    $("#items").html(data);
                    $("#customModal").css("display", "none");
                    $(".loading").css("visibility", "hidden");

                }
            })
        })

        //currency
        // Jquery Dependency
        // let res = str.substring(1);
        $("#printInvoice").on("click", function() {
            var orderNum = $("#orderNum").html();
            var amount = $("#amount").val();

            var modeOfPayment = $("#modeOfPayment").val();
            amount = amount.substring(1);
            amount = parseFloat(amount);
            window.open('../invoice.php?orderNum=' + orderNum + '&amount=' + amount + '&modeOfPayment=' + modeOfPayment, '_blank');

        });

        $("input[data-type='currency']").on({
            keyup: function() {
                formatCurrency($(this));
            },
            blur: function() {
                formatCurrency($(this), "blur");
            }
        });


        function formatNumber(n) {
            // format number 1000000 to 1,234,567
            return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        }


        function formatCurrency(input, blur) {
            // appends $ to value, validates decimal side
            // and puts cursor back in right position.

            // get input value
            var input_val = input.val();

            // don't validate empty input
            if (input_val === "") {
                return;
            }

            // original length
            var original_len = input_val.length;

            // initial caret position 
            var caret_pos = input.prop("selectionStart");

            // check for decimal
            if (input_val.indexOf(".") >= 0) {

                // get position of first decimal
                // this prevents multiple decimals from
                // being entered
                var decimal_pos = input_val.indexOf(".");

                // split number by decimal point
                var left_side = input_val.substring(0, decimal_pos);
                var right_side = input_val.substring(decimal_pos);

                // add commas to left side of number
                left_side = formatNumber(left_side);

                // validate right side
                right_side = formatNumber(right_side);

                // On blur make sure 2 numbers after decimal
                if (blur === "blur") {
                    right_side += "00";
                }

                // Limit decimal to only 2 digits
                right_side = right_side.substring(0, 2);

                // join number by .
                input_val = "$" + left_side + "." + right_side;

            } else {
                // no decimal entered
                // add commas to number
                // remove all non-digits
                input_val = formatNumber(input_val);
                input_val = "$" + input_val;

                // final formatting
                if (blur === "blur") {
                    input_val += ".00";
                }
            }

            // send updated string to input
            input.val(input_val);

            // put caret back in the right position
            var updated_len = input_val.length;
            caret_pos = updated_len - original_len + caret_pos;
            input[0].setSelectionRange(caret_pos, caret_pos);
        }

        $(document).on('click', '.optionBtn', function() {
            var itemTypeID = $(this).attr("id");
            $.ajax({
                url: "../database/process.php",
                type: "post",
                //async: false,
                data: {
                    "showList": 1,
                    "itemTypeID": itemTypeID

                },
                beforeSend: function() {
                    $(".loading").css("visibility", "visible");
                },
                success: function(data) {
                    $("#otherOptions").html(data);
                    $(".loading").css("visibility", "hidden");

                }
            })

        })
        $(document).on('click', '.otherOptionBtn', function() {
            var itemID = $(this).attr("id");
            $("#orderNum").html("");
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
        $(document).on('blur', '.quantity', function() {
            var orderNum = $("#orderNum").html();
            var itemID = $(this).attr("id");
            var qty = $(this).val();
            if (qty == 0) {
                if (confirm('Are you sure you want to remove the item?')) {
                    $("#customModal").css("display", "block");
                    $("#pwd").val("");
                    $("#pwd").focus();
                    $("#quantity").val("0");
                    $("#itemID2").val(itemID);
                } else {
                    alert('Deletion cancelled!');
                    $.ajax({
                        url: "../database/process.php",
                        type: "post",
                        //async: false,
                        data: {
                            "removeCancelled": 1,
                            "qty": qty,
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
                }

            } else {
                if (orderNum == "" || orderNum == 0) {
                    $.ajax({
                        url: "../database/process.php",
                        type: "post",
                        //async: false,
                        data: {
                            "editQty": 1,
                            "qty": qty,
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
                } else {
                    $("#customModal").css("display", "block");
                    $("#pwd").val("");
                    $("#pwd").focus();
                    $("#quantity").val(qty);
                    $("#itemID2").val(itemID);
                }
            }

        })
        $(document).on('click', '#createOrder', function() {

            $.ajax({
                url: "../database/edit.php",
                type: "post",
                //async: false,
                data: {
                    "createOrder": 1,
                },
                beforeSend: function() {
                    $(".loading").css("visibility", "visible");
                },
                success: function(data) {
                    $("#orderNum").html(data);
                    $(".loading").css("visibility", "hidden");

                }
            })

        })

        function printContent(el) {
            $(".btn").css("visibility", "hidden");
            $(".card-title").css("visibility", "hidden");
            $("#x").css("font-size", "20px");
            $(".quantity").css("border", "0");
            $("#items").css("max-height", "10000px");
            // $(".quantity").css("margin", "0");
            var restorepage = $('body').html();
            var printcontent = $('#' + el).clone();
            $('body').empty().html(printcontent);
            window.print();
            $('body').html(restorepage);
            $(".btn").css("visibility", "visible");
            $("#items").css("max-height", "400px");
        }
        //clear BTN
        $("#clear").on("click", function() {
            $.ajax({
                url: "../database/process.php",
                type: "post",
                //async: false,
                data: {
                    "clear": 1,
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
        $(document).ready(function() {
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $(".optionBtn").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
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