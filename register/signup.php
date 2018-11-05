<?php


		require('../../../functions.php');
		session_start();


		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$name=htmlspecialchars($_POST['name']);
				$email=htmlspecialchars($_POST['email']);
				$password=htmlspecialchars($_POST['password']);
				$file_name=htmlspecialchars($_FILES['img_name']['name']);
				if ($name=='') {
						$name_msg = 'ユーザー名を入力して下さい';
						$validations['name'] = '未入力';
				}
				if ($email=='') {
						$email_msg = 'メールアドレスを入力して下さい';
						$validations['email'] = '未入力';
				}
				$c = strlen($password);
				if ($password=='') {
						$password_msg = 'パスワードを入力して下さい';
						$validations['password'] = '未入力';
				} elseif ($c<4||$c>16) {
						$password_msg = 'パスワードを4~16文字で入力して下さい';
						$validations['password'] = '文字数';
				}
				if ($file_name=='') {
						$file_name_msg = '画像を選択して下さい';
						$validations['img_name'] = '未添付';
				}
				if (empty($validations)) {
						$tmp_file = $_FILES['img_name']['tmp_name'];
						$file_name = date('ymdhis') . $_FILES['img_name']['name'];
						$destination = '../user_profile_img/' . $file_name;
						move_uploaded_file($tmp_file, $destination);
						$_SESSION['46_LearnSNS']['name']  = $name;
						$_SESSION['46_LearnSNS']['email']  = $email;
						$_SESSION['46_LearnSNS']['password']  = $password;
						$_SESSION['46_LearnSNS']['file_name']  = $file_name;
						header('Location: check.php');
						exit();
				}
		} else {
				$name='';
				$email='';
				$password='';
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
	<h1>アカウント登録</h1>
	<form method="POST" action="" enctype="multipart/form-data">
		<div>
			ユーザー名<br>
			<input type="text" name="name" size="30" placeholder="ユーザー名を入力して下さい" value="<?=$name ?>"><br>
			<?php if(isset($validations['name'])&&$validations['name']!=''): ?>
				<span class="error_msg"><?=$name_msg ?></span>
			<?php endif; ?>
		</div>
		<div>
			メールアドレス<br>
			<input type="email" name="email" size="30" placeholder="メールアドレスを入力して下さい" value="<?=$email ?>"><br>
			<?php if(isset($validations['email'])&&$validations['email']!=''): ?>
				<span class="error_msg"><?=$email_msg ?></span>
			<?php endif; ?>
		</div>
		<div>
			パスワード<br>
			<input type="password" name="password" size="30" placeholder="パスワードを入力して下さい"><br>
			<?php if(isset($validations['password'])&&$validations['password']!=''): ?>
				<span class="error_msg"><?=$password_msg ?></span>
			<?php endif; ?>
		</div>
		<div>
			プロフィール画像<br>
			<input type="file" name="img_name" accept="image/*"><br>
			<?php if(isset($validations['img_name'])&&$validations['img_name']!=''): ?>
				<span class="error_msg"><?=$file_name_msg ?></span>
			<?php endif; ?>
		</div>
		<br>
		<input type="submit" value="確認">
	</form>
</body>
</html>