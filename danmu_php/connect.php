<?php
header('Content-Type:application/json');
$addr = 'localhost';			//Database Address
$dbname = '';		//Database Name
$user = '';					//Username of Project Database
$password = '';		//Password of Project Database
$connect=mysqli_connect($addr,$user,$password,$dbname);