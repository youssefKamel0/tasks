<?php

if ($_POST) {

    $firstNum = $_POST['first'];
    $secondNum = $_POST['second'];
    $ope = $_POST['ope'];

    // eheck if any input is empty
    if ( !empty($firstNum) || !empty($secondNum)) {

        switch($ope){
            case "plus":
                $final = $firstNum + $secondNum;
                $message = "<div class='alert alert-success'>". $firstNum . " + " . $secondNum . " = " . $final ."</div>";
                break;
            case "minus":
                $final = $firstNum - $secondNum;
                $message = "<div class='alert alert-success'>". $firstNum . " - " . $secondNum . " = " . $final ."</div>";
                break;
            case "multiply":
                $final = $firstNum * $secondNum;
                $message = "<div class='alert alert-success'>". $firstNum . " * " . $secondNum . " = " . $final ."</div>";
                break;
            case "division":
                if ($secondNum == 0) {
                    $message = "<div class='alert alert-danger'> Try To division by zero! -_-  </div>";
                } else {
                    $final = $firstNum / $secondNum;
                    $message = "<div class='alert alert-success'>". $firstNum . " / " . $secondNum . " = " . $final ."</div>";
                }
                break;
            case "remainder":
                $final = $firstNum % $secondNum;
                $message = "<div class='alert alert-success'>". $firstNum . " % " . $secondNum . " = " . $final ."</div>";
                break;
            case "bin2dec":
                $final = bindec($firstNum);
                $message = "<div class='alert alert-success'>". $firstNum . "=> " . $final ."</div>";
                break;
            case "dec2bin":
                $final = decbin($firstNum);
                $message = "<div class='alert alert-secondary'>". $firstNum . "=> " . $final ."</div>";
                break;
        }

    
    } else {
        
        $message = "<div class='alert alert-danger'>" . "Please Enter Valid Data" . "</div>";

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
                    <h1> Calculator </h1>
                </div>
                <div class="col-4 offset-4 mt-5">
                    <form action="" method="post">
                        <div class="form-group">
                            <input type="number" name="first" placeholder="first number" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="number" name="second" placeholder="second number" class="form-control">
                        </div>
                        <div class="form-group">
                            <label> operation: </label>
                            <input type="submit" name="ope" value="plus" class="btn btn-success btn-circle btn-xl"></input>
                            <input type="submit" name="ope" value="minus" class="btn btn-secondary btn-circle btn-xl"></input>
                            <input type="submit" name="ope" value="multiply" class="btn btn-primary btn-circle btn-xl"></input>
                            <input type="submit" name="ope" value="division" class="btn btn-dark btn-circle btn-xl"></input>
                            <input type="submit" name="ope" value="remainder" class="btn btn-warning btn-circle btn-xl"></input>
                        </div>
                        <div class="form-group">
                            <input style="width: 49%;" type="submit" name="ope" value="bin2dec" class="btn btn-success btn-circle btn-xl"></input>
                            <input style="width: 49%;" type="submit" name="ope" value="dec2bin" class="btn btn-secondary btn-circle btn-xl"></input>
                            <small>note: Use FirstNum With Binary And Decimal</small>
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