//声明php文件

<?php

//封装连接数据库函数conn（），注意：里面的5个参数，第一个为主机地址，如“127.0.0.1”，第二个为用户名，如“root”,第三个为密码，如“root”,

// 第四个为连接的数据库名，如“test”，第五个是我新加的参数，
// $char="utf8"
// 表示为如果不填写第五个参数，它会默认为“utf8”，记住，所有的参数都要用英文状态的引号包起来。

function conn($localhost,$user,$pwd,$dbName,$char="utf8"){
//建立一个连接数据库的连接
$link=mysqli_connect($localhost, $user, $pwd, $dbName);

//如果这个连接返回的是false，就说明连接数据库失败

if($link==false){

//exit相当于return，后面的不再执行

exit("连接数据库失败，请检查参数是否正确");

}

//否者，就是连接成功

else{

//设置字符编码

mysqli_set_charset($link,$char);

//返回这个连接

return $link;

}   }

//封装查询的函数

function select($link,$sql){

//执行sql语句的查询

$res=mysqli_query($link, $sql);

//如果执行查询失败

if($res==false){

//返回错误error和错误的编号，并且不再执行下面的代码

echo "error".mysqli_errno($link);

exit;

}

//查询成功

else{

//用变量$arr接收查询成功的结果集

$arr=mysqli_fetch_all($res);

//如果这个结果集不为空

if($arr){

//返回结果集给login.php文件

return $arr;

}

//如果这个结果集为空

else{

//返回null，空

return null;

}  }

//执行查询函数，需要释放结果集

mysqli_free_result($arr);

//关闭数据库

mysqli_close($link);

}

//封装插入数据库的函数

function insert($link,$sql){

//执行sql语句的插入

$res=mysqli_query($link, $sql);

//如果执行插入失败

if($res==false){

//返回插入失败的错误error和错误编号，并且不再执行下面的代码

// echo "error".errno($link);

exit;

}

//否者，执行插入成功

else{

//插入成功会产生一个受影响的行

$row=mysqli_affected_rows($link);

//如果受影响的行大于0，说明插入成功，也就是注册成功

if($row>0){

//给register.php返回1

return 1;

}

//否者

else{

//给register.php返回0，说明插入失败，也就是注册失败

return 0;

}  }

//关闭数据库

mysqli_close($link);

}

?>