
<?php
header("Content-type: text/html; charset=utf-8");
session_start();
$teamID=$_SESSION['teamID'];
$code = $_POST["txtcomment"];
$printTxt=$teamID.'                                                                                              '.$code;
$preString=$teamID.'preTime';
if(isset($code)){
	$handle = printer_open("Canon Inkjet iP1100 series");//HP LaserJet 5200L UPD PCL 6  Canon Inkjet iP1100 series
	if ($handle){
		if(!isset($_SESSION[$preString])){
//			echo "first";
			echo "<strong>拼命打印中。。。</strong>";
			printer_write($handle, $printTxt);
			$_SESSION[$preString]=time();
		}else{
			$preTime=$_SESSION[$preString];
			$curTime=time();
			$delTime=$curTime-$preTime;
			if($delTime>=300){
				printer_write($handle, $printTxt);
				$_SESSION[$preString]=time();
				echo "<strong>拼命打印中。。。</strong>";
			}else{
				echo "五分钟内不能重复打印";
			}
		}

	}
	else{
			echo "打印机出了点问题";
	} 
	printer_close($handle);
}
else{
	echo "请粘贴代码";
}
?>