<?php
include_once("../connection/connect.php");
if (isset($_POST['edit'])) {
    $itemID = $_POST['itemID'];
    $query = mysqli_query($sq, "SELECT * FROM items WHERE id = '$itemID'");
    $rwsw = mysqli_fetch_array($query);
?>
    <form>
        <div class="form-group">
            <label for="barCode">Bar Code</label>
            <input type="text" class="form-control" id="barCode" value="<?= $rwsw['barCode']; ?>" placeholder="Bar Code">
        </div>
        <div class="form-group">
            <label for="itemName">Item Name</label>
            <input type="text" style="display:none ;" id="itemID" value="<?= $rwsw['id']; ?>">
            <input type="text" class="form-control" id="itemName" value="<?= $rwsw['itemName']; ?>">
        </div>
        <div class="form-group">
            <label for="descr">Description</label>
            <textarea class="form-control" name="" id="descr" value="<?= $rwsw['itemDescription']; ?>" cols="30" rows="5"></textarea>
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
                    <option value="<?= $types['id']; ?>" <?php if ($itemTypeID == $types['id']) {
                                                                echo "selected";
                                                            } ?>><?= $types['itemTypeDesc']; ?>
                    </option>
                <?php
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="priceUSD">Price (USD)</label>
            <input type="number" class="form-control" id="priceUSD" value="<?= $rwsw['priceUSD']; ?>">
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput2">Price (ZWL)</label>
            <input type="number" class="form-control" id="priceZWL" value="<?= $rwsw['priceZWL']; ?>">
        </div>

    </form>
    <?php
}
if (isset($_POST['saveType'])) {
    $typeName = $_POST['typeName'];
    $query = mysqli_query($sq, "INSERT INTO `itemtypes`(`itemTypeDesc`) VALUES ('$typeName')");
    $query3 =  mysqli_query($sq, "SELECT * FROM `itemtypes` order by itemTypeDesc asc");
    while ($rows = mysqli_fetch_assoc($query3)) {
    ?>
        <button class="optionBtn" id="<?= $rows['id']; ?>" type="button"><?= $rows['itemTypeDesc']; ?></button>
    <?php
    }
}
if (isset($_POST['createOrder'])) {

    $check = mysqli_query($sq, "SELECT * FROM orders WHERE ordered='0'");
    $numrows = mysqli_num_rows($check);
    if ($numrows > 0) {
        $query = mysqli_query($sq, "INSERT INTO ordersession (`orders`) VALUES ('order')");
    }
    $qry = mysqli_query($sq, "SELECT * FROM ordersession ORDER BY id DESC LIMIT 1") or die(mysqli_error($sq));
    $rowwss = mysqli_fetch_array($qry);
    $orderNum = $rowwss['id'];

    $query1 = mysqli_query($sq, "UPDATE `orders` SET `ordered`='1',`orderNum`='$orderNum' WHERE `ordered`='0'");
    echo  $orderNum;
}
if (isset($_POST['saveComp'])) {
    $companyName = $_POST['companyName'];
    $companyEmail = $_POST['companyEmail'];
    $phone = $_POST['phone'];
    $companyDesc = $_POST['companyDesc'];
    $vat = $_POST['vat'];
    $address = $_POST['address'];
    $fax = $_POST['fax'];
    $fileName = $_FILES['logo']['name'];
    $temp1 = $_FILES['logo']['tmp_name'];
    $allowdEXT = array('png', 'jpg', 'jpeg', 'gif');
    $fileSize = $_FILES['logo']['size'];
    $targetDir = "../uploads/${fileName}";
    $fileEXT = explode('.', $fileName);
    $fileEXT = strtolower(end($fileEXT));
    if (in_array($fileEXT, $allowdEXT) || $fileName == '') {
        if ($fileSize <= 10000000) {
            $chech = mysqli_query($sq, "SELECT * FROM company");
            $numrows = mysqli_num_rows($chech);
            if ($numrows == 0) {
                $query = mysqli_query($sq, "INSERT INTO `company`(`companyName`, `companyPhone`, `companyEmail`, `companyDesc`, `vatNo`, `companyAddress`, `companyLogo`, `companyFax`) VALUES ('$companyName','$phone','$companyEmail','$companyDesc','$vat','$address','$fileName','$fax')");
                move_uploaded_file($temp1, $targetDir);
            } elseif ($fileName == '') {
                $query = mysqli_query($sq, "UPDATE `company` SET `companyName`='$companyName',`companyPhone`='$phone',`companyEmail`='$companyEmail',`companyDesc`='$companyDesc',`vatNo`='$vat',`companyAddress`='$address',`companyFax`='$fax'") or die(mysqli_error($sq));
                move_uploaded_file($temp1, $targetDir);
            } else {
                $query = mysqli_query($sq, "UPDATE `company` SET `companyName`='$companyName',`companyPhone`='$phone',`companyEmail`='$companyEmail',`companyDesc`='$companyDesc',`vatNo`='$vat',`companyAddress`='$address',`companyLogo`='$fileName',`companyFax`='$fax'") or die(mysqli_error($sq));
                move_uploaded_file($temp1, $targetDir);
            }
            $messege = "success";
        } else {
            $messege = "large";
        }
    } else {
        $messege = "null";
    }
    header('Location: ../tools.php?message=' . $messege);
    echo $messege;
}
if (isset($_POST['search1'])) {
    $searchOrder = $_POST['searchOrder'];
    $searchOrder = mysqli_real_escape_string($sq, $searchOrder);

    $qry = mysqli_query($sq, "SELECT * FROM orders WHERE orderNum = '$searchOrder'");
    $numrws = mysqli_num_rows($qry);

    if ($numrws > 0) {
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
    } else {
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
                <td colspan="4" style="color: red;">No records found</td>
            </tr>
        </table>

<?php
    }
}
if (isset($_POST['search2'])) {
    $searchOrder = $_POST['searchOrder'];
    $searchOrder = mysqli_real_escape_string($sq, $searchOrder);
    $qry = mysqli_query($sq, "SELECT * FROM orders WHERE orderNum='$searchOrder' AND billing = '0'");
    $rww = mysqli_fetch_array($qry);
    if (isset($rww['orderNum'])) {
        echo $rww['orderNum'];
    }
}
