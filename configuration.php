<?php
    session_start();

    if(isset($_SESSION['id'])) {
        $username = $_SESSION['email'];
        $userId = $_SESSION['id'];
        $dbUserFname = $_SESSION['fname'];
        $role = $_SESSION['role'];
        $dbUserLname = $_SESSION['lname'];
        include("connection.php"); //connection.php
    } else {
        header('Location: index.php');
        die();
    }

?>

<?php include("header.php"); ?>
<!--<script src="includes/main.js"></script>-->
<body class="configuration">
<?php include("headerInner.php"); ?>
<?php include ("nav.php"); ?>
<main>
    <h1>Configuration</h1>
    <script type="text/javascript"><?php echo "var userID = $userId;";?></script>
    <?php if ($role === 'mgr') { ?>

        <section>
                <form id="configForm">
                    <div class="input-group">
                        <h4>Company</h4>
                        <input type="text" name="companyName" class="form-control" placeholder="EMC Inc." disabled>
                    </div>

                    <div class="input-group">
                        <h4>Admin</h4>
                        <input type="text" name="firstName" class="form-control" placeholder="Liat" disabled>
                    </div>
                    <div class="input-group">
                        <input type="text" name="lastName" class="form-control" placeholder="Perl" disabled>
                    </div>
                    <!--<div class="clear"></div>-->

                    <div class="input-group">
                        <h4>Shifts definition</h4>
                        <!--<a href="#"><span class="glyphicon glyphicon-plus add"></span></a>-->
                        <div id="shifts">
                            <div>
                                <input type="text" placeholder="Shift name">  Start: <input type="time">  End: <input type="time">
                            </div>
                            <div>
                                <input type="text" placeholder="Shift name">  Start: <input type="time">  End: <input type="time">
                            </div>
                            <div>
                                <input type="text" placeholder="Shift name">  Start: <input type="time">  End: <input type="time">
                            </div>
                        </div>
                    </div>

                    <div class="input-group">
                        <button type="button" class="btn settings">Apply</button>
                        <button type="reset" class="btn reset">Reset</button>
                    </div>
                </form>
        </section>
        <div class="alert alert-success" role="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> <p>New configurations have been saved</p>
        </div>
    </main> 

    <?php } else  ?> 
        <p> ACCESS DENIED </p>

        <?php include ("footer.php");?>