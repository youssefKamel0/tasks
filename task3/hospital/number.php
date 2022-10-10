<?php

$title = 'number | Hospital';
include "includes/header.php";
include "includes/navbar.php";

if($_SERVER['REQUEST_METHOD'] == "POST") {

    $number = $_POST['number'];

    if (empty($number)) {

        $message = '<div class="alert alert-danger"> Please Enter Your Number </div>';

    } else {

        $_SESSION['user'] = $number;
        header('location:review.php');
        die;

    }

}




?>


<main>
    <div class="login-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <h3 class="mb-3 text-center">Hospital Feedback System</h3>
                    <div class="bg-white shadow rounded">
                        <div class="row">
                            <div class="col-md-5 ps-0 d-none d-md-block">
                                <div class="form-right h-100 text-white text-center row">
                                    <i class="bi bi-bootstrap"></i>
                                    <h2 class="fs-1">Welcome Back!</h2>
                                </div>
                            </div>
            <div class="col-md-7 pe-0">
                <div class="form-left h-100 py-5 px-5">
                    <form action="" class="row g-4" method="POST">
                        <div class="col-12">
                            <label>Number<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
                                <input type="number" name="number" class="form-control" placeholder="Enter Your Number">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <?= $message ?? "" ?>
                        </div>

                        <div class="col-12">
                            <button name="submit" class="btn btn-light btn-lg px-4 float-end mt-4">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</main>

<?php 


include "includes/footer.php";

?>