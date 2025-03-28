<?php
include_once("./connection/connect.php");
session_start();
if (!isset($_GET['orderNum']) || $_GET['orderNum'] == 0) {
    echo "
  <script>
  alert('Error, failed to print invoice!');
  window.close();
  </script>
  ";
} else {

    $orderNum = $_GET['orderNum'];
    $getQty = mysqli_query($sq, "SELECT * FROM orders WHERE `orderNum`='$orderNum'");
}
$username = $_SESSION['userName'];
$getComp = mysqli_query($sq, "SELECT * FROM company LIMIT 1");
$rws = mysqli_fetch_array($getComp);

$total = 0;
$query = mysqli_query($sq, "SELECT * FROM orders WHERE orderNum = '$orderNum'");
while ($rows = mysqli_fetch_assoc($query)) {
    $total = $total + $rows['price'];
}
$check = mysqli_query($sq, "SELECT * FROM sales WHERE orderID='$orderNum'");
$invo = mysqli_query($sq, "SELECT * FROM sales ORDER BY id DESC LIMIT 1");
$numrows = mysqli_num_rows($check);
$rew = mysqli_fetch_array($invo);
if (!isset($rew['id'])) {
    $num2 = 0;
} else {
    $num2 = $rew['id'];
}
$invoiceNum = 'RST' . $num2;
// $checkInvoice = mysqli_query($sq, "SELECT * FROM sales WHERE orderID='$orderNum'");
// $numrowss = mysqli_num_rows($checkInvoice);
if ($numrows == 0) {
    $copy = "";
    // $currency = $_GET['modeOfPayment'];
    // if ($orderNum != '' || $orderNum != 0) {

    //     $saveSales = mysqli_query($sq, "INSERT INTO sales (`invoiceID`, `orderID`, `currency`, `amount`,`user`)VALUES('$invoiceNum','$orderNum','$currency','$total','$username')") or die(mysqli_error($sq));
    //     $updateOrde = mysqli_query($sq, "UPDATE `orders` SET `billing`='1' WHERE `orderNum`='$orderNum'");
    // }
} else {
    $copy = "<h1>COPY</h1>";
}
$invo1 = mysqli_query($sq, "SELECT * FROM sales ORDER BY id DESC LIMIT 1");
$rews = mysqli_fetch_array($invo1);

$invoiceNum = $rews['invoiceID'];
$timedate = $rews['dateTime'];
$timedate = new DateTime($timedate);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
</head>

<body onload="printInvoice();">
    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
            background: #ffffff;
        }

        div,
        p,
        a,
        li,
        td {
            -webkit-text-size-adjust: none;
        }

        body {
            width: 88mm;
            height: 100%;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;

        }

        p {
            padding: 0 !important;
            margin-top: 0 !important;
            margin-right: 0 !important;
            margin-bottom: 0 !important;
            margin-left: 0 !important;
        }

        .visibleMobile {
            display: none;
        }

        .hiddenMobile {
            display: block;
        }
    </style>

    <!-- Header -->
    <?= $copy; ?>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <!-- <link rel="stylesheet" href="./dist/css/adminlte.min.css"> -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./fonts/fontawesome/css/all.min.css">
    <table width="100%" border="0" cellpadding='2' cellspacing="2" bgcolor="#ffffff" style="padding-top:4px;">
        <tbody>
            <tr>
                <td style="font-size: 12px; color: #5b5b5b; font-family: 'Open Sans', sans-serif; line-height: 

18px; vertical-align: bottom; text-align: center;">
                    <strong style="font-size:16px;"><?= $rws['companyName']; ?></strong>
                    <br>phone: <?= $rws['companyPhone']; ?>

                    <br><?= $rws['companyAddress']; ?>
                </td>
            </tr>
            <tr>
                <td height="2" colspan="0" style="border-bottom:1px solid #e4e4e4 "></td>
            </tr>
        </tbody>
    </table>

    <table width="100%" border="0" cellpadding="0" cellspacing="2">
        <tbody>
            <tr>
                <td colspan="100" style="font-size: 14px; color: #5b5b5b; font-family: 'Open Sans', sans-serif; line-height: 18px; vertical-align: bottom; text-align: center;">
                    <strong>Payment Receipt</strong>
                </td>
            </tr>
            <tr>
                <td style="font-size: 12px; color: #5b5b5b; font-family: 'Open Sans', sans-serif; line-height: 18px; vertical-align: bottom; text-align: left;">

                    <br>
                </td>
                <td style="font-size: 12px; color: #5b5b5b; font-family: 'Open Sans', sans-serif; line-height:18px; vertical-align: top; text-align: center;">
                    <br>INVOICE: #<?= $invoiceNum; ?>
                    <br><span id="datePrinted">Date: <?= date_format($timedate, "d/m/Y H:i:s"); ?></span>
                </td>
            </tr>
            <tr>
                <td height="2" colspan="100" style="padding-top:15px;border-bottom:1px solid #e4e4e4 "></td>
            </tr>
        </tbody>
    </table>

    <!-- /Header -->

    <!-- Table Total -->
    <table width="100%" border="0 " cellpadding="0" cellspacing="2" style="padding: 12px 0px 5px 2px">
        <tbody>
            <tr>
                <td style="font-size: 16px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 16px; vertical-align: top; text-align:left; padding-left:16px">Invoice Currency</td>
                <td style="font-size: 16px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 16px; vertical-align: top; text-align:left; white-space:nowrap; " width="100 "><?= $_GET['modeOfPayment']; ?></td>
            </tr>
            <tr>
                <td height="2" colspan="100" style="padding-top:8px;border-bottom:1px solid #e4e4e4 "></td>
            </tr>
        </tbody>
    </table>

    <table class="tble-cnt table table-bordered">
        <thead>
            <tr>
                <th>Item Description</th>
                <th>Amount</th>
                <th>Quantity</th>
                <th>Sub-Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $tott = 0;
            while ($r = mysqli_fetch_assoc($getQty)) {

            ?>
                <tr>
                    <td scope="row"><?php
                                    $itemID = $r['ItemID'];
                                    $getDesc = mysqli_query($sq, "SELECT * FROM items WHERE `id` = '$itemID'");
                                    $iteDesc = mysqli_fetch_array($getDesc);
                                    echo $iteDesc['itemName'];
                                    ?></td>
                    <td>$<?= $r['price']; ?></td>
                    <td><?= $r['quantity']; ?></td>
                    <td>$<?= $r['price'] * $r['quantity']; ?></td>
                </tr>
            <?php
                $tott = $tott + ($r['price'] * $r['quantity']);
            }
            if ($numrows == 0) {
                $copy = "";
                $currency = $_GET['modeOfPayment'];
                if ($orderNum != '' || $orderNum != 0) {

                    $saveSales = mysqli_query($sq, "INSERT INTO sales (`invoiceID`, `orderID`, `currency`, `amount`,`user`)VALUES('$invoiceNum','$orderNum','$currency','$tott','$username')") or die(mysqli_error($sq));
                    $updateOrde = mysqli_query($sq, "UPDATE `orders` SET `billing`='1' WHERE `orderNum`='$orderNum'");
                }
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total</th>
                <td id="price">$<?= $tott; ?></td>
            </tr>
            <tr>
                <th colspan="3">Amount Paid</th>
                <td id="amntPayed">$<?= $_GET['amount']; ?></td>
            </tr>
        </tfoot>
    </table>
    <!-- <table width="100%" border="0 " cellpadding="0" cellspacing="2" align="center" style="padding: 12px 0px 5px 2px">
        <tbody>
            <tr>
                <td style="font-size: 16px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 16px; vertical-align: top; text-align:left; padding-left:16px ">
                    Amount:
                </td>
                <td style="font-size: 16px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 16px; vertical-align: top; text-align:left; white-space:nowrap; " width="100 ">

                    <span id="price"><?= $total; ?></span>
                </td>
            </tr>

        </tbody>
    </table>
    <table width="100%" border="0 " cellpadding="0" cellspacing="2" align="center" style="padding: 12px 0px 5px 2px">
        <tbody>
            <tr>
                <td style="font-size: 16px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 16px; vertical-align: top; text-align:left; padding-left:16px ">
                    Amount Paid:
                </td>
                <td style="font-size: 16px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 16px; vertical-align: top; text-align:left; white-space:nowrap; " width="100 ">
                    <span id="amntPayed"><?= $_GET['amount']; ?></span>
                </td>
            </tr>
            <tr>
                <td height="2" colspan="100" style="padding-top:8px;border-bottom:1px solid #e4e4e4 "></td>
            </tr>
        </tbody>
    </table> -->
    <table width="100%" border="0 " cellpadding="0" cellspacing="2" align="center" style="padding: 12px 0px 5px 2px">
        <tbody>
            <tr>
                <td style="font-size: 16px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 16px; vertical-align: top; text-align:left; padding-left:16px ">
                    Change:
                </td>
                <td style="font-size: 16px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 16px; vertical-align: top; text-align:left; white-space:nowrap; " width="100 ">
                    $<span id="changee"></span>
                </td>
            </tr>
            <tr>
                <td height="2" colspan="100" style="padding-top:8px;border-bottom:1px solid #e4e4e4 "></td>
            </tr>
        </tbody>
    </table>
    <table class="table">
        <tbody>
            <td>Received by</td>
            <td><?= $rews['user']; ?></td>
        </tbody>
    </table>
    <!-- /Table Total -->
    <!-- Customer sign -->
    <!-- <table width="100% " border="0 " cellpadding="0" cellspacing="2" align="center" style="padding: 12px 0px 5px 2px">
        <tbody>
            <tr>
            </tr>
            <tr>
                <td style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 16px; vertical-align: top; text-align:right; padding-top:16px ">
                    Customer Signature
                </td>
            </tr>
            <tr>
                <td style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 16px; vertical-align: top; text-align:center; padding-top:16px">

                </td>
            </tr>
        </tbody>
    </table> -->
    <script src="./jquery/jquery-3.5.1.js"></script>
    <script>
        function printInvoice() {
            var price = $("#price").html();
            var amntPaid = $("#amntPayed").html();
            price = price.substring(1);
            amntPaid = amntPaid.substring(1);
            $("#changee").html(parseFloat(amntPaid - price).toFixed(2));
            window.print();

            // window.close();
        }
    </script>
</body>

</html>