<?php

use App\Models\user;
use App\Requests\Validition;


$title = "Register";

include('layouts/header.php');
include('layouts/nav.php');
include('layouts/crumb.php');

$Validition = new Validition;

if (isset($_SESSION['user'])) {

    header('location:profile.php');

}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $Validition->setInputValue($_POST['firstName'] ?? "")->setInputName('First Name')->required()->string()->between(2,16);
    $Validition->setInputValue($_POST['lastName'] ?? "")->setInputName('Last Name')->required()->string()->between(2,16);
    $Validition->setInputValue($_POST['email'] ?? "" )->setInputName('Email')->required()->validate_email()->unique('users', 'email');
    $Validition->setInputValue($_POST['phone'] ?? "")->setInputName('Mobile Number')->required()->regex('/01[0125][0-9]{8}$/')->unique('users', 'phone');
    $Validition->setInputValue($_POST['password'])->setInputName('Password')->required()->regex('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/', 'Minimum eight characters, at least one letter, one number and one special character')->pass_confirm($_POST['password2']);
    $Validition->setInputValue($_POST['password2'])->setInputName('Confirm Password')->required();
    $Validition->setInputValue($_POST['gender'] ?? "")->setInputName('Gender')->required()->in(['m','f']);

    if (empty($Validition->getErrorsList())) {

        $verify_code = rand(10000, 99999);
        $user = new user;
        $user->setFirstName($_POST['firstName'])->setLastName($_POST['lastName'])->setEmail($_POST['email'])
        ->setPhone($_POST['phone'])->setGender($_POST['gender'])->setPassword($_POST['password'])->setVerifictionCode($verify_code);

        if ( $user->insertToDataBase() ) {

            // send mail
            $_SESSION['user_mail'] = $_POST['email'];
            $_SESSION['page'] = 'register';
            header('location:verify.php');
            

        } else { // developer mistake

            $error = "<div class= 'alert alert-danger'> unexpected Error, Please Try Again </div>";

        }


    }


}

?>



<div class="login-register-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a class="active" data-toggle="tab" href="#lg2">
                            <h4> register </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg2" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form method="post">
                                        <?= $error ?? "" ?>
                                        <input type="text" name="firstName" placeholder="Enter First Name" value="<?= $_POST['firstName'] ?? "" ?>">
                                        <?= $Validition->error('First Name') ?? "" ?>
                                        <input type="text" name="lastName" placeholder="Enter Last Name" value="<?= $_POST['lastName'] ?? "" ?>">
                                        <?= $Validition->error('Last Name') ?? "" ?>
                                        <input type="email" name="email" placeholder="Enter Email" value="<?= $_POST['email'] ?? "" ?>">
                                        <?= $Validition->error('Email') ?? "" ?>
                                        <input type="number" name="phone" placeholder="Eneter Phone Number" value="<?= $_POST['phone'] ?? "" ?>">
                                        <?= $Validition->error('Mobile Number') ?? "" ?>
                                        <input type="password" name="password" placeholder="Enter Your Password">
                                        <?= $Validition->error('Password') ?? "" ?>
                                        <input type="password" name="password2" placeholder="Enter Password Again">
                                        <select name="gender" class="form-control mb-4">
                                            <option value="m">Male</option>
                                            <option value="f">Female</option>
                                        </select>
                                        <div class="button-box">
                                            <button type="submit"><span>Register</span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php 

include('layouts/scripts.php');
include('layouts/footer.php');


?>