<?php
// dynamic table => 3 levels only
// dynamic rows //4 
// dynamic columns // 4
// check if gender of user == m ==> male // 1
// check if gender of user == f ==> female // 1

$users = [
    (object)[
        'id' => 1,
        'name' => 'ahmed',
        "gender" => (object)[
            'gender' => 'm'
        ],
        'hobbies' => [
            'football', 'swimming', 'running',
        ],
        'activities' => [
            "school" => 'drawing',
            'home' => 'painting'
        ],
        'activities2' => [
            "school" => 'drawing',
            'home' => 'painting'
        ],
        'phones'=>"0123123",
    ],
    (object)[
        'id' => 2,
        'name' => 'mohamed',
        "gender" => (object)[
            'gender' => 'm'
        ],
        'hobbies' => [
            'swimming', 'running',
        ],
        'activities' => [
            "school" => 'painting',
            'home' => 'drawing'
        ],
        'activities2' => [
            "school" => 'painting',
            'home' => 'drawing'
        ],
        'phones'=>"2345",
    ],
    (object)[
        'id' => 3,
        'name' => 'menna',
        "gender" => (object)[
            'gender' => 'f'
        ],
        'hobbies' => [
            'running',
        ],
        'activities' => [
            "school" => 'painting',
            'home' => 'drawing'
        ],
        
        'activities2' => [
            "school" => 'painting',
            'home' => 'drawing'
        ],
        'phones'=>"",
    ]
];



?>

<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>

    <main>

        <div class="container table-responsive py-5"> 
                <table class="table table-bordered table-hover">
                <thead class="thead-dark" style="background:black;color: #fff;">
                    <tr>

                        <?php foreach ($users[0] as $key => $value) {  ?>

                        <th scope="col"><?=$key?></th>

                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($users as $user) { ?>
                    <tr>
                        <?php 

                            foreach ($user as $key => $value ) { ?>
                                <td>
                                    <?php

                                    if (gettype($value) == 'object') {

                                        foreach ($value as $val) {
                                            if ($val == 'm' ) {
                                                
                                                echo 'male';

                                            } else {
                                                
                                                echo 'female';

                                            }
                                        }

                                    } else if (gettype($value) == 'array') {

                                        foreach ($value as $val) {
                                            echo $val . ' ';
                                        }

                                    } else {
                                        echo $value;
                                    }


                                    
                                    ?> 
                                </td>


                            <?php  } ?>
                        
                    </tr>
                    <?php } ?>

                    
                </tbody>
            </table>
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
