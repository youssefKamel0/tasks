<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['submit'])) {
        $name = $_POST['user'];
        $city = $_POST['city'];
        $product_number = $_POST['products'];

        if (empty($name) || empty($city) || empty($product_number)) {

            $message = '<div class="alert alert-danger"> invalid data </div>';
        } else {

            // first table to enter products

            $table = '<table class="table mt-5 table-dark table-striped">
                        <thead>
                            <tr>
                                <th scope="col">product name</th>
                                <th scope="col">price</th>
                                <th scope="col">Quantities</th>
                            </tr>
                        </thead>
                        <tbody>';

            for ($i = 0; $i < $product_number; $i++) {

                $table .= '<tr>
                                <form action="" class="row g-4" method="POST" id="receipt">
                                <td>
                                    <input required type="text" name="product-name' . $i;
                $table .=           '"class="form-control" placeholder="product-name">
                                </td>

                                <td>
                                    <input required type="number" name="product-price' . $i;
                $table .=           '" class="form-control" placeholder="product-price">
                                </td>
                                <td>
                                    <input required type="number" name="quantities' . $i;
                $table .=           '" class="form-control" placeholder="Quantities">
                                </td>
                        </tr>';
            }



            $table .=   '</tbody>
                        </table>';


            $table .= '     <div class="col-12">
                                <button type="submit" name="receipt" form="receipt" class="btn btn-light px-4 mt-4">Receipt</button>
                                <input type="text" name="user2" value="' . $name . "\"";
            $table .= 'class="form-control" hidden>

                                <input type="text" name="city2" value="' . $city . "\"";;
            $table .= 'class="form-control" hidden>

                                <input type="text" name="products2" value="' . $product_number . "\"";;
            $table .= 'class="form-control" hidden>

                            </div>
                        </form>';
        }

    // receipt

    } elseif (isset($_POST['receipt'])) {



        $name2 = $_POST['user2'];
        $city2 = $_POST['city2'];
        $product_number2 = $_POST['products2'];
        $TotalSubTotal = 0;

        for ($i = 0; $i < $product_number2; $i++) {


            ${"product_name" . $i} = $_POST['product-name' . $i];
            ${"product_price" . $i} = $_POST['product-price' . $i];
            ${"quantities" . $i} = $_POST['quantities' . $i];

            if (!empty(${"product_name" . $i}) && !empty(${"product_price" . $i}) && !empty(${"quantities" . $i})) {

                ${"subtotal" . $i} = ${"product_price" . $i} * ${"quantities" . $i};

                $TotalSubTotal +=  ${"subtotal" . $i};
            }

        }

        if ($city2 == 'cairo') {

            $dilvery = 0;

        } elseif ($city2 == 'giza') {

            $dilvery = 30;


        }elseif ($city2 == 'alex') {

            $dilvery = 50;


        } else {

            $dilvery = 100;

        }

        if ($TotalSubTotal > 4500) {

            $discount = 20;

        } elseif ($TotalSubTotal < 4500 && $TotalSubTotal > 3000 ) {

            $discount = 15;

        }elseif ($TotalSubTotal < 3000 && $TotalSubTotal > 1000 ) {

            $discount = 10;

        } else {

            $discount = 0;

        }

        
        $totalAfterDiscount = $TotalSubTotal - ( ( $TotalSubTotal * $discount ) / 100 ) ;

        $FinalTotal = $totalAfterDiscount + $dilvery ;

        $table2 = '<table class="table mt-5 table-dark table-striped">
                    <thead>
                        <tr>
                            <th scope="col">product name</th>
                            <th scope="col">price</th>
                            <th scope="col">quantities</th>
                            <th scope="col">subtotal</th>
                        </tr>
                    </thead>
                    <tbody>';

        for ($i = 0; $i < $product_number2; $i++) {

        $table2 .='<tr>
                <td>';

        $table2 .=${"product_name" . $i};

        $table2 .='</td>

                <td>';

        $table2 .=${"product_price" . $i};
        
        $table2 .='</td>

                <td>';

        $table2 .=${"quantities" . $i};
        
        $table2 .='</td>

                <td>';

        $table2 .=${"subtotal" . $i};
        
        $table2 .=' </td>
                    </tr>';
                }


        $table2 .=' </tbody>
                    </table>';


                
        // last data   
        $table3 = '<table class="table mt-5 table-dark table-striped">
        <thead>
            <tr>
            <th scope="col">Client Name</th>
            <th scope="col">City</th>
            <th scope="col">Total</th>
            <th scope="col">Discount</th>
            <th scope="col">Total After Discount</th>
            <th scope="col">Dilvery</th>
            <th scope="col">Net Total</th>
            </tr>
        </thead>
        <tbody>';

        $table3 .='<tr>
            <td>';

        $table3 .=$name2;

        $table3 .='</td>

            <td>';

        $table3 .=$city2;

        $table3 .='</td>

            <td>';

        $table3 .=$TotalSubTotal;

        $table3 .='</td>

            <td>';

        $table3 .=$discount . "%";

        $table3 .='</td>

                <td>';

        $table3 .= $totalAfterDiscount;

        $table3 .='</td>

                <td>';

        $table3 .=$dilvery;

        $table3 .='</td>

                <td style="color:red;">';

        $table3 .=$FinalTotal;

        $table3 .=' </td>
                </tr>';

        $table3 .=' </tbody>
                </table>';        

        
    }


    











}


?>



<!doctype html>
<html lang="en">

<head>
    <title>subermarket</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
        a {
            text-decoration: none;
        }

        .login-page {
            width: 100%;
            height: 100vh;
            display: inline-block;
        }

        .form-right i {
            font-size: 100px;
        }

        .form-control,body, .form-left,.col-md-7,.form-right  {
            background: #212529 !important;
            color: #fff !important;
        }

        main {
            margin-top: 4rem;
        }

        .input-group-text {
            background-color: #0F1114 !important;
        }
    </style>

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="javascript:void(0)">subermarket</a>
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
                        <h3 class="mb-3 text-center">shop our subermarket</h3>
                        <div class="bg-white shadow rounded">
                            <div class="row">
                                <div class="col-md-5 ps-0 d-none d-md-block">
                                    <div class="form-right h-100 text-white text-center row">
                                        <i class="bi bi-bootstrap"></i>
                                        <h2 class="fs-1">Welcome Back!</h2>
                                    </div>
                                </div>
                                <div class="col-md-7 pe-0">
                                    <div class="form-left h-100 py-5 px-5">
                                        <form action="" class="row g-4" method="POST">
                                            <div class="col-12">
                                                <label>Username<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
                                                    <input type="text" name="user" value="<?= $name ?? $name2 ??"" ?>" class="form-control" placeholder="Enter Username" <?php if (isset($table)) { ?> readonly <?php } ?>>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label>City<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="bi bi-lock-fill"></i></div>
                                                    <select class="form-select form-control" name="city" <?php if (isset($table)) { ?> disabled <?php } ?>>
                                                        <option value="giza" selected>giza</option>
                                                        <option value="cairo">cairo</option>
                                                        <option value="alex">alex</option>
                                                        <option value="others">others</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label>products<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="bi bi-lock-fill"></i></div>
                                                    <input type="number" name="products" value="<?= $product_number ?? $product_number2 ??"" ?>" class="form-control" placeholder="Number Of products" <?php if (isset($table)) { ?> readonly <?php } ?>>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <?= $message ?? "" ?>
                                            </div>

                                            <div class="col-12">
                                                <button type="submit" name="submit" class="btn btn-light btn-lg px-4 float-end mt-4" <?php if (isset($table)) { ?> disabled <?php } ?>>Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?= $table ?? "" ?>
                        <?= $table2 ?? "" ?>
                        <?= $table3 ?? "" ?>

    </main>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>