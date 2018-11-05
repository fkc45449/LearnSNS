<?php

		session_start();
		require('../../functions.php');
		require('dbconnect.php');

		$_SESSION = [];
		session_destroy();
		header('Location: signin.php');
		exit();

?>


<!DOCTYPE html>
<html lang="jp">
<head>
	<title></title>
	<meta charset="utf-8">
</head>
<body>

</body>
</html>