<?php
    session_start();
    if (isset($_POST['submit'])) {
        include("connection.php"); //connection.php
        $username = strip_tags($_POST['email']);
        $password = strip_tags($_POST['password']);
        $sql = "SELECT * FROM tbl_users_209 WHERE email = '$username' LIMIT 1";
        $query = mysqli_query($dbCon,$sql);
         if ($query) {
            $row = mysqli_fetch_row($query); 
            $userId = $row[0];
            $dbUserFname = $row[1];
            $dbUserLname = $row[2];
            $dbUsername = $row[3];
            $dbPassword = $row[4];
            $role = $row[5];
            $img_path = $row[6];
         }
        if ($username == $dbUsername && $password == $dbPassword) {
            $_SESSION['email'] = $username;
            $_SESSION['id'] = $userId;
            $_SESSION['fname'] = $dbUserFname;
            $_SESSION['lname'] = $dbUserLname;
            $_SESSION['role'] = $role;
            $_SESSION['img'] = $img_path;

            header('Location: user.php');
        } else {
            echo "Invalid arguments";
        }
    }
?>
<?php include("header.php"); ?>
<body class="login">
<div class="container">
    <header>
        <a id="logo" href="#">Ultimate Scheduler</a>
    </header>
    <div class="description">
        <h1>IMPROVE YOUR EFFICIENCY</h1>
        <h3>Automatic management system shifts under constraints</h3>
    </div>
    <main>
        <div class="panel panel-default">
            <div class="panel-heading"><p>Who's there?</p></div>
            <div class="panel-body">
                <form method="post" action="index.php">
                    <div class="input-group">
                        <span class="input-group-addon" id="email"><span class="glyphicon glyphicon-envelope"></span></span>
                        <input type="email" name="email" class="form-control" placeholder="E-mail" aria-describedby="email">
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon" id="pwd"><span class="glyphicon glyphicon-lock"></span></span>
                        <input type="password" name="password" class="form-control" placeholder="Password" aria-describedby="pwd">
                    </div>
                    <div class="clear"></div>
                    <input type="submit" name="submit" value="Login" class="btn btn-default">
                </form>
            </div>
        </div>
        <p><a href="#">Reset Password</a> or <a href="register.php">Create account</a></p>
    </main>
<?php include("footer.php"); ?>