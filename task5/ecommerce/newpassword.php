<?php
use App\Models\user;
use App\Requests\Validition;

$title = "New Password";

include('layouts/header.php');
include('layouts/nav.php');
include('layouts/crumb.php');
$validation = new Validition;

if (isset($_SESSION['user'])) {

    header('location:profile.php');

}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $validation->setInputValue($_POST['password'])->setInputName('Password')->required()->regex('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/', 'Minimum eight characters, at least one letter, one number and one special character')->pass_confirm($_POST['password2']);
    $validation->setInputValue($_POST['password2'])->setInputName('password2')->required();
    if (empty($validation->getErrorsList())) {

        $user = new user;
        $user->setEmail($_SESSION['user_mail'])->setPassword($_POST['password']);
        if ($user->updatePassword()) {

            $success = "<div class='alert alert-success'> password Update successfully, you will be redirct shortly </div>" ;
            header('refresh:3; url=login.php');
            unset($_SESSION['user_mail']);
            unset($_SESSION['page']);

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
                            <h4> <?= $title ?? "" ?> </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <?= $success ?? "" ?>
                                    <form method="post">
                                        <input type="password" name="password" placeholder="password">
                                        <?= $validation->error('Password') ?? "" ?>
                                        <input type="password" name="password2" placeholder="Password Confirm">
                                        <?= $validation->error('Password2') ?? "" ?>
                                        <?= $error ?? "" ?>
                                        <div class="button-box">
                                            <button type="submit"><span>Login</span></button>
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