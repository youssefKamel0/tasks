<?php

$title = 'Games';
include "includes/header.php";
include "includes/navbar.php";


if (isset($_SESSION['familyData'])) {

    $clubSubscriber = $_SESSION['familyData']['username'][0];
    $numberOfFamilyUsers = $_SESSION['familyData']['count'][0];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";

        for ($i = 1 ; $i < $numberOfFamilyUsers + 1 ; $i++) {


            ${"member" . $i} = $_POST['member' . $i];

            if (empty(${"member" . $i})) {

                $message = '<div class="alert alert-danger"> Please Enter Members Name  </div>';

            }

        }


        if (empty($message) || !isset($message)) {

        $_SESSION['familyMembersAllData'] = $_POST;
        header('location:result.php');
        die;
    }





    }



} else {
    
    header('location:subscribe.php');
    die;
    
}



?>



<main>
    <div class="login-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <h3 class="mb-3 text-center">Subscribe Our Games</h3>
                    <div class="bg-white shadow rounded">
                        <div class="row">

            <div class="col-md-12 pe-0">
                <div class="form-left h-100 py-5 px-5">
                    <form action="" class="row g-4" method="POST">
                        <?php
                        
                        for ($i = 1 ; $i < $numberOfFamilyUsers +1; $i++) { ?>


                        <div class="col-12">
                            <p>member <?= $i ?? '' ?> </p>
                            <label>Club subscriber<span class="text-danger">*</span></label>
                            <div class="input-group"  style="margin-bottom:1rem ;">
                                <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
                                <input type="text" name="member<?= $i ?? '' ?>" value="<?= ${"member" . $i} ?? "" ?>" class="form-control" placeholder="Enter Member <?= $i?> Name">
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="membergames<?= $i ?? '' ?>[football]" type="checkbox" value="300">
                                <label class="form-check-label" for="flexCheckDefault">
                                    football <span>300</span> Egp
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" name="membergames<?= $i ?? '' ?>[swimming]" type="checkbox" value="250">
                                <label class="form-check-label" for="flexCheckChecked">
                                    swimming <span>250</span> Egp
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" name="membergames<?= $i ?? '' ?>[vollyball]" type="checkbox" value="150">
                                <label class="form-check-label" for="flexCheckChecked">
                                    vollyball <span>150</span> Egp
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" name="membergames<?= $i ?? '' ?>[others]" type="checkbox" value="100">
                                <label class="form-check-label" for="flexCheckChecked">
                                    others <span>100</span> Egp
                                </label>
                            </div>
                        </div>
                        <?php } ?>

                        <div class="col-sm-6">
                            <?= $message ?? "" ?>
                        </div>

                        <div class="col-12">
                            <button class="btn btn-light btn-lg px-4 float-end mt-4">Subscribe Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</main>

<?php 

?>