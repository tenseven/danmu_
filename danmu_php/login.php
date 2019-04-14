<?php
header('Content-Type: application/json');
require_once('./connect.php');
$username=htmlspecialchars(trim($_POST['user1']));
$password=htmlspecialchars(trim($_POST['password']));
$select_sql = $connect->prepare("SELECT * FROM test WHERE name=?");
$select_sql->bind_param("s",$username);
$select_sql->execute();
$result_arr=$select_sql->get_result();
$userarray=mysqli_fetch_array($result_arr);
function json_data($errcode,$errmsg,$data){
    $json_format=[
        'errcode'=>$errcode,
        'errmsg'=>$errmsg,
        'data'=>$data
    ];
    echo json_encode($json_format);
}
if($userarray!=NULL){
    if($password==$userarray[2]){
        json_data(0,'','succeed!');
        session_start();
        $_SESSION["username"]=$username;
    }
        else{
            json_data(4,'The password is wrong.Please check it again.','');
        }
}else{
    json_data(3,'The user name does not exist','');
}
mysqli_close($connect);