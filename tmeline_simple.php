<?php


		session_start();
		require('../../functions.php');
		require('dbconnect.php');

    $sql = 'SELECT * FROM `users` WHERE `id`=?';
    $data = array($_SESSION['id']);
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);


    $user_id = $user["id"];
		$feed_msg = '';
		$img_name = '';
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$feed=htmlspecialchars($_POST['feed']);
				$img_name=htmlspecialchars($_POST['img_name']);
				if ($feed=='') {
						$feed_msg = '投稿内容を入力して下さい';
				} else {
						$sql = 'INSERT INTO `feeds` SET `feed` = ?, `user_id` = ?, `img_name` = ?, `created` = NOW()';
						$stmt = $dbh->prepare($sql);
						$data = array($feed, $user_id, $img_name);
						$stmt->execute($data);
				}
		}

?>


<!DOCTYPE html>
<html lang="jp">
<head>
	<title></title>
	<meta charset="utf-8">
	<style>
		.error_msg {
			color: red;
			font-size: 12px;
		}
	</style>
</head>
<body>
<div>
【ユーザー情報】<br>
<?=$user["name"]?><br>
<img src="user_profile_img/<?=$user['img_name'] ?>" width="100"><br>
</div>
[<a href="signout.php">サインアウト</a>]
<form method="POST" action="" enctype="multipart/form-data">
	<textarea rows=5 name="feed"></textarea><br>
	<span class="error_msg"><?=$feed_msg ?></span><br>
				<input type="file" name="img_name" accept="image/*"><br>
	<input type="submit" name="投稿">
</form>
</body>
</html>