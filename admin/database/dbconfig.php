<?php

$server_name = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "mess";
$server_name = "ec2-52-73-149-159.compute-1.amazonaws.com";
$db_username = "qqfgtcextcrjsm";
$db_password = "cab259fbd3c09e4591339251c5f6955d04807e3881c636fc0cf87b35caac0a23";
$db_name = "daj1vkadhe6plo";


$connection = mysqli_connect($server_name,$db_username,$db_password,$db_name);
$link=mysqli_connect($server_name,$db_username,$db_password,$db_name);

if(!$connection)
{
    die("Connection failed: " . mysqli_connect_error());
    echo '
        <div class="container">
            <div class="row">
                <div class="col-md-8 mr-auto ml-auto text-center py-5 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="card-title bg-danger text-white"> Database Connection Failed </h1>
                            <h2 class="card-title"> Database Failure</h2>
                            <p class="card-text"> Please Check Your Database Connection.</p>
                            <a href="#" class="btn btn-primary">:( </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    ';
}
?>
