<?php

use App\Models\user;
use App\Requests\Media;
use App\Requests\Validition;

$title = "Profile";

include('layouts/header.php');

$validation = new Validition;

if (!isset($_SESSION['user'])) {

    header('location:login.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['infoUpdate'])) {

        $validation->setInputValue($_POST['firstName'] ?? "")->setInputName('First Name')->required()->string()->between(2, 16);
        $validation->setInputValue($_POST['lastName'] ?? "")->setInputName('Last Name')->required()->string()->between(2, 16);
        $validation->setInputValue($_POST['gender'] ?? "")->setInputName('Gender')->required()->in(['m', 'f']);

        if (empty($validation->getErrorsList())) {

            $user = new user;
            $user->setFirstName($_POST['firstName'])->setLastName($_POST['lastName'])->setGender($_POST['gender'])->setEmail($_SESSION['user']->email);
            if ($user->update()) {

                $_SESSION['user']->first_name = $_POST['firstName'];
                $_SESSION['user']->last_name = $_POST['lastName'];
                $_SESSION['user']->gender = $_POST['gender'];
                $success = "<div class= 'alert alert-success'> Profile Updated Successfully </div>";
            } else {

                $error = "<div class= 'alert alert-danger'> unexpected Error, Please Try Again </div>";
            }
        }
    }

    // image

    if (isset($_POST['uploadImageBtn'])) {

        if ($_FILES['image']['error'] == 0) {

            $validation->setFile($_FILES['image'])->setInputName('image')->size(1000000)->extensions(['png','jpg','jpeg']);

            if (empty($validation->getErrorsList())) {

                // upload image

                $media = new Media;

                if ($media->setFile($_FILES['image'])->upload('assets/img/')) {

                    // delete old photo
                    if ($_SESSION['user']->image != "default.jpg") {

                        $media->delete('assets/img/'. $_SESSION['user']->image);

                    }

                    // insert to db

                    $user = new user;

                    $user->setImage($media->getNewImageName())->setEmail($_SESSION['user']->email);
                    if ($user->updateImage()) {

                        $_SESSION['user']->image = $media->getNewImageName();
                        $success = "<div class='alert alert-success'> Image Update successfully </div>" ;


                    } else {


                        // error while insert to db
                        $error = "<div class= 'alert alert-danger'>Unexpected error while uploading image </div>";

                    }



                } else {

                    // error upload
                    $error = "<div class= 'alert alert-danger'>Unexpected error while uploading image </div>";


                }

            }
        }

    }
    
    // change password
    
    if (isset($_POST['changePassword'])) {

        $validation->setInputValue($_POST['password'])->setInputName('password')->required();
        $validation->setInputValue($_POST['newPassword'])->setInputName('newPassword')->required()->regex('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/', 'Minimum eight characters, at least one letter, one number and one special character')->pass_confirm($_POST['newPassword2']);
        $validation->setInputValue($_POST['newPassword2'])->setInputName('newPassword2')->required();

        if (empty($validation->getErrorsList())) {

            $user = new user;
            $user->setEmail($_SESSION['user']->email)->setPassword($_POST['newPassword']);
            $result = $user->checkEmail();

            if ( $result !== false ) {

                if ($result->num_rows == 1) {

                    $dbuser = $result->fetch_object();

                    if (password_verify($_POST['password'],$dbuser->password)) {

                        if ($user->updatePassword()) {

                            $success = "<div class='alert alert-success'> password Update successfully </div>" ;

                        }
                        
                    } else {

                        $error = "<div class= 'alert alert-danger'> Your Password Invalid </div>";

                    }

                } else  {

                    $error = "<div class= 'alert alert-danger'> unexpected Error, Please Try Again </div>";

                }

            
            } else {
                $error = "<div class= 'alert alert-danger'> fdfdunexpected Error, Please Try Again </div>";
            }

        } 


    }



}

include('layouts/nav.php');
include('layouts/crumb.php');

?>
<!-- my account start -->
<div class="checkout-area pb-80 pt-100">
    <div class="container">
        <div class="row">
            <div class="ml-auto mr-auto col-lg-9">
                <div class="checkout-wrapper">
                    <div id="faq" class="panel-group">
                        <?= $success ?? "" ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>1</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-1">Edit your account information </a></h5>
                            </div>
                            <div id="my-account-1" class="panel-collapse collapse show ">
                                <div class="panel-body">
                                    <form method="post" enctype="multipart/form-data">
                                        <div class="billing-information-wrapper">
                                            <div class="account-info-wrapper">
                                                <h4>My Account Information</h4>
                                                <h5>Your Personal Details</h5>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="col-6 offset-3">

                                                        <?php

                                                        if ($_SESSION['user']->image == "default.jpg") {

                                                            if ($_SESSION['user']->gender == 'm') {

                                                                $image = "m.jpg";
                                                            } else {

                                                                $image = "f.jpg";
                                                            }
                                                        } else {

                                                            $image = $_SESSION['user']->image;
                                                        }

                                                        ?>
                                                        <label for="file"><img id="image" style="width: 100% ; cursor: pointer;" src="assets/img/<?= $image ?>" alt=""></label>
                                                        <input name="image" type="file" id="file" class="d-none" onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])">
                                                        <?= $validation->error('image') ?>
                                                        <button name="uploadImageBtn" class="btn btn-success rounded mt-2" style="cursor: pointer;">upload</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="billing-info">
                                                        <label>First Name</label>
                                                        <input type="text" name="firstName" value="<?= $_SESSION['user']->first_name ?>">
                                                        <?= $validation->error('First Name') ?? "" ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="billing-info">
                                                        <label>Last Name</label>
                                                        <input type="text" name="lastName" value="<?= $_SESSION['user']->last_name ?>">
                                                        <?= $validation->error('Last Name') ?? "" ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Email Address</label>
                                                        <input style="background: #afafaf;color: #fff;" type="email" name="email" value="<?= $_SESSION['user']->email ?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <select name="gender" class="form-control mb-4">
                                                            <option <?= $_SESSION['user']->gender == 'm' ? 'selected' : "" ?> value="m">Male</option>
                                                            <option <?= $_SESSION['user']->gender == 'f' ? 'selected' : "" ?> value="f">Female</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <?= $error ?? "" ?>
                                                </div>
                                            </div>
                                            <div class="billing-back-btn">
                                                <div class="billing-back">
                                                    <a href="#"><i class="ion-arrow-up-c"></i> back</a>
                                                </div>
                                                <div class="billing-btn">
                                                    <button type="submit" name="infoUpdate">Continue</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>2</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-2">Change your password </a></h5>
                            </div>
                            <div id="my-account-2" class="panel-collapse collapse ">
                                <div class="panel-body">
                                    <form method="post">
                                        <div class="billing-information-wrapper">
                                            <div class="account-info-wrapper">
                                                <h4>Change Password</h4>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12">
                                                    <?= $error ?? "" ?>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Your Password</label>
                                                        <input type="password" name="password">
                                                        <?= $validation->error('password') ?? "" ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>New Password</label>
                                                        <input type="password" name="newPassword">
                                                        <?= $validation->error('newPassword') ?? "" ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Password Confirm</label>
                                                        <input type="password" name="newPassword2">
                                                        <?= $validation->error('newPassword2') ?? "" ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="billing-back-btn">
                                                <div class="billing-back">
                                                    <a href="#"><i class="ion-arrow-up-c"></i> back</a>
                                                </div>
                                                <div class="billing-btn">
                                                    <button name="changePassword" type="submit">Continue</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>3</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-3">Modify your address book entries </a></h5>
                            </div>
                            <div id="my-account-3" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="billing-information-wrapper">
                                        <div class="account-info-wrapper">
                                            <h4>Address Book Entries</h4>
                                        </div>
                                        <div class="entries-wrapper">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 d-flex align-items-center justify-content-center">
                                                    <div class="entries-info text-center">
                                                        <p>Farhana hayder (shuvo) </p>
                                                        <p>hastech </p>
                                                        <p> Road#1 , Block#c </p>
                                                        <p> Rampura. </p>
                                                        <p>Dhaka </p>
                                                        <p>Bangladesh </p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 d-flex align-items-center justify-content-center">
                                                    <div class="entries-edit-delete text-center">
                                                        <a class="edit" href="#">Edit</a>
                                                        <a href="#">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="billing-back-btn">
                                            <div class="billing-back">
                                                <a href="#"><i class="ion-arrow-up-c"></i> back</a>
                                            </div>
                                            <div class="billing-btn">
                                                <button type="submit">Continue</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>4</span> <a href="wishlist.php">Modify your wish list
                                    </a></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include "layouts/footer.php";
include "layouts/scripts.php";
?>