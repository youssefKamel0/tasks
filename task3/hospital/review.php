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
            define("grade", 50);
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
                                    <div class="bcont" style="display: flex;flex-direction: row;justify-content: space-between;align-items: center; margin-bottom: 1rem;">
                                        <div>
                                            <span>Are You Satisfied with the level of cleanliness ?</span>
                                        </div>
                                        <div class="cont">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="cleanliness" value="0">
                                                <label class="form-check-label" for="inlineRadio1">bad</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="cleanliness" value="3">
                                                <label class="form-check-label" for="inlineRadio2">good</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="cleanliness" value="5">
                                                <label class="form-check-label" for="inlineRadio1">very good</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="cleanliness" value="10">
                                                <label class="form-check-label" for="inlineRadio2">excellent</label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="bcont" style="display: flex;flex-direction: row;justify-content: space-between;align-items: center; margin-bottom: 1rem;">
                                        <div>
                                            <span>Are You Satisfied with the Service Prices ?</span>
                                        </div>
                                        <div class="cont">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="Prices" value="0">
                                                <label class="form-check-label" for="inlineRadio1">bad</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="Prices" value="3">
                                                <label class="form-check-label" for="inlineRadio2">good</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="Prices" value="5">
                                                <label class="form-check-label" for="inlineRadio1">very good</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="Prices" value="10">
                                                <label class="form-check-label" for="inlineRadio2">excellent</label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="bcont" style="display: flex;flex-direction: row;justify-content: space-between;align-items: center; margin-bottom: 1rem;">
                                        <div>
                                            <span>Are You Satisfied with the nursing service ?</span>
                                        </div>
                                        <div class="cont">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="nursing" value="0">
                                                <label class="form-check-label" for="inlineRadio1">bad</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="nursing" value="3">
                                                <label class="form-check-label" for="inlineRadio2">good</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="nursing" value="5">
                                                <label class="form-check-label" for="inlineRadio1">very good</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="nursing" value="10">
                                                <label class="form-check-label" for="inlineRadio2">excellent</label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="bcont" style="display: flex;flex-direction: row;justify-content: space-between;align-items: center; margin-bottom: 1rem;">
                                        <div>
                                            <span>Are You Satisfied with the level of the doctors ?</span>
                                        </div>
                                        <div class="cont">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="doctors" value="0">
                                                <label class="form-check-label" for="inlineRadio1">bad</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="doctors" value="3">
                                                <label class="form-check-label" for="inlineRadio2">good</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="doctors" value="5">
                                                <label class="form-check-label" for="inlineRadio1">very good</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="doctors" value="10">
                                                <label class="form-check-label" for="inlineRadio2">excellent</label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="bcont" style="display: flex;flex-direction: row;justify-content: space-between;align-items: center; margin-bottom: 1rem;">
                                        <div>
                                            <span>Are You Satisfied with the calmness in the hospital ?</span>
                                        </div>
                                        <div class="cont">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="calmness" value="0">
                                                <label class="form-check-label" for="inlineRadio1">bad</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="calmness" value="3">
                                                <label class="form-check-label" for="inlineRadio2">good</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="calmness" value="5">
                                                <label class="form-check-label" for="inlineRadio1">very good</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="calmness" value="10">
                                                <label class="form-check-label" for="inlineRadio2">excellent</label>
                                            </div>
                                        </div>
                                    </div>

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