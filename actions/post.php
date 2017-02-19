<?php 
	require_once('../connection.php');
	if (isset($_POST["user"])&&isset($_POST["week"])&&isset($_POST["day"])&&isset($_POST["shift"])&&isset($_POST["status"])) {
		$updateSlotSql = 'UPDATE tbl_const_209 SET status='.strip_tags($_POST["status"]).' WHERE user_id='.strip_tags($_POST["user"]).' AND week_id='.strip_tags($_POST["week"]).' AND day_id='.strip_tags($_POST["day"]).' AND shift_id='.strip_tags($_POST["shift"]);
		$updateSlotRes = mysqli_query($dbCon, $updateSlotSql);

	}
	elseif (isset($_POST["user"])&&isset($_POST["week"])) {
		$updateStatusApplySql = 'UPDATE tbl_const_209 SET published=2 WHERE user_id='.strip_tags($_POST["user"]).' AND week_id='.strip_tags($_POST["week"]);
		$updateStatusApplyRes = mysqli_query($dbCon, $updateStatusApplySql);
	
		 if ($updateStatusApplyRes) {
			echo json_encode(array("msg"=>"applied the shifts waitting for manager!","code"=>1));
		}else{
			echo "Can't update";
		}
	}

	

?>