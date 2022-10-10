<?php

$title = 'Games';
include "includes/header.php";
include "includes/navbar.php";


if (isset($_SESSION['familyData'])) {

    // get number Of Family Users
    $numberOfFamilyUsers = $_SESSION['familyData']['count'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        for ($i = 1 ; $i < $numberOfFamilyUsers + 1 ; $i++) {


            // get every member and store it in variable ===> $member1 = $session['member'] 
            ${"member" . $i} = $_POST['member' . $i];

            // this to check that every member name is not empty
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
                        
                        // loop to make users that users typed in first page
                        for ($i = 1 ; $i < $numberOfFamilyUsers +1; $i++) { ?>

                            <div class="col-12">
                                <p>member <?= $i ?? '' ?> </p>
                                <label>Club subscriber<span class="text-danger">*</span></label>
                                <div class="input-group"  style="margin-bottom:1rem ;">
                                    <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
                                    <!-- i make every member take name dynamic, first member will take 'member1' and second will take 'member2' and so on -->
                                    <input type="text" name="member<?= $i ?? '' ?>" value="<?= ${"member" . $i} ?? "" ?>" class="form-control" placeholder="Enter Member <?= $i?> Name">
                                </div>

                                <?php

                                foreach ($games as $game => $price) { ?>

                                    <div class="form-check">
                                        <!-- important ==> 'php input array -->
                                        <input class="form-check-input" name="membergames<?= $i ?? '' ?>[<?=$game?>]" type="checkbox" value="<?= $price ?>">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            <?= $game ?> <span><?= $price ?></span> Egp
                                        </label>
                                    </div>

                                <?php } ?>

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