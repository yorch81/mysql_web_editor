<?php
  require "config.php";
  require "DB.class.php";

  session_start();

  if (isset($_SESSION['MYSQL_EDITOR'])) {
    $dbc = new DB($dbHost, $dbUser, $dbPwd, $dbName, $dbPort);

    $query = '';
    $q = '';

    if (isset($_GET["q"])) {
      $query = base64_decode($_GET["q"]);
      $q = $_GET["q"];
      $rs = $dbc->query($query);
    }
  }
  else {
    header("Location: login.php");
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

  <meta charset="utf-8"/>

  <link rel=stylesheet href="lib/codemirror.css">
  <script src="lib/codemirror.js"></script>
  <script src="mode/sql/sql.js"></script>
  <script src="mode/css/css.js"></script>
  <script src="mode/htmlmixed/htmlmixed.js"></script>
  <script src="addon/edit/matchbrackets.js"></script>

  <style>
    body {
      background-color: white;
    }
    
    .container {
      background-color: white;
    }

    .workarea {
      padding-left: 20px;
      padding-right: 20px;
    }

    thead {
      background-color: gray;
      color: white;
    }
  </style>
</head>
<body>
  <div class="workarea">
    <center>
      <h3>MySQL Editor</h3>
    </center>
    <textarea id="txtSQL"></textarea>
    <br/>
    <button id="btnExecute" type="button" class="btn btn-lg" hidden="hidden">Execute</button>
    <a href="logout.php" class="btn btn-lg btn-danger" hidden="hidden">Exit</a>
    <br/><br/>
    <?php if (is_null($rs)) { ?>
      <p id="lblQuery">Query no results</p>
    <?php 
      } 
      else {
        echo '<p id="lblQuery">Query results</p>';
        $columnsNames = array_keys($rs[0]);

        echo '<table class="table table-striped table-bordered"><thead><tr>';

        for ($i=0; $i < count($columnsNames); $i++) {
          echo "<th>" . $columnsNames[$i] . "</th>";
        }

        echo '</tr></thead><tbody>';

        for ($j=0; $j < count($rs); $j++) { 
          echo '<tr>';

          for ($i=0; $i < count($columnsNames); $i++) {
            echo "<th>" . $rs[$j][$columnsNames[$i]] . "</th>";
          }

          echo '</tr>';
        }

        echo '</tbody></table>';
      } 
    ?>
  </div>
</body>
<script>
  $( document ).ready(function() {
    var query = "<?php echo $q; ?>";
    query = atob(query);
    
    var editor = CodeMirror.fromTextArea(document.getElementById("txtSQL"), {
      lineNumbers: true,
      mode: "text/x-mysql",
      matchBrackets: true
    });

    if (query.length > 0) {
      editor.setValue(query);
    }
    else {
      $("#lblQuery").hide();
    }

    $("#btnExecute").click(function() {
        var cQuery = editor.getValue();

        if (cQuery == "") {
          $.notify("You must type a MySQL query", "error");
        }
        else {
          window.location.replace("./index.php?q=" + btoa(cQuery));
        }
    });
  });
</script>
</html>
