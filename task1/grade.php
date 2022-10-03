<?php

if ($_POST) {

    $gra1 = $_POST['physics'] ;
    $gra2 = $_POST['chemistry'] ;
    $gra3 = $_POST['biology'] ;
    $gra4 = $_POST['math'] ;
    $gra5 = $_POST['computer'] ;

    define("MAX_GRADE", 500) ;

    // eheck if any input is empty
    if (empty($gra1) || empty($gra2) || empty($gra3) || empty($gra4) ||empty($gra5)) {

        $message = "<div class='alert alert-danger'>" . "Please Enter Valid Data" . "</div>";

    // eheck if any input is wrong value
    } elseif ($gra1 > 100 || $gra2 > 100 || $gra3 > 100 || $gra4 > 100 || $gra5 > 100 ) {

        $message = "<div class='alert alert-danger'>" . " InValid Data" . "</div>";


    // check if data is postive
    } elseif ($gra1 < 0 || $gra2 < 0 || $gra3 < 0 || $gra4 < 0 || $gra5 < 0 ) {

        $message = "<div class='alert alert-danger'>" . " InValid Data" . "</div>";


    } else {

        $percentage = ($gra1 + $gra2 + $gra3 + $gra4 + $gra5 ) / MAX_GRADE * 100  ;

        if ($percentage >= 90) {

            $message = "<div class='alert alert-success'>" . "your percentage is " .$percentage . "%" . "<br>" . "Your Grade Is A" ."</div>";


        } elseif ($percentage >=80 && $percentage < 90) {

            $message = "<div class='alert alert-success'>" . "your percentage is " .$percentage . "%" . "<br>" . "Your Grade Is B" ."</div>";

            
        } elseif ($percentage >=70 && $percentage < 80) {

            $message = "<div class='alert alert-success'>" . "your percentage is " .$percentage . "%" . "<br>" . "Your Grade Is C" ."</div>";


        } elseif ($percentage >=60 && $percentage < 70) {

            $message = "<div class='alert alert-success'>" . "your percentage is " .$percentage . "%" . "<br>" . "Your Grade Is D" ."</div>";


        } elseif ($percentage >=40 && $percentage < 60) {

            $message = "<div class='alert alert-danger'>" . "your percentage is " .$percentage . "%" . "<br>" . "Your Grade Is E" ."</div>";


        } else {

            $message = "<div class='alert alert-danger'>" . "your percentage is " .$percentage . "%" . "<br>" . "Your Grade Is F" ."</div>";


        }

    }



}


?>

<!doctype html>
<html lang="en">

<head>
    <title>Grade</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <style type="text/css">
        .form-group {
            margin-bottom: 1rem;
        }
    </style>

</head>

<body>

    <main>
        <div class="contianer">
            <div>
                <div class="col-12 text-center text-danger mt-5">
                    <h1> calculate your Grade </h1>
                </div>
                <div class="col-4 offset-4 mt-5">
                    <form action="" method="post">
                        <div class="form-group">
                            <input type="number" name="physics" placeholder="physics" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="number" name="chemistry" placeholder="chemistry" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="number" name="biology" placeholder="biology" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="number" name="math"  placeholder="MATH" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="number" name="computer" placeholder="computer" class="form-control">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-outline-danger rounded form-control"> calc </button>
                        </div>
                    </form>
                    <?php
                        if(isset($message)){
                            echo $message;
                        }
                    ?>

                </div>
            </div>
        </div>

    </main>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>