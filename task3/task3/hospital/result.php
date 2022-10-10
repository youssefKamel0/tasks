<?php

$title = 'result';
include "includes/header.php";
include "includes/navbar.php";


if (isset($_SESSION['user'])) {

    if (isset($_SESSION['sur'])) {

        if ($_SESSION['sur'] > grade/2) {

            $message = '<div class="alert alert-success"> Thank You For Your Time </div>';

        } else {

            $message = '<div class="alert alert-danger">We Are Sorry And We Will Call You On ';
            $message .= $_SESSION['user'];
            $message.='  </div>';
            
        }


    } else {

        header("location:review.php");
        die;

    }

} else {

    header("location:number.php");
    die;

}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    session_unset();
    header('location:number.php');

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
                                    <h2 class="fs-1">Thanks!</h2>
                                </div>
                            </div>
            <div class="col-md-7 pe-0">
                <div class="form-left h-100 py-5 px-5">
                    <form action="" class="row g-4" method="POST">
                        <div class="col-12">
                            <div class="input-group">
                                <?= $message ?? "" ?>
                            </div>
                        </div>

                        <div class="col-12">
                            <button name="submit" class="btn btn-light btn-lg px-4 float-end mt-4">Again</button>
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