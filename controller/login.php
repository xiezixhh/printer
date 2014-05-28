<?php
header("Content-Type:text/html;charset=UTF-8"); 

$name=$_POST["teamID"];
if(!isset($name)){
	echo "请先登陆";
}else{
	//$name = str_replace("or", "x", $name);
	$con=mysql_connect("localhost","contest","2014contest_cose");
	mysql_query("set names utf-8",$con);
	mysql_select_db("printer",$con);
	$query = "select * from team_info where id='".$name."'";
	//echo $query;
	$row = mysql_query($query,$con);
	$rowNum=mysql_num_rows($row);
	//echo $rowNum;
	if($rowNum==0){
		echo "该id不存在，请检查您的id";
	}
	else{
		$md5=md5(rand(128,1024));
		$teamHash=$name.$md5;
		session_start();
		$_SESSION['teamID']=$name;
		$_SESSION['teamHash']=$teamHash;
		header("Location: ../view/print/printer.html");
		exit;
	}
}
?>