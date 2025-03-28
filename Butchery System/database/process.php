<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>

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

<?php
session_start();
require_once("../connection/connect.php");
if (isset($_POST['showList'])) {
    $count = 0;
    $itemTypeID = $_POST['itemTypeID'];
    $query = mysqli_query($sq, "SELECT * FROM items WHERE itemTypeID = '$itemTypeID'");
    while ($rows1 = mysqli_fetch_assoc($query)) {
?>
        <button id="<?= $rows1['id']; ?>" class="otherOptionBtn"><?= $rows1['itemName']; ?></button>
    <?php
        $count++;
        if (($count % 2) == 0) {
            echo "<br />";
        }
    }
}

if (isset($_POST['showList2'])) {
    $count = 0;
    $itemID = mysqli_real_escape_string($sq, $_POST['itemID']);
    $query = mysqli_query($sq, "SELECT * FROM items WHERE id = '$itemID'");
    $rws = mysqli_fetch_array($query);
    $price = $rws['priceUSD'];


    $check = mysqli_query($sq, "SELECT * FROM orders WHERE ItemID='$itemID' AND ordered='0' AND billing = '0'");
    $numrows = mysqli_num_rows($check);
    if ($numrows == 0) {
        $insertInt = mysqli_query($sq, "INSERT INTO `orders`(`ItemID`, `price`, `currency`, `ordered`, `userID`, `billing`,`quantity`) VALUES ('$itemID','$price','USD','0','1','0','1')");
    }
    $qry = mysqli_query($sq, "SELECT * FROM orders WHERE ordered='0' AND billing = '0'");
    ?>
    <table id="tble" class="table">
        <tr>
            <th>#</th>
            <th>Items</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Sub-total</th>
        </tr>
        <?php
        $subTotal = 0;
        $total = 0;
        while ($rwss = mysqli_fetch_assoc($qry)) {
        ?>
            <tr>
                <td></td>
                <td><?php
                    $itemID1 = $rwss['ItemID'];
                    $gett = mysqli_query($sq, "SELECT * FROM items WHERE id = '$itemID1'");
                    $rrws = mysqli_fetch_array($gett);
                    $itemDescription = $rrws['itemDescription'];
                    echo $itemDescription;
                    ?></td>
                <td>$<?= $rwss['price']; ?></td>
                <td><input id="<?= $rwss['id']; ?>" class="quantity" value="1" min="1" type="number"></td>
                <td>$<?= $subTotal = $rwss['price'] * 1; ?></td>
            </tr>
        <?php
            $total = $total + $subTotal;
        }
        ?>

    </table>
    <table style="position: sticky; bottom:-20px;" class="table table-bordered table-primary">
        <tr>
            <th>Total</th>
            <td>$<?= $total; ?></td>
        </tr>
    </table>
    <?php
}
if (isset($_POST['saveUser'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $phone = $_POST['phone'];
    $idNum = $_POST['idNum'];
    $gender = $_POST['gender'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $username = $_POST['username'];
    $username = strtolower($username);
    $departmentID = $_POST['departmentID'];
    $pwd = $_POST['pwd'];
    $check = mysqli_query($sq, "SELECT * FROM users WHERE userName = '$username'");
    $numrows = mysqli_num_rows($check);
    if ($numrows == 0) {
        $hash = password_hash($pwd, PASSWORD_DEFAULT);
        $query = mysqli_query($sq, "INSERT INTO `users`(`name`, `surname`, `userName`, `userPassword`, `idNum`, `phone`, `departmentID`, `gender`, `DOB`) VALUES ('$name','$surname','$username','$hash','$idNum','$phone','$departmentID','$gender','$dateOfBirth')") or die(mysqli_error($sq));
        if ($query) {
            echo "<script>alert('Successfully saved user!')</script>";

            $query1 =  mysqli_query($sq, "SELECT * FROM `users` order by dateUpdated asc");
    ?>
            <table id="example1" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>User Name</th>
                        <th>Date of Birth</th>
                        <th>ID number</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($rows = mysqli_fetch_assoc($query1)) {
                    ?>
                        <tr>
                            <td><?= $rows['name']; ?></td>
                            <td><?= $rows['surname']; ?></td>
                            <td><?= $rows['userName']; ?></td>
                            <td><?= $rows['DOB']; ?></td>
                            <td><?= $rows['idNum']; ?></td>
                            <td><a href=""><i class="fa fa-pen"></i></a></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php
        } else {
            echo "<script>alert('Something went wrong : (')</script>";
            $query1 =  mysqli_query($sq, "SELECT * FROM `users` order by dateUpdated asc");
        ?>
            <table id="example1" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>User Name</th>
                        <th>Date of Birth</th>
                        <th>ID number</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($rows = mysqli_fetch_assoc($query1)) {
                    ?>
                        <tr>
                            <td><?= $rows['name']; ?></td>
                            <td><?= $rows['surname']; ?></td>
                            <td><?= $rows['userName']; ?></td>
                            <td><?= $rows['DOB']; ?></td>
                            <td><?= $rows['idNum']; ?></td>
                            <td><a href=""><i class="fa fa-pen"></i></a></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php
        }
    } else {
        echo "<script>alert('Username exists!')</script>";
        $query1 =  mysqli_query($sq, "SELECT * FROM `users` order by dateUpdated asc");
        ?>
        <table id="example1" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>User Name</th>
                    <th>Date of Birth</th>
                    <th>ID number</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($rows = mysqli_fetch_assoc($query1)) {
                ?>
                    <tr>
                        <td><?= $rows['name']; ?></td>
                        <td><?= $rows['surname']; ?></td>
                        <td><?= $rows['userName']; ?></td>
                        <td><?= $rows['DOB']; ?></td>
                        <td><?= $rows['idNum']; ?></td>
                        <td><a href=""><i class="fa fa-pen"></i></a></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    <?php
    }
    ?>
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
    </script>
<?php
}
if (isset($_POST['login'])) {
    $userName = $_POST['userName'];
    $userPassword = $_POST['userPassword'];
    $userName = mysqli_real_escape_string($sq, $userName);
    $userPassword = mysqli_real_escape_string($sq, $userPassword);
    // $verified = password_verify($CLEAR, $hash);
    $check = mysqli_query($sq, "SELECT * FROM users WHERE userName = '$userName'");
    $rows = mysqli_fetch_array($check);
    if (!isset($rows['userName'])) {
        echo "<script>document.getElementById('error').innerHTML='The username you entered does not exist!'</script>";
    } else {
        $hash = $rows['userPassword'];
        $verified = password_verify($userPassword, $hash);
        if ($verified) {
            $departmentID = $rows['departmentID'];
            if ($departmentID == 4) {
                $_SESSION['userName'] = $userName;
                $_SESSION['departmentID'] = $departmentID;
                echo "<script> window.location.replace('admin.php'); </script>";
            } else {
                $_SESSION['userName'] = $userName;
                $_SESSION['departmentID'] = $departmentID;
                echo "<script> window.location.replace('./dashboard'); </script>";
            }
        } else {
            echo "<script>document.getElementById('error').innerHTML='Wrong password please try again!'</script>";
        }
    }
}

if (isset($_POST['editItem'])) {
    $itemID = $_POST['itemID'];
    $barCode = $_POST['barCode'];
    $itemName = $_POST['itemName'];
    $descr = $_POST['descr'];
    $itemTypeID = $_POST['itemTypeID'];
    $priceUSD = $_POST['priceUSD'];
    $priceZWL = $_POST['priceZWL'];
    $query = mysqli_query($sq, "SELECT * FROM items WHERE id = '$itemID'");
    $rows3 = mysqli_fetch_array($query);
    if ($itemName == $rows3['itemName'] && $descr == $rows3['itemDescription'] && $itemTypeID == $rows3['itemTypeID'] && $priceUSD == $rows3['priceUSD'] && $priceZWL == $rows3['priceZWL'] && $barCode == $rows3['barCode']) {
        echo "<script>alert('No changes was made');</script>";
    } else {
        $query1 = mysqli_query($sq, "UPDATE items SET `itemName`='$itemName',`itemDescription`='$descr',`itemTypeID`='$itemTypeID',`priceUSD`='$priceUSD',`priceZWL`='$priceZWL',`barCode`='$barCode' WHERE id = '$itemID'");
    }
    if (isset($query1)) {
        if ($query1) {
            echo "<script>alert('The changes was successfuly saved');</script>";
        }
    }


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
                    <td><?= $rows['id']; ?></td>
                    <td><?= $rows['itemName']; ?></td>
                    <td><?= $rows['itemDescription']; ?></td>
                    <td><?= $rows['priceUSD']; ?></td>
                    <td><?= $rows['priceZWL']; ?></td>
                    <td>
                        <?php
                        $itemID = $rows['itemTypeID'];
                        $getType = mysqli_query($sq, "SELECT * FROM itemtypes WHERE id = '$itemID'");
                        $rww = mysqli_fetch_array($getType);
                        echo $rww['itemTypeDesc'];

                        ?>
                    </td>
                    <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-lg"><i id="<?= $rows['id']; ?>" class="edit fas fa-pen-alt"></i></a></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

<?php }
if (isset($_POST['saveItem'])) {
    $itemName = $_POST['itemName'];
    $descr = $_POST['descr'];
    $itemTypeID = $_POST['itemTypeID'];
    $priceUSD = $_POST['priceUSD'];
    $quantity = $_POST['quantity'];
    $barCode = $_POST['barCode'];
    $priceZWL = $_POST['priceZWL'];
    $query1 = mysqli_query($sq, "INSERT INTO `items`(`itemName`, `itemDescription`, `itemTypeID`, `priceUSD`, `priceZWL`, `quantity`, `barCode`) VALUES ('$itemName','$descr','$itemTypeID','$priceUSD','$priceZWL','$quantity','$barCode')");
    if (isset($query1)) {
        if ($query1) {
            echo "<script>alert('Successfuly saved!');</script>";
        }
    }


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
                    <td><?= $rows['id']; ?></td>
                    <td><?= $rows['itemName']; ?></td>
                    <td><?= $rows['itemDescription']; ?></td>
                    <td><?= $rows['priceUSD']; ?></td>
                    <td><?= $rows['priceZWL']; ?></td>
                    <td>
                        <?php
                        $itemID = $rows['itemTypeID'];
                        $getType = mysqli_query($sq, "SELECT * FROM itemtypes WHERE id = '$itemID'");
                        $rww = mysqli_fetch_array($getType);
                        echo $rww['itemTypeDesc'];

                        ?>
                    </td>
                    <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-lg"><i id="<?= $rows['id']; ?>" class="edit fas fa-pen-alt"></i></a></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
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
    </script>
<?php }
//add qty
if (isset($_POST['editQty'])) {
    $itemID = $_POST['itemID'];
    $qty = $_POST['qty'];
    $query = mysqli_query($sq, "UPDATE `orders` SET `quantity`='$qty' WHERE `id`='$itemID' AND `ordered`='0'");
    $qry = mysqli_query($sq, "SELECT * FROM orders WHERE ordered='0' AND billing = '0'");
?>
    <table id="tble" class="table">
        <tr>
            <th>#</th>
            <th>Items</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Sub-total</th>
        </tr>
        <?php
        $subTotal = 0;
        $total = 0;
        while ($rwss = mysqli_fetch_assoc($qry)) {
        ?>
            <tr>
                <td><?= $rwss['id']; ?></td>
                <td><?php
                    $itemID1 = $rwss['ItemID'];
                    $gett = mysqli_query($sq, "SELECT * FROM items WHERE id = '$itemID1'");
                    $rrws = mysqli_fetch_array($gett);
                    $itemDescription = $rrws['itemDescription'];
                    echo $itemDescription;
                    ?></td>
                <td>$<?= $rwss['price']; ?></td>
                <td><input id="<?= $rwss['id']; ?>" value="<?= $rwss['quantity']; ?>" class="quantity" value="1" min="1" type="number"></td>
                <td>$<?= $subTotal = $rwss['price'] * $rwss['quantity']; ?></td>
            </tr>
        <?php
            $total = $total + $subTotal;
        }
        ?>

    </table>
    <table style="position: sticky; bottom:-20px;" class="table table-bordered table-primary">
        <tr>
            <th>Total</th>
            <td>$<?= $total; ?></td>
        </tr>
    </table>
<?php
}
if (isset($_POST['editQty2'])) {
    $itemID = $_POST['itemID'];
    $orderNum = $_POST['orderNum'];
    $qty = $_POST['qty'];
    $query = mysqli_query($sq, "UPDATE `orders` SET `quantity`='$qty' WHERE `id`='$itemID' AND `ordered`='0'");
    $qry = mysqli_query($sq, "SELECT * FROM orders WHERE orderNum='$orderNum' AND billing = '0'");
?>
    <table id="tble" class="table">
        <tr>
            <th>#</th>
            <th>Items</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Sub-total</th>
        </tr>
        <?php
        $subTotal = 0;
        $total = 0;
        while ($rwss = mysqli_fetch_assoc($qry)) {
        ?>
            <tr>
                <td>

                </td>
                <td><?php
                    $itemID1 = $rwss['ItemID'];
                    $gett = mysqli_query($sq, "SELECT * FROM items WHERE id = '$itemID1'");
                    $rrws = mysqli_fetch_array($gett);
                    $itemDescription = $rrws['itemDescription'];
                    echo $itemDescription;
                    ?></td>
                <td>$<?= $rwss['price']; ?></td>
                <td><input id="<?= $rwss['id']; ?>" value="<?= $rwss['quantity']; ?>" class="quantity" value="1" min="1" type="number"></td>
                <td>$<?= $subTotal = $rwss['price'] * $rwss['quantity']; ?></td>
            </tr>
        <?php
            $total = $total + $subTotal;
        }
        ?>

    </table>
    <table style="position: sticky; bottom:-20px;" class="table table-bordered table-primary">
        <tr>
            <th>Total</th>
            <td>$<?= $total; ?></td>
        </tr>
    </table>
<?php
}
if (isset($_POST['removeItem'])) {
    $itemID = $_POST['itemID'];
    $qty = $_POST['qty'];
    $pwd = $_POST['pwd'];
    $orderNum = $_POST['orderNum'];

    $getAdmin = mysqli_query($sq, "SELECT * FROM users WHERE departmentID = '4'");
    $rows = mysqli_fetch_array($getAdmin);
    $hash = $rows['userPassword'];
    $verified = password_verify($pwd, $hash);

    if ($verified) {
        if (!isset($qty) || $qty == "" || $qty == 0) {
            $query = mysqli_query($sq, "DELETE FROM `orders` WHERE `id`='$itemID'") or die(mysqli_error($sq));
        } else {
            $query = mysqli_query($sq, "UPDATE `orders` SET `quantity`='$qty' WHERE `id`='$itemID'") or die(mysqli_error($sq));
        }
    } else {
        echo "<script>alert('Failed, the password you entered was incorrect!');</script>";
    }

    if ($orderNum == "") {
        $qry = mysqli_query($sq, "SELECT * FROM orders WHERE orderNum='0' AND billing = '0'");
    } else {
        $qry = mysqli_query($sq, "SELECT * FROM orders WHERE orderNum='$orderNum' AND billing = '0'");
    }


?>
    <table id="tble" class="table">
        <tr>
            <th>#</th>
            <th>Items</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Sub-total</th>
        </tr>
        <?php
        $subTotal = 0;
        $total = 0;
        while ($rwss = mysqli_fetch_assoc($qry)) {
        ?>
            <tr>
                <td></td>
                <td><?php
                    $itemID1 = $rwss['ItemID'];
                    $gett = mysqli_query($sq, "SELECT * FROM items WHERE id = '$itemID1'");
                    $rrws = mysqli_fetch_array($gett);
                    $itemDescription = $rrws['itemDescription'];
                    echo $itemDescription;
                    ?></td>
                <td>$<?= $rwss['price']; ?></td>
                <td><input id="<?= $rwss['id']; ?>" value="<?= $rwss['quantity']; ?>" class="quantity" value="1" min="1" type="number"></td>
                <td>$<?= $subTotal = $rwss['price'] * $rwss['quantity']; ?></td>
            </tr>
        <?php
            $total = $total + $subTotal;
        }
        ?>

    </table>
    <table style="position: sticky; bottom:-20px;" class="table table-bordered table-primary">
        <tr>
            <th>Total</th>
            <td>$<?= $total; ?></td>
        </tr>
    </table>
<?php
}

if (isset($_POST['clear'])) {



    $query = mysqli_query($sq, "DELETE FROM `orders` WHERE orderNum=''") or die(mysqli_error($sq));
    $qry = mysqli_query($sq, "SELECT * FROM orders WHERE orderNum='0' AND billing = '0'");


?>
    <table id="tble" class="table">
        <tr>
            <th>#</th>
            <th>Items</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Sub-total</th>
        </tr>

        <tr>
            <td colspan="6" style="text-align: center;">----</td>
        </tr>
    </table>
    <?php

}
if (isset($_POST['savePriv'])) {
    $query = "";
    $privilegeName = mysqli_real_escape_string($sq, $_POST['privilegeName']);
    $check = mysqli_query($sq, "SELECT * FROM `privilegenames` WHERE privilageName = '$privilegeName'");
    $numrows = mysqli_num_rows($check);
    if ($numrows == 0) {
        $query = mysqli_query($sq, "INSERT INTO `privilegenames`(`privilageName`) VALUES ('$privilegeName')");
        $get = mysqli_query($sq, "SELECT * FROM `privilegenames` WHERE privilageName = '$privilegeName'");
        $row = mysqli_fetch_array($get);
        $userGrpID = $row['id'];
        $insertQuery = mysqli_query($sq, "SELECT * FROM departments");
        while ($w = mysqli_fetch_assoc($insertQuery)) {
            $dfnUserGrpNameID = $w['id'];
            $query2 = mysqli_query($sq, "INSERT INTO `privileges`(`privilageID`, `privilageCode`, `dptID`) VALUES ('$userGrpID','0','$dfnUserGrpNameID')");
        }
    }
    if ($query) {
    ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>Successfully Saved!</strong>
        </div>

        <script>
            $(".alert").alert();
        </script>
    <?php
    } else {
    ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>Failed!</strong> Something went wrong
        </div>

        <script>
            $(".alert").alert();
        </script>
    <?php
    }
}
if (isset($_POST['savePriv2'])) {
    $dfnUserGrpNameID = mysqli_real_escape_string($sq, $_POST['dfnUserGrpNameID']);
    $userGrpID = mysqli_real_escape_string($sq, $_POST['userGrpID']);
    $dfnUserGrp = mysqli_real_escape_string($sq, $_POST['dfnUserGrp']);
    if ($dfnUserGrpNameID == 1) {
        $oppCode = 0;
    } else {
        $oppCode = 1;
    }
    // $check = mysqli_query($sq, "SELECT * FROM `privileges` WHERE `dptID`='$userGrpID' AND privilageCode = '$oppCode'");
    // $numrows = mysqli_num_rows($check);
    // if ($numrows == 0) {
    //     $query = mysqli_query($sq, "INSERT INTO `privileges`(`privilageID`, `privilageCode`, `dptID`) VALUES ('$userGrpID','$dfnUserGrp','$dfnUserGrpNameID')");
    // } else {
    $query = mysqli_query($sq, "UPDATE `privileges` SET `privilageCode`='$dfnUserGrp' WHERE `dptID`='$userGrpID' AND privilageID = '$dfnUserGrpNameID'");
    // }
}
if (isset($_POST['filterDpt'])) {
    $dptID = mysqli_real_escape_string($sq, $_POST['dptID']);
    $query = mysqli_query($sq, "SELECT * FROM users WHERE departmentID = '$dptID'");
    ?>
    <label for="">Users</label>
    <select class="form-control" multiple="multiple" name="" id="dptUsers">
        <?php
        while ($rt = mysqli_fetch_assoc($query)) {
        ?>
            <option value="<?= $rt['id']; ?>"><?= $rt['userName']; ?></option>
        <?php
        }
        ?>
    </select>
<?php
}
if (isset($_POST['assignUser'])) {
    $selectedUsers = $_POST['selectedUserID']; // This will be an array
    $selectedDpt = $_POST['selectedDpt'];

    $stmt = $sq->prepare("UPDATE `users` SET `departmentID`=? WHERE id = ?");
    $stmt->bind_param("ss", $selectedDpt, $selectedUserID);

    foreach ($selectedUsers as $selectedUserID) {
        $stmt->execute();
    }

    $query = mysqli_query($sq, "SELECT * FROM users WHERE departmentID = '$selectedDpt'");
?>
    <label for="">Users</label>
    <select class="form-control" multiple="multiple" name="" id="dptUsers">
        <?php
        while ($rt = mysqli_fetch_assoc($query)) {
        ?>
            <option value="<?= $rt['id']; ?>"><?= $rt['userName']; ?></option>
        <?php
        }
        ?>
    </select>
<?php
}
?>