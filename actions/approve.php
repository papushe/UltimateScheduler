<?php
require_once('../connection.php');
if (isset($_POST["user"])&&isset($_POST["week"])) {
		$updateStatusApplySql = 'UPDATE tbl_const_209 SET published=3 WHERE user_id='.strip_tags($_POST["user"]).' AND week_id='.strip_tags($_POST["week"]);
		$updateStatusApplyRes = mysqli_query($dbCon, $updateStatusApplySql);
		 if ($updateStatusApplyRes) {
		 	$updateMsgSql = 'INSERT INTO `tbl_messages_209` (`id`, `send_to`, `msg`, `view`) VALUES (NULL, '.strip_tags($_POST["user"]).',"shifts approved by your manager!", 0)';
			
		}else{
			echo "Can't update";
		}
	}
?>