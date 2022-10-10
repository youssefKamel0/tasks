<?php

$title = "review";
include "includes/header.php";
include "includes/navbar.php";



if (isset($_SESSION['user'])) {

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        if (isset($_POST['cleanliness']) && isset($_POST['Prices']) && isset($_POST['nursing']) && isset($_POST['doctors']) && isset($_POST['calmness'])  ) {
            print_r($_POST);

            $cleanliness = $_POST['cleanliness'];
            $Prices = $_POST['Prices'];
            $nursing = $_POST['nursing'];
            $doctors = $_POST['doctors'];
            $calmness = $_POST['calmness'];
            $total = $cleanliness + $Prices + $nursing + $doctors + $calmness;
            $_SESSION['sur'] = $total;
            header("location:result.php");

        } else {

            $message = '<div class="alert alert-danger"> Please Chosse All Questions </div>';
        }
    }

} else {

    header("location:number.php");
    die;
}

?>
<div class="login-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <h3 class="mb-3 text-center">Give Us Your Feedback</h3>
                <div class="bg-white shadow rounded">
                    <div class="row">
                        <div class="col-md-7 pe-0" style="width: 100%;">
                            <div class="form-left h-100 py-5 px-5">
                                <form action="" method="POST">

                                    <?php 

                                    foreach($questions as $key => $question) { ?>

                                    <div class="bcont" style="display: flex;flex-direction: row;justify-content: space-between;align-items: center; margin-bottom: 1rem;">
                                        <div>
                                            <span><?= $question ?></span>
                                        </div>
                                        <div class="cont">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="<?= $key ?>" value="0">
                                                <label class="form-check-label" for="inlineRadio1">bad</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="<?= $key ?>" value="3">
                                                <label class="form-check-label" for="inlineRadio2">good</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="<?= $key ?>" value="5">
                                                <label class="form-check-label" for="inlineRadio1">very good</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="<?= $key ?>" value="10">
                                                <label class="form-check-label" for="inlineRadio2">excellent</label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>

                                    <?php } ?>

                                    <div class="col-sm-6">
                                        <?= $message ?? "" ?>
                                    </div>

                                    <div class="col-12">
                                        <button type="submit" class="btn btn-light px-4 float-end mt-4">Submit</button>
                                    </div>
                                </form>


                            </div>
                        </div>

                    </div>
                </div>








                <?php

                include "includes/footer.php";


                ?>