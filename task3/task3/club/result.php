<?php

$title = 'result';
include "includes/header.php";
include "includes/navbar.php";

// check if user passed from first page 
if (isset($_SESSION['familyData'])) {

    // check if user Enter all data => members names and their games
    if (isset($_SESSION['familyMembersAllData'])) {

        // get session data and store it in variable
        $fullData = $_SESSION['familyMembersAllData'];

        // get subscriber name
        $subscriber = $_SESSION['familyData']['username'];

        // get number Of Family Users
        $numberOfFamilyUsers = $_SESSION['familyData']['count'];

        // get every member and store it in variable ===> $member1 = $session['member']  => line 88
        for ($i = 1; $i < $numberOfFamilyUsers + 1; $i++) {
        
            ${"member" . $i} = $fullData['member' . $i];
        
        }
        
        // destroy everything if user click subscribe again
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
                        <thead style="background-color: #1c1f1d; position: relative;">
                            <tr>
                            <th>subscriber</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                                <!-- print Club subscriber -->
                                <th style="position: absolute;right: -2px;"><?= $subscriber ?></th>
                            </tr>
                        </thead>
                        <tbody style="position: relative;">

                            <?php

                            // this loops to make variable and get total price to every game => another explain 
                            foreach ($games as $game => $price) {
                                // $key = football, vollyball .... ======>>> $key."TotalPrice" = $footballTotalPrice , vollyballTotalPrice ..... and so on
                                ${$game . "TotalPrice"} = 0 ;

                            }
                            // Total Games Price
                            $totalGamesPrice = 0 ;
                            // total price without games price
                            $totalClubSubscription = 10000 + ($numberOfFamilyUsers * 2500) ;

                            // loop to print every member 
                            for ($i = 1 ; $i < $numberOfFamilyUsers + 1 ; $i++) { ?>
                                <tr>
                                    <td><?= ${"member" . $i} ?></td>
                                        <?php

                                            // this variable to get total games price for every member
                                            $price = 0;

                                            if (isset($fullData['membergames' . $i])) {

                                                // get total value for each game 
                                                foreach ($fullData['membergames' . $i] as $key => $value) {
                                                    
                                                    $price += $value;
                                                    $totalGamesPrice += $value;

                                                    if ($key == $games2[$key] ) {

                                                        ${$key . "TotalPrice"} += $value;
                                                        
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
                    <!-- another table ==> no description needed -->
                    <table class="table" style="color: #fff;">
                        <thead>
                            <tr>
                                <?php
                                
                                foreach ($games as $game => $price) { ?>

                                    <th><?= $game . " Club" ?> </th>

                                <?php } ?>
                                <th>club Subscription </th>
                                <th>Total Price </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php

                                foreach ($games as $game => $price) { ?>

                                    
                                    <th><?= ${$game . "TotalPrice"} . "EGP" ; ?></th>

                                <?php }?>
                                <th><?= $totalClubSubscription . "EGP" ?></th>
                                <th><?= $totalSubscriptionPrice_withGames . "EGP" ?></th>
                            </tr>
                        </tbody>
                    </table>

                    

                    <form action="" class="row g-4" method="POST">
                        <div class="col-12">
                            <button class="btn btn-1 btn-primary px-4 float-end mt-4">Another Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</main>