<?php
//获取演出类别
//1 连接数据库服务器
$conn = mysql_connect("localhost", "root", "root") or die("connect failed!" . mysql_error());
mysql_query("SET NAMES UTF8");
/**
 * undocumented constant
 **/
//2 连接数据库
mysql_select_db("ShowDB", $conn) or die("select db failed" . mysql_error());

//3 执行SQL 语句
$tel = $_POST["tel"];
$pwd = $_POST["pwd"];
// var_dump($tel);
// var_dump($pwd);

//判断手机号是否重复
$sql = "select * from t_user where user_phone='$tel'";
$result = mysql_query($sql);
if (mysql_num_rows($result) == 1) {
    //注册失败
    $json = json_encode(array("resultCode" => 501, "message" => "failed! the phone is existed!"));
    echo($json);
} else {
    //可以注册
    $sql = "insert into t_user(user_phone,user_password)values('$tel','$pwd')";
    //mysql_query执行非select时返回布尔类型的值
    $result = mysql_query($sql);
//针对insert、update、delete 返回受影响的行数
    $count = mysql_affected_rows();
    if ($count == 1) {
        //注册成功
        $json = json_encode(array("resultCode" => 200, "message" => "successed!"));
        echo($json);
    } else {
        //注册失败
        $json = json_encode(array("resultCode" => 500, "message" => "failed!error!"));
        echo($json);
    }
}


//5 关闭数据库
mysql_close($conn);


//post请求
//Headers 设置 Content-Type为application/x-www-form-urlencoded
//body x-www-form-urlencoded 然后设置post的 key value值


?>