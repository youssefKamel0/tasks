<?php
use App\Models\user;
use App\Requests\Validition;

$title = "Login";

include('layouts/header.php');
include('layouts/nav.php');
include('layouts/crumb.php');
$validation = new Validition;

if (isset($_SESSION['user'])) {

    header('location:profile.php');

}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $validation->setInputValue($_POST['email'])->setInputName('email')->required()->validate_email()->exists('users', 'email');
    $validation->setInputValue($_POST['password'])->setInputName('Password')->required();

    if (empty($validation->getErrorsList())) {

        $user = new user;
        $user->setEmail($_POST['email'])->setPassword($_POST['password']);
        $result = $user->checkEmail() ;

        if ( $result !== false ) {

            if ($result->num_rows == 1) {

                $user = $result->fetch_object(); // will use it to store in session and when check email and password

                if (password_verify($_POST['password'],$user->password)) {

                    if (is_null($user->email_verified_at)) { // if return true then user not verifed yet 

                        $_SESSION['user_mail'] = $_POST['email'];
                        header('location:verify.php');

                    } else { // user verify the account

                        if (isset($_POST['rememberMe'])) {

                            setcookie('rememberMe',$_POST['email'], time() + (86400 * 365), '/');
                        }

                        $_SESSION['user'] = $user;
                        header('location:index.php');
                        print_r($_POST);
                    }


                    
                } else {

                    $error = "<div class= 'alert alert-danger'> Email Or Password Not Valid </div>";

                }







            } else {

                $error = "<div class= 'alert alert-danger'> unexpected Error, Please Try Again </div>";

            }

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
                                        <input type="password" name="password" placeholder="Password">
                                        <?= $validation->error('Password') ?? "" ?>
                                        <?= $error ?? "" ?>
                                        <div class="button-box">
                                            <div class="login-toggle-btn">
                                                <input name="rememberMe" type="checkbox">
                                                <label>Remember me</label>
                                                <a href="forget-password.php">Forgot Password?</a>
                                            </div>
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