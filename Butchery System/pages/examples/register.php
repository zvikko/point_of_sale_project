<?php
include_once("../../database/connect.php");
if (isset($_POST['register'])) {
    $Fname = $_POST['Fname'];
    $Fname = mysqli_real_escape_string($sq, $Fname);
    $Sname = $_POST['Sname'];
    $Sname = mysqli_real_escape_string($sq, $Sname);
    $course = $_POST['course'];
    $course = mysqli_real_escape_string($sq, $course);
    $provinceID = $_POST['provinceID'];
    $provinceID = mysqli_real_escape_string($sq, $provinceID);
    $studentNumber = $_POST['studentNumber'];
    $studentNumber = mysqli_real_escape_string($sq, $studentNumber);
    $nationalID = $_POST['nationalID'];
    $nationalID = mysqli_real_escape_string($sq, $nationalID);
    $dateOfBirth = $_POST['dateOfBirth'];
    $dateOfBirth = mysqli_real_escape_string($sq, $dateOfBirth);
    $ssex = $_POST['sex'];
    $ssex = mysqli_real_escape_string($sq, $ssex);
    $eemail = $_POST['email'];
    $eemail = mysqli_real_escape_string($sq, $eemail);
    $phoneNumber = $_POST['phoneNumber'];
    $phoneNumber = mysqli_real_escape_string($sq, $phoneNumber);
    $dateStarted = $_POST['dateStarted'];
    $dateStarted = mysqli_real_escape_string($sq, $dateStarted);

    //$certificateNum = $_POST['certificateNum'];
    $query = mysqli_query($sq, "INSERT INTO `trainingstudents` (`trainingStudentNumber`, `trainingStudentName`, `trainingStudentSurname`, `trainingStudentNationalID`, `trainingStudentSex`, `trainingStudentDateOfBirth`, `trainingStudentMobile`, `trainingStudentEmail`, `trainingStudentDateStarted`,`courseID`,`trainingStudentProvince`) VALUES ('$studentNumber','$Fname','$Sname','$nationalID','$ssex','$dateOfBirth','$phoneNumber','$eemail','$dateStarted','$course','$provinceID')") or die("Failed to query database " . mysqli_error($sq));
    $getStudent = mysqli_query($sq, "SELECT * FROM trainingstudents WHERE trainingStudentNumber= '$studentNumber'") or die("Failed to query database " . mysqli_error($sq));
    $rows = mysqli_fetch_array($getStudent);
    $studentID = $rows['trainingStudentID'];
    $query2 = mysqli_query($sq, "INSERT INTO studentcourses (studentID,courseID) VALUES ('$studentID','$course')");
    if ($query) {
?>
        <div class="alert alert-success">
            Information saved.
        </div>
    <?php
    } else {
    ?>
        <div class="alert alert-danger">
            <b>Failed!</b> Something went wrong.
        </div>
<?php
    }
}
