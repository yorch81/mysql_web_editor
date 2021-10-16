<?php
require "config.php";
session_start();

$error = 0;

if (isset($_SESSION['MYSQL_EDITOR'])) {
  header("Location: index.php");
}

if (isset($_POST['txtUser'])) {
  $usr = $_POST['txtUser'];
  $pwd = $_POST['txtPassword'];

  if ($usr == $appUsr && $pwd == $appPwd) {
    $_SESSION['MYSQL_EDITOR'] = 1;
    header("Location: index.php");
  }
  else {
    $_SESSION['MYSQL_ERROR'] = 1;
    header("Location: login.php");
  }
}

if (isset($_SESSION['MYSQL_ERROR'])) {
  if ($_SESSION['MYSQL_ERROR'] == 1) {
    $error = 1;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>MySQL Editor</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="data:image/x-icon;base64,AAABAAEAEBAAAAEAIABoBAAAFgAAACgAAAAQAAAAIAAAAAEAIAAAAAAAAAQAABILAAASCwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADVlx0C2JceNtiXHnbZmB6k2ZcewNmXHs3Zlx7Q2ZcewNiXHqHYlx532JceONaWHgIAAAAAAAAAANKTHgHTlB5g05Qe3dWVHv/VlR7/1pUe/9aVHv/WlR7/1pUe/9aVHv/UlR7/1ZUe/9OUHv/TlB7f0ZIdZ9GTHgLPkR2E0ZId/9CSHf/Skx7/0pMd/9KTHf/TlB7/05Qe/9OUHv/TlB7/0pMd/9KTHf/Qkh3/0JId/86RHf/Mjx2RzI8d8M6RHf/OkB3/0JEd/9CRHf/PkR3/0ZId/9GSHf/Rkh3/z5Ed/8+RHf/QkR3/zpAd/86QHf/Mjx3/yo0d9cuOHffNjx3/zI8d/86QHf/OkB3/zpAd/8+RHf/PkR3/z5Ed/86QHf/OkB3/zpAd/8yPHf/Mjx3/yo4d/8iMHPnJjR33yY0d/8uPHf/NkB3/zY8d/82PHf/OkB3/zpAd/86QHf/Mjx3/zY8d/82PHf/Ljh3/y44d/8mNHP/Hixz5yY0d98mNHP/Ljh3/yo4d/8yPHf/Mjx3/zI8d/82QHf/Mjx3/zI8d/8yPHf/Mjx3/yo4d/8uOHf/JjRz/xosc+caLHPfJjR3/y44d/8iLHP/BgRf/ungT/7VzEf+zcBD/s3AQ/7VyEf+5dxP/wIAW/8iLG//IjRz/yY0d/8aLHPnHjBz3v4AX/7BsDv+qZQv/sm4P/7l3E/++fRb/wIAX/8B/F/+8exX/t3QS/61pDf+mYQn/q2cM/75/F//HjBz5tHMS96hjCv+3dRL/xIUZ/9KWIP/doyb/5q4q/+qzLf/qsy3/5Kwq/9uhJf/Okh//woIY/7JwEP+iXQn/s3IR+aJbB/qybg//w4MY/9OWIP/jqin/8rwx///OOP//3T///90////OOP/yvDD/4ago/9KVIP/BgRf/r2wP/6FbB/ugWAWormcM/7x5FP/MjBv/2Z0j/+etKv/yui//+MMz//nDM//zvDD/6a8q/9ufJP/Ojhz/vnwV/61oDf+fWAaonVMCBqNZBXupYQjrtW4O/797E//Jhhj/z44c/9OSHf/Tkx7/0ZAc/8uJGf/CfhX/uHIQ/61lCuukXAd7nlUEBgAAAAAAAAAAn1ICBqVYBESoXAaArWIIqbBlCcOxZwrQsWcK0LFmCsOuYwmpq2AHgKZbBUSjWAQGAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA//8AAMADAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADAAwAA//8AAA==" rel="icon" type="image/x-icon">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #fff;
      }
      
      .form-signin {
        max-width: 330px;
        padding: 15px;
        margin: 0 auto;
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin .checkbox {
        font-weight: normal;
      }
      .form-signin .form-control {
        position: relative;
        height: auto;
        -webkit-box-sizing: border-box;
           -moz-box-sizing: border-box;
                box-sizing: border-box;
        padding: 10px;
        font-size: 16px;
      }
      .form-signin .form-control:focus {
        z-index: 2;
      }
      .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
      }
      .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
      }
    </style>
</head>
<body>
    <div class="container">
      <center>
        <h3>MySQL Editor</h3>
      </center>

      <form class="form-signin" role="form" action="login.php" method="POST">
        <input type="text" class="form-control" placeholder="Username" name="txtUser" required autofocus>
        <input type="password" class="form-control" placeholder="Password" name="txtPassword" required>
        <button class="btn btn-lg btn-block" type="submit">Login</button>
      </form>
    </div>
</body>
<script type="text/javascript">
var errorNum = <?php echo $error; ?>;
$( document ).ready(function() {
  if (errorNum > 0) {
    $.notify("Username/password is incorrect", "error");
  }
});
</script>
</html>
