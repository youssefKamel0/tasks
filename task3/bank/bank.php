<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['user'];
    $loan = $_POST['loan'];
    $years = $_POST['years'];

    if (empty($name) || empty($loan) || empty($years)) {

        $message = '<div class="alert alert-danger"> invalid data </div>';

    } else {

        if ($years <= 3) {

            $Rate = 10;
            $interestRate = ( ($loan * $Rate ) / 100 ) * $years ;
            $loanAfterInterestRate = (( ($loan * 10 ) / 100 ) * $years ) + $loan ;
            $monthly = $loanAfterInterestRate / ($years * 12) ;

        } else {

            $Rate = 15;
            $interestRate = ( ($loan * $Rate ) / 100 ) * $years ;
            $loanAfterInterestRate = (( ($loan * 15 ) / 100 ) * $years ) + $loan ;
            $monthly = $loanAfterInterestRate / ($years * 12) ;


        }

        $table = '
        <table class="table mt-5">
            <thead>
                <tr>
                    <th scope="col">information</th>
                    <th scope="col">UserName</th>
                    <th scope="col">Interest Rate</th>
                    <th scope="col">Loan</th>
                    <th scope="col">Loan After Interest</th>
                    <th scope="col">Number Of Years</th>
                    <th scope="col">Rate Of Interest Per Year </th>
                    <th scope="col">Monthlly Interest</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">#</th>
                    <td>';
                    
                    $table.= $name;
                    
        $table .= '</td>';
        $table .='  <td>';
        
        $table .= $interestRate ;

        $table .= '</td>';

        $table .='  <td>';
        
        $table .= $loan ;

        $table .= '</td>';

        $table .=  '<td>';

        $table .= $loanAfterInterestRate;
        
        $table .= '</td>';

        $table .= '<td>';

        $table .= $years;
        
        $table .=' </td>';

        $table .= '<td>';

        $table .= $Rate . "%";
        
        $table .=' </td>';

        $table .= '<td>';

        $table .= round($monthly);
        
        $table .=' </td>
                </tr>
            </tbody>
        </table>
    ';

    }


}






?>



<!doctype html>
<html lang="en">

<head>
    <title>Bank</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>


        .form-control,body, .form-left,.col-md-7,.form-right, table  {
            background: #212529 !important;
            color: #fff !important;
        }

        main {
            margin-top: 4rem;
        }

        .input-group-text {
            background-color: #0F1114 !important;
        }
        a {
            text-decoration: none;
        }

        .login-page {
            width: 100%;
            height: 100vh;
            display: inline-block;
            display: flex;
            align-items: center;
        }

        .form-right i {
            font-size: 100px;
        }
    </style>
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="javascript:void(0)">Bank</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mynavbar">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0)">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0)">services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0)">Offers</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>


    <main>
        <div class="login-page">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1">
                        <h3 class="mb-3 text-center">Calculate Your Loan</h3>
                        <div class="bg-white shadow rounded">
                            <div class="row">
                                <div class="col-md-7 pe-0">
                                    <div class="form-left h-100 py-5 px-5">
                                        <form action="" class="row g-4" method="POST">
                                            <div class="col-12">
                                                <label>Username<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
                                                    <input type="text" name="user" value="<?= $name ?? "" ?>" class="form-control" placeholder="Enter Username">
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label>Loan<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="bi bi-lock-fill"></i></div>
                                                    <input type="number" name="loan" value="<?= $loan ?? "" ?>" class="form-control" placeholder="Enter loan">
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label>Years<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="bi bi-lock-fill"></i></div>
                                                    <input type="number" name="years" value="<?= $years ?? "" ?>" class="form-control" placeholder="Enter loan years">
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <?= $message ?? "" ?>
                                            </div>

                                            <div class="col-12">
                                                <button type="submit" class="btn btn-light px-4 float-end mt-4">Calculate</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-5 ps-0 d-none d-md-block">
                                    <div class="form-right h-100 text-white text-center row">
                                        <i class="bi bi-bootstrap"></i>
                                        <h2 class="fs-1">Welcome Back!</h2>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?= $table ?? ""?>




    </main>
    <footer>
        <!-- Footer -->
        <footer class="bg-dark text-center text-white">
            <!-- Grid container -->
            <div class="container p-4">
            <!-- Copyright -->
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                © 2022 Copyright:
                <a class="text-white" href="#">Bank</a>
            </div>
            <!-- Copyright -->
        </footer>
        <!-- Footer -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>