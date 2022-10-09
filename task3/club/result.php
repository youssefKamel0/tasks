<?php

$title = 'result';
include "includes/header.php";
include "includes/navbar.php";

if (isset($_SESSION['familyData'])) {

    if (isset($_SESSION['familyMembersAllData'])) {

        $fullData = $_SESSION['familyMembersAllData'];
        $subscriber = $_SESSION['familyData']['username'][0];
        $numberOfFamilyUsers = $_SESSION['familyData']['count'][0];
        
        for ($i = 1; $i < $numberOfFamilyUsers + 1; $i++) {
        
            ${"member" . $i} = $fullData['member' . $i];
        
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            session_destroy();
            header('location:subscribe.php');

        }        

    } else {

        header('location:games.php');
        die;

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
                    <h3 class="mb-3 text-center">Your Subscription Details</h3>
                    <table class="table" style="color: #fff;">
                        <thead style="background-color: #1c1f1d;">
                            <tr>
                                <th>subscriber</th>
                                <th><?= $subscriber ?></th>
                            </tr>
                        </thead>
                        <tbody style="position: relative;">
                            <?php
                            $footballTotalPrice = 0 ;
                            $swimmingTotalPrice = 0 ;
                            $vollyballTotalPrice = 0 ;
                            $othersTotalPrice = 0 ;
                            $totalGamesPrice = 0 ;
                            $totalClubSubscription = 10000 + ($numberOfFamilyUsers * 2500) ;
                            for ($i = 1 ; $i < $numberOfFamilyUsers + 1 ; $i++) { ?>
                                <tr>
                                    <td><?= ${"member" . $i} ?></td>
                                        <?php

                                            $price = 0;

                                            if (isset($fullData['membergames' . $i])) {


                                                foreach ($fullData['membergames' . $i] as $key => $value) {
                                                    
                                                    $price += $value;
                                                    $totalGamesPrice += $value;

                                                    if ($key =='football') {

                                                        $footballTotalPrice += 300;
                                                        
                                                    } elseif ($key =='swimming') {

                                                        $swimmingTotalPrice += 250 ;

                                                    } elseif ($key =='vollyball') {

                                                        $vollyballTotalPrice += 150 ;

                                                    } elseif ($key =='others') {

                                                        $othersTotalPrice += 100 ;

                                                    }
                                                    
                                                ?>

                                                <td>
                                                    <?= $key?>
                                                </td>

                                            <?php
                                                }
                                            }

                                            $totalSubscriptionPrice_withGames = 10000 + ($numberOfFamilyUsers * 2500) + $totalGamesPrice ;

                                            ?>

                                            <td class="getRight"><?= $price . "EGP" ?></td>
                                </tr>
                            <?php } ?>
                                <tr>
                                    <td>Total</td>
                                    <td class="getRight"><?= $totalGamesPrice . "EGP" ?></td>
                                </tr>
                        </tbody>
                    </table>



                    <hr>
                    <table class="table" style="color: #fff;">
                        <thead>
                            <tr>
                            <th>Football club</th>
                            <th>Swimming club</th>
                            <th>vollyball club</th>
                            <th>others club</th>
                            <th>club Subscription </th>
                            <th>Total Price </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th><?= $footballTotalPrice . "EGP" ?></th>
                                <th><?= $swimmingTotalPrice . "EGP" ?></th>
                                <th><?= $vollyballTotalPrice . "EGP" ?></th>
                                <th><?= $othersTotalPrice . "EGP" ?></th>
                                <th><?= $totalClubSubscription . "EGP" ?></th>
                                <th><?= $totalSubscriptionPrice_withGames . "EGP" ?></th>
                            </tr>
                        </tbody>
                    </table>

                    

                    <form action="" class="row g-4" method="POST">
                        <div class="col-12">
                            <button name="submit" class="btn btn-1 btn-primary px-4 float-end mt-4">Another Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</main>