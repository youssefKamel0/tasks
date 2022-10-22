<?php

use App\Models\user;
use App\Requests\Validition;

$title = "Verify";


include('layouts/header.php');

$validition = new Validition;

if (isset($_SESSION['user'])) {

    header('location:index.php');die;

}

if (isset($_SESSION['user_mail'])) {

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $validition->setInputValue($_POST['verify_code'])->setInputName('verify_code')->required()->numirc();
    
        if (empty($validition->getErrorsList())) {
    
            $user = new user ;
            $user->setEmail($_SESSION['user_mail'])->setVerifictionCode($_POST['verify_code']);
    
            
            if ($user->checkcode() !== false) {
    
                if ($user ->checkcode()->num_rows == 1) {
    
                    $user->setEmailVerifictedAt(date('Y-m-d H-i-s'));
    
                    if ($user->updateEmailverifyAt()) {

                        if ($_SESSION['page'] == "register") {
    
                            $success = "<div class='alert alert-success'> success, you will be redirct shortly </div>" ;
                            header('refresh:3; url=login.php');
                            unset($_SESSION['user_mail']);
                            unset($_SESSION['page']);
                

                        } else if ($_SESSION['page'] == "forget") {
                                
                            $success = "<div class='alert alert-success'> success, you will be redirct To Update Password Page shortly </div>" ;
                            header('refresh:3; url=newpassword.php');
                
                        }

                        
                    } else {
    
                        $error = "<div class='alert alert-danger'> something went worng </div>";
    
                    }
    
                } else {
    
                    $error = "<div class='alert alert-danger'> Invalid Code </div>";
    
                }
    
            } else {
    
    
                $error = "<div class='alert alert-danger'> something went worng </div>";
    
            }
    
    
        }
    
    }

} else {

    header('location:login.php');

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
                                        <input type="number" name="verify_code" placeholder="Verify Code">
                                        <?= $validition->error('verify_code') ?? "" ?>
                                        <?= $error ?? "" ?>
                                        <?= $success ?? "" ?>
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