<?php

use App\Models\user;
use App\Requests\Validition;

$title = "Forget Password";
include('layouts/header.php');


if (isset($_SESSION['user'])) {

    header('location:profile.php');

}

$validation = new Validition;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $validation->setInputValue($_POST['email'])->setInputName('email')->required()->validate_email()->exists('users', 'email');


    if (empty($validation->getErrorsList())) {

        $codeForForgetPassword = rand(10000,99999);
        $user = new user;
        $user->setVerifictionCode($codeForForgetPassword)->setEmail($_POST['email']);
        if ($user->updateVerifyCode()) {

            // send mail then  redirct to update password page
            $_SESSION['user_mail'] = $_POST['email'];
            $_SESSION['page'] = 'forget';
            header('location:verify.php');

        } else {

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
                        <a class="active" data-toggle="tab" href="#lg1">
                            <h4> <?= $title ?> </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form method="post">
                                        <input type="email" name="email" placeholder="Email">
                                        <?= $validation->error('email') ?? "" ?>
                                        <?= $error ?? "" ?>
                                        <div class="button-box">
                                            <button type="submit"><span><?= $title ?> </span></button>
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

?>