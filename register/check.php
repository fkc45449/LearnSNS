<?php


		require('../../../functions.php');
		require('../dbconnect.php');
		session_start();


		$name = $_SESSION['46_LearnSNS']['name'];
		$email = $_SESSION['46_LearnSNS']['email'];
		$password = $_SESSION['46_LearnSNS']['password'];
		$file_name = $_SESSION['46_LearnSNS']['file_name'];


		if(!isset($_SESSION['46_LearnSNS'])) {
				header('Location: signup.php');
				exit();
		}


		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$hash_password = password_hash($password, PASSWORD_DEFAULT);
				$sql = 'INSERT INTO `users` SET `name` = ?, `email` = ?, `password` = ?, `img_name` = ?, `created` = NOW()';
				$stmt = $dbh->prepare($sql);
				$data = array($name, $email, $hash_password, $file_name);
				$stmt->execute($data);
				unset($_SESSION['46_LearnSNS']);
				header('Location: thanks.php');
				exit();
		}


?>

<!DOCTYPE html>
<html lang="jp">
<head>
	<title></title>
	<meta charset="utf-8">
</head>
<body>
	<div>
		ユーザー名：	<?=htmlspecialchars($name) ?>
	</div>
	<div>
		メールアドレス：	<?=htmlspecialchars($email) ?>
	</div>
	<div>
		パスワード：●●●●●●●●
	</div>
	<div>
		プロフィール画像：
		<img src="../user_profile_img/<?=htmlspecialchars($file_name) ?>" width="100">
	</div>
	<div>
		<form method="POST" action="">
			<input type="hidden" name="name" value="$name">
			<input type="hidden" name="email" value="$email">
			<input type="hidden" name="password" value="$password">
			<input type="hidden" name="file_name" value="file_name">
			<input type="submit" value="アカウント作成">
		</form>
	</div>
</body>
</html>