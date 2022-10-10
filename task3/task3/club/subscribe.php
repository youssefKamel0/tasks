<?php

$title = 'subscribe';
include "includes/header.php";
include "includes/navbar.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $username = $_POST['username'];
    $familyNum = $_POST['count'];
    // first letter
    $familyNum_firstLetter = substr($familyNum, 0, 1);




    if (empty($username) || empty($familyNum) || $familyNum_firstLetter == 0) {

        $message = '<div class="alert alert-danger"> Please Enter Valid Data  </div>';
    } else {

        $_SESSION['familyData'] = $_POST;
        print_r($_SESSION);
        header('location:games.php');
        die;
    }
}




?>


<main>
    <div class="login-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <h3 class="mb-3 text-center">Subscribe Our Club</h3>
                    <div class="bg-white shadow rounded">
                        <div class="row">
                            <div class="col-md-5 ps-0 d-none d-md-block">
                                <div class="form-right h-100 text-white text-center row">
                                    <i class="bi bi-bootstrap"></i>
                                    <h2 class="fs-1">Welcome To Our Club!</h2>
                                </div>
                            </div>
                            <div class="col-md-7 pe-0">
                                <div class="form-left h-100 py-5 px-5">
                                    <form action="" class="row g-4" method="POST">
                                        <div class="col-12">
                                            <label>Club subscriber<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
                                                <input type="text" name="username" value="<?= $username ?? "" ?>" class="form-control" placeholder="Enter Your Name">
                                            </div>
                                            <small>Note: club subscription starts with 10,000Egp </small>
                                        </div>
                                        <div class="col-12">
                                            <label>Count Of Family Members<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
                                                <input type="number" name="count" class="form-control" placeholder="Enter number">
                                            </div>
                                            <small>Note: Every Member Costs 2,500Egp </small>
                                        </div>

                                        <div class="col-sm-6">
                                            <?= $message ?? "" ?>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-light btn-lg px-4 float-end mt-4">Subscribe</button>
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