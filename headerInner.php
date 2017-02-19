<div class="container">
    <header>
        <a id="logo" href="user.php">Ultimate Scheduler</a>
        <div>
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" class="menu1" data-toggle="dropdown"><img src="images/<?php echo trim($_SESSION['fname']);?>.png"></a>
                <ul class="dropdown-menu  dropdown-menu-right" id="menu1" aria-labelledby="menu1">
                    <li><a href="logout.php">Log off</a></li>
                </ul>
            </div>
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" class="menu2" data-toggle="dropdown"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span></a>
                <ul class="dropdown-menu  dropdown-menu-right msg" aria-labelledby="menu2">
                    <li>
                        <a href="#"><b>No messages yet</b></a>
                    </li>
                </ul>
            </div>
            <div class="dropdown">
                <a href="#" class="dropdown-toggle menu2" id="notification" data-toggle="dropdown"><span class="glyphicon glyphicon-bell" aria-hidden="true"></span></a>
                <span class="buttonBadge"></span>
                <ul class="dropdown-menu dropdown-menu-right notify" aria-labelledby="menu2">
                    <li>
                        <a href="#">Moshe cohen sent new constrains
                            <div class="clear"></div>
                            <small>20 min ago</small>
                        </a>
                    </li>
                    <li>
                        <a href="#"><b>Remember to publish new shifts
                            <div class="clear"></div>
                            <small>Important</small></b>
                        </a>
                    </li>
                    <li>
                        <a href="#">Tal Kot sent new constrains
                            <div class="clear"></div>
                            <small>Yesterday at 10:23am</small>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="dropdown">
                <p id="welcomeUser">Welcome <?php echo $dbUserFname ?></p>
            </div>
        </div>
    </header>
