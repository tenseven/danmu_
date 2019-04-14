<?php
header('Content-Type:application/json');
require_once('./connect.php');
$username=htmlspecialchars(trim($_POST['user2']));
$password=htmlspecialchars(trim($_POST['password1']));
$checkpwd=htmlspecialchars(trim($_POST['password2']));
$sql=$connect->prepare("SELECT name FROM test WHERE name=?");
$sql->bind_param("s",$username);
$sql->execute();
$result_array=$sql->get_result();
$infoarray=mysqli_fetch_array($result_array);
$password_length=strlen($password);
function json_data($errcode,$errmsg,$data){
    $json_format=[
        'errcode'=>$errcode,
        'errmsg'=>$errmsg,
        'data'=>$data
    ];
    echo json_encode($json_format);
}
if($username!=NULL){
if($infoarray==NULL){
    if($password_length>=1){ 
        if($password==$checkpwd){
            $username=htmlspecialchars($username);
            $insert_user=$connect->prepare("INSERT INTO test (password,name) VALUES(?,?)");
            $insert_user->bind_param("ss",$password,$username);
            $insert_user->execute();
            json_data(0,'',"succeed!");
            session_start();
            $_SESSION["username"]=$username;
            
        }else{
            json_data(1,"Password and checkword are different",'');
        }
    }else{
        json_data(803,"The password is too short.",'');
    }
}else{
    json_data(2,"The name has existed.Please change another one.",'');
}
}else{
    json_data(4,"The name is not allowed empty.","");
}

mysqli_close($connect);