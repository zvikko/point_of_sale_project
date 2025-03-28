<?php
include_once("../../database/connect.php");
if (isset($_POST['save1'])) {
    $studentID = $_POST['studentID'];
    $subjectCode = $_POST['subject'];
    $theoryMark = $_POST['theory'];
    $courseID = $_POST['courseID'];
    $check = mysqli_query($sq, "SELECT * FROM examresults WHERE studentID='$studentID' AND subjectCode = '$subjectCode'");
    $numrows = mysqli_num_rows($check);
    if ($theoryMark != "") {
        if ($numrows > 0) {
            $query = mysqli_query($sq, "UPDATE `examresults` SET `Theory`='$theoryMark' WHERE studentID='$studentID' AND subjectCode = '$subjectCode'");
        } else {
            $query = mysqli_query($sq, "INSERT INTO `examresults`(`subjectCode`, `courseID`,`studentID`, `Theory` ) VALUES ('$subjectCode','$courseID','$studentID','$theoryMark')");
        }
    }
    if ($query) {
        echo "
        <script>
        $(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            Toast.fire({
                icon: 'success',
                title: 'Succefully saved.'
            })
        })
        </script>";
    } else {
        echo "
        <script>
        $(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
        Toast.fire({
            icon: 'error',
            title: 'Failed! Something went wrong.'
        })
    })
        </script>";
    }
}
if (isset($_POST['save2'])) {
    $studentID = $_POST['studentID'];
    $subjectCode = $_POST['subject'];
    $fracturesMark = $_POST['fractures'];
    $courseID = $_POST['courseID'];
    $check = mysqli_query($sq, "SELECT * FROM examresults WHERE studentID='$studentID' AND subjectCode = '$subjectCode'");
    $numrows = mysqli_num_rows($check);
    if ($numrows > 0) {
        $query = mysqli_query($sq, "UPDATE `examresults` SET `Fractures`='$fracturesMark' WHERE studentID='$studentID' AND subjectCode = '$subjectCode'");
    } else {
        $query = mysqli_query($sq, "INSERT INTO `examresults`(`subjectCode`, `courseID`,`studentID`, `Fractures` ) VALUES ('$subjectCode','$courseID','$studentID','$fracturesMark')");
    }
    if ($query) {
        echo "
        <script>
        $(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            Toast.fire({
                icon: 'success',
                title: 'Succefully saved!.'
            })
        })
        </script>";
    } else {
        echo "
        <script>
        $(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            Toast.fire({
                icon: 'error',
                title: 'Failed! Something went wrong.'
            })
        })
        </script>";
    }
}
if (isset($_POST['save3'])) {
    $studentID = $_POST['studentID'];
    $subjectCode = $_POST['subject'];
    $bleedingAndWounds = $_POST['bleedingAndWounds'];
    $courseID = $_POST['courseID'];
    $check = mysqli_query($sq, "SELECT * FROM examresults WHERE studentID='$studentID' AND subjectCode = '$subjectCode'");
    $numrows = mysqli_num_rows($check);
    if ($numrows > 0) {
        $query = mysqli_query($sq, "UPDATE `examresults` SET `bleedingAndWounds`='$bleedingAndWounds' WHERE studentID='$studentID' AND subjectCode = '$subjectCode'");
    } else {
        $query = mysqli_query($sq, "INSERT INTO `examresults`(`subjectCode`, `courseID`,`studentID`, `bleedingAndWounds` ) VALUES ('$subjectCode','$courseID','$studentID','$bleedingAndWounds')");
    }
    if ($query) {
        echo "
        <script>
        $(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            Toast.fire({
                icon: 'success',
                title: 'Succefully saved!.'
            })
        })
        </script>";
    } else {
        echo "
        <script>
        $(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            Toast.fire({
                icon: 'error',
                title: 'Failed! Something went wrong.'
            })
        })
        </script>";
    }
}
if (isset($_POST['save4'])) {
    $studentID = $_POST['studentID'];
    $subjectCode = $_POST['subject'];
    $burnsAndSca = $_POST['burnsAndSca'];
    $courseID = $_POST['courseID'];
    $check = mysqli_query($sq, "SELECT * FROM examresults WHERE studentID='$studentID' AND subjectCode = '$subjectCode'");
    $numrows = mysqli_num_rows($check);
    if ($numrows > 0) {
        $query = mysqli_query($sq, "UPDATE `examresults` SET `burnsAndScalds`='$burnsAndSca' WHERE studentID='$studentID' AND subjectCode = '$subjectCode'");
    } else {
        $query = mysqli_query($sq, "INSERT INTO `examresults`(`subjectCode`, `courseID`,`studentID`, `burnsAndScalds` ) VALUES ('$subjectCode','$courseID','$studentID','$burnsAndSca')");
    }
    if ($query) {
        echo "
        <script>
        $(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            Toast.fire({
                icon: 'success',
                title: 'Succefully saved!.'
            })
        })
        </script>";
    } else {
        echo "
        <script>
        $(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            Toast.fire({
                icon: 'error',
                title: 'Failed! Something went wrong.'
            })
        })
        </script>";
    }
}
if (isset($_POST['save5'])) {
    $studentID = $_POST['studentID'];
    $subjectCode = $_POST['subject'];
    $managementOfShock = $_POST['managementOfShock'];
    $courseID = $_POST['courseID'];
    $check = mysqli_query($sq, "SELECT * FROM examresults WHERE studentID='$studentID' AND subjectCode = '$subjectCode'");
    $numrows = mysqli_num_rows($check);
    if ($numrows > 0) {
        $query = mysqli_query($sq, "UPDATE `examresults` SET `managementOfShock`='$managementOfShock' WHERE studentID='$studentID' AND subjectCode = '$subjectCode'");
    } else {
        $query = mysqli_query($sq, "INSERT INTO `examresults`(`subjectCode`, `courseID`,`studentID`, `managementOfShock` ) VALUES ('$subjectCode','$courseID','$studentID','$managementOfShock')");
    }
    if ($query) {
        echo "
        <script>
        $(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            Toast.fire({
                icon: 'success',
                title: 'Succefully saved!.'
            })
        })
        </script>";
    } else {
        echo "
        <script>
        $(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            Toast.fire({
                icon: 'error',
                title: 'Failed! Something went wrong.'
            })
        })
        </script>";
    }
}
if (isset($_POST['save6'])) {
    $studentID = $_POST['studentID'];
    $subjectCode = $_POST['subject'];
    $emergency = $_POST['emergency'];
    $courseID = $_POST['courseID'];
    $check = mysqli_query($sq, "SELECT * FROM examresults WHERE studentID='$studentID' AND subjectCode = '$subjectCode'");
    $numrows = mysqli_num_rows($check);
    if ($numrows > 0) {
        $query = mysqli_query($sq, "UPDATE `examresults` SET `emergencyRescuscitation`='$emergency' WHERE studentID='$studentID' AND subjectCode = '$subjectCode'");
    } else {
        $query = mysqli_query($sq, "INSERT INTO `examresults`(`subjectCode`, `courseID`,`studentID`, `emergencyRescuscitation` ) VALUES ('$subjectCode','$courseID','$studentID','$emergency')");
    }
    if ($query) {
        echo "
        <script>
        $(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            Toast.fire({
                icon: 'success',
                title: 'Succefully saved!.'
            })
        })
        </script>";
    } else {
        echo "
        <script>
        $(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            Toast.fire({
                icon: 'error',
                title: 'Failed! Something went wrong.'
            })
        })
        </script>";
    }
}
if (isset($_POST['save7'])) {
    $studentID = $_POST['studentID'];
    $subjectCode = $_POST['subject'];
    $certificateNo = $_POST['certificateNo'];
    $courseID = $_POST['courseID'];
    $check = mysqli_query($sq, "SELECT * FROM examresults WHERE studentID='$studentID' AND subjectCode = '$subjectCode'");
    $numrows = mysqli_num_rows($check);
    if ($numrows > 0) {
        $query = mysqli_query($sq, "UPDATE `examresults` SET `certificateNo`='$certificateNo' WHERE studentID='$studentID' AND subjectCode = '$subjectCode'");
    } else {
        $query = mysqli_query($sq, "INSERT INTO `examresults`(`subjectCode`, `courseID`,`studentID`, `certificateNo` ) VALUES ('$subjectCode','$courseID','$studentID','$certificateNo')");
    }
    if ($query) {
        echo "
        <script>
        $(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            Toast.fire({
                icon: 'success',
                title: 'Succefully saved!.'
            })
        })
        </script>";
    } else {
        echo "
        <script>
        $(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            Toast.fire({
                icon: 'error',
                title: 'Failed! Something went wrong.'
            })
        })
        </script>";
    }
}
