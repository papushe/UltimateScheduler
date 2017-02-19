<?php 
	require_once('../connection.php');
	if (isset($_POST["user"])) {
		$checkMsgSql = 'SELECT * FROM tbl_messages_209 WHERE send_to ='.strip_tags($_POST["user"]).' AND view != 1 LIMIT 1';
		$checkMsgRes = mysqli_query($dbCon, $checkMsgSql);
			if ($checkMsgRes) {
				$updateViewsql = 'UPDATE tbl_messages_209 SET view = 1 where send_to = '.strip_tags($_POST["user"]);
				$updateViewRes = mysqli_query($dbCon, $updateViewsql);
					$checkMsgrow = $checkMsgRes->fetch_assoc();
					echo $checkMsgrow['msg'];
					die;
			}
			else{
				die;
			}
	}

?>