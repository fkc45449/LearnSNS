<?php


    require('../../functions.php');
    require('dbconnect.php');
    session_start();


    $email='';
    $password='';
    $failed='';


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email=htmlspecialchars($_POST['email']);
        $password=htmlspecialchars($_POST['password']);

        if ($email!='' && $password!='') {
            $sql = 'SELECT * FROM `users` WHERE `email`=?';
            $data = array($email);
            $stmt = $dbh->prepare($sql);
            $stmt->execute($data);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user==false) {
                $failed = 'サインインに失敗しました';
                $validations['signin'] = 'failed';
            } else {
                $verify = password_verify($password, $user['password']);
                if ($verify==true) {
                    $_SESSION["id"] = $user['id'];
                    header('Location: timeline.php');
                    exit();
                } else {
                    $failed = 'サインインに失敗しました';
                    $validations['signin'] = 'failed';
                }
            }
        }

        if ($email==''||$password=='') {
            $failed = '正しいメールアドレスとパスワードを入力して下さい';
            $validations['signin'] = 'failed';
        }

    }


?>


<!DOCTYPE html>
<html lang="jp">
<head>
  <title></title>
  <meta charset="utf-8">
</head>
  <style>
    .error_msg {
      color: red;
      font-size: 12px;
    }
  </style>
<body>
  <form method="POST" action="">
    <div>
      メールアドレス<br>
      <input type="email" name="email" value="<?=$email ?>"><br>
    </div>
    <div>
      パスワード<br>
      <input type="password" name="password" value=""><br>
    <div>
      <span class="error_msg"><?=$failed ?></span>
    </div>
    <div>
      <input type="submit" value="サインイン">
    </div>
    <br>
    <div>
      <input type="button" value="新規アカウントの作成" onclick="location.href='register/signup.php'">
    </div>
  </form>
</body>
</html>