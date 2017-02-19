<?php
   if (isset($_POST['submit'])) {
        include("connection.php"); //connection.php
        $firstName = strip_tags($_POST['firstName']);
        $lastName = strip_tags($_POST['lastName']);
        $email = strip_tags($_POST['email']);
        $password = strip_tags($_POST['password']);
        $role = "emp";

        $sql = "INSERT INTO tbl_users_209 (f_name, l_name, email , password, role, img_path)
        VALUES ('".$firstName."','".$lastName."','".$email."','".$password."','".$role."','NULL')";

        if (mysqli_query($dbCon, $sql)) {
        $sqlUser = "SELECT * FROM tbl_users_209 WHERE email = '$email' LIMIT 1";
                 
        $query = mysqli_query($dbCon, $sqlUser); 
         if ($query) {
            $row = mysqli_fetch_row($query); 
            $userId = $row[0];
        }
        $week = date("W");
        $week = (int)$week;
        $week10=$week+10;
        $insertNewConstSql = "INSERT INTO `tbl_const_209` (`id`, `week_id`, `day_id`, `user_id`, `shift_id`, `status`, `published`) VALUES ";

        for ($w=$week; $w<=$week10; $w++) { 
            
            for ($s=1; $s<=3 ; $s++) { 
                for ($d=1; $d<=7; $d++) { 
                    if ($w==17 && $d==7 && $s==3) {
                        $insertNewConstSql .= "(NULL, $w, $d, $userId, $s, 0, 0)";
                    }
                    else{
                        $insertNewConstSql .= "(NULL, $w, $d, $userId, $s, 0, 0),";
                    }
                }
            }
        }
            $sqlUserRes = mysqli_query($dbCon, $insertNewConstSql); 
            sleep(5);
            if ($sqlUserRes) {
                mysqli_close($dbCon);
                header('Location: index.php');
            }
            else{
                echo "Error: " . $sqlUserRes . "<br>" . mysqli_error($dbCon);
            }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($dbCon);
    }
       mysqli_close($dbCon);
   }
    ?>
<?php include("header.php"); ?>
<body class="createAccount login">
<div class="container">
    <header>
        <a id="logo" href="#">Ultimate Scheduler</a>
    </header>
    <div class="clear"></div>
    <main>
        <div class="panel panel-default">
            <div class="panel-heading"><p>Sign up</p></div>
            <div class="panel-body">
                <form  method="post" action="register.php" >
                    <div class="input-group">
                        <input type="text" name="companyName" class="form-control" placeholder="Company Name" required>
                    </div>
                    <div class="input-group">
                        <input type="text" name="firstName" class="form-control" placeholder="First Name" required>
                    </div>
                    <div class="input-group">
                        <input type="text" name="lastName" class="form-control" placeholder="Last Name" required>
                    </div>
                    <div class="clear"></div>
                    <div class="input-group">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="input-group">
                        <input type="password" name="password" class="form-control" placeholder="Password" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                    </div>
                    <input type="submit" name="submit" value="Create Account" class="btn btn-default">
                </form>
            </div>
        </div>
    </main>
<?php include("footer.php"); ?>