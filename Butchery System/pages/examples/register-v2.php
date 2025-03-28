<!DOCTYPE html>
<html lang="en">
<?php
include_once("../../database/connect.php");
$courses = mysqli_query($sq, "SELECT * FROM courses");
$provinces = mysqli_query($sq, "SELECT * FROM provinces");
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Registration Page (v2)</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="../../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="../../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <!-- BS Stepper -->
    <link rel="stylesheet" href="../../plugins/bs-stepper/css/bs-stepper.min.css">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="../../plugins/dropzone/min/dropzone.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">

</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <style>
                    .register-box {
                        width: 544px;
                    }

                    .logo {

                        height: 75px;
                    }
                </style>
                <a href="../../index.php" class="h1"><b><img class="logo" src="../../dist/img/ZRCS Logo.png" alt=""></b></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Register a new student</p>
                <div id="result">

                </div>
                <form action="register.php" method="post">
                    <label>First Name</label>
                    <div class="input-group mb-3">

                        <input required name="Fname" id="Fname" type="text" class="form-control" placeholder="First Name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <label>Surname</label>
                    <div class="input-group mb-3">

                        <input required name="Sname" id="Sname" type="text" class="form-control" placeholder="Surname">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <label>Student Number</label>
                    <div class="input-group mb-3">

                        <input name="studentNumber" id="studentNumber" type="text" class="form-control" placeholder="Student Number">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <label>National ID</label>
                    <div class="input-group mb-3">

                        <input required name="nationalID" id="nationalID" type="text" class="form-control" placeholder="National ID">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-window-maximize"></span>
                            </div>
                        </div>
                    </div>
                    <label>Date of Birth</label>
                    <div class="input-group mb-3">

                        <input required name="dateOfBirth" id="dateOfBirth" type="date" class="form-control" placeholder="Date of Birth">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <label>Sex</label>
                    <div class="input-group mb-3">

                        <input required name="sex" list="sex1" id="sex" type="text" class="form-control" placeholder="Sex">
                        <datalist id="sex1">
                            <option value="Male"></option>
                            <option value="Female"></option>
                        </datalist>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <label>Email</label>
                    <div class="input-group mb-3">

                        <input id="email" name="email" type="email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <label>Course</label>
                    <div class="input-group mb-3">
                        <select class="form-control" required name="course" id="course">
                            <option value="" disabled selected></option>
                            <?php
                            while ($rows = mysqli_fetch_assoc($courses)) {
                            ?>
                                <option value="<?= $rows['courseID']; ?>"><?= $rows['courseName']; ?></option>
                            <?php } ?>
                        </select>

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-book"></span>
                            </div>
                        </div>
                    </div>
                    <label>Province</label>
                    <div class="input-group mb-3">
                        <select class="form-control" required name="provinceName" id="provinceName">
                            <option value="" disabled selected></option>
                            <?php
                            while ($rows1 = mysqli_fetch_assoc($provinces)) {
                            ?>
                                <option value="<?= $rows1['provinceID']; ?>"><?= $rows1['provinceName']; ?></option>
                            <?php } ?>
                        </select>

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-book"></span>
                            </div>
                        </div>
                    </div>
                    <label>Phone Number</label>
                    <div class="input-group mb-3">

                        <input required name="phoneNumber" id="phoneNumber" placeholder="Phone Number" type="text" class="form-control" data-inputmask="'mask': ['999-999-9999 [x99999]', '+099 99 99 9999[9]-9999']" data-mask>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <label>Date Started</label>
                    <div class="input-group mb-3 ">
                        <input required name="dateStarted" id="dateStarted" type="date" class="form-control" placeholder="Date of Birth">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-calendar"></span>
                            </div>
                        </div>
                    </div>
                    <!--
        <label>Certificate Number</label>
        <div class="input-group mb-3">
          
          <input name="certificateNum" id="certificateNum" type="text" class="form-control" placeholder="Certificate Number">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <!--<label></label>
        <div class="input-group mb-3">
          
          <input type="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <label></label>
          <input type="password" class="form-control" placeholder="Retype password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>-
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
                    <div class="col-4">
                        <button name="register" id="register" type="submit" class="btn btn-primary btn-block">
                            Register
                            <span style="visibility:hidden;" class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                        </button>
                    </div>
                    <!-- /.col -->
            </div>
            </form>
            <!--
      <div class="social-auth-links text-center">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Sign up using Google+
        </a>
      </div>

      <a href="login.html" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 -->
    <script src="../../plugins/select2/js/select2.full.min.js"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="../../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
    <!-- InputMask -->
    <script src="../../plugins/moment/moment.min.js"></script>
    <script src="../../plugins/inputmask/jquery.inputmask.min.js"></script>
    <!-- date-range-picker -->
    <script src="../../plugins/daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap color picker -->
    <script src="../../plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Bootstrap Switch -->
    <script src="../../plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <!-- BS-Stepper -->
    <script src="../../plugins/bs-stepper/js/bs-stepper.min.js"></script>
    <!-- dropzonejs -->
    <script src="../../plugins/dropzone/min/dropzone.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->

    <script src="../../jquery/jquery-3.5.1.js"></script>
    <!-- Page specific script -->
    <script>
        $(document).ready(function() {
            $("form").submit(function(event) {

                var Fname = $("#Fname").val();
                var email = $("#email").val();
                var Sname = $("#Sname").val();
                var course = $("#course").val();
                var provinceID = $("#provinceName").val();
                var studentNumber = $("#studentNumber").val();
                var nationalID = $("#nationalID").val();
                var dateOfBirth = $("#dateOfBirth").val();
                var sex = $("#sex").val();
                var phoneNumber = $("#phoneNumber").val();
                var dateStarted = $("#dateStarted").val();
                // var certificateNum = $("#certificateNum").val();

                $.ajax({
                    url: "register.php",
                    type: "post",
                    //async: false,
                    data: {
                        "register": 1,
                        "Fname": Fname,
                        "email": email,
                        "Sname": Sname,
                        "course": course,
                        "provinceID": provinceID,
                        "studentNumber": studentNumber,
                        "nationalID": nationalID,
                        "dateOfBirth": dateOfBirth,
                        "sex": sex,
                        "phoneNumber": phoneNumber,
                        "dateStarted": dateStarted,
                        //  "certificateNum": certificateNum
                    },
                    beforeSend: function() {
                        $("#register").html("loading...");
                        $(".spinner-grow").css("visibility", "visible");
                    },
                    success: function(data) {
                        $("#result").html(data);
                        $("#register").html("Register");
                        $(".spinner-grow").css("visibility", "hidden");
                        $("#Fname").focus();
                        $("#Fname").val("");
                        $("#email").val("");
                        $("#Sname").val("");
                        $("#studentNumber").val("");
                        $("#nationalID").val("");
                        $("#dateOfBirth").val("");
                        $("#sex").val("");
                        $("#phoneNumber").val("");
                        $("#dateStarted").val("");
                        // $("#certificateNum").val("");
                    }
                })

                event.preventDefault();
            });
        });
    </script>
</body>

</html>