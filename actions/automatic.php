<?php
require_once('../connection.php');
	if (isset($_POST["week"])) {
		$nextWeek = date("W")+1;
	    $nextWeek = (int)$nextWeek;
	   
	    $sqlUpdatePublishedAlgo = 'UPDATE tbl_const_209 SET published = 1 WHERE week_id='.$_POST["week"].' AND status =1';
	    $sqlUpdatePublishedAlgoRes = mysqli_query($dbCon,$sqlUpdatePublishedAlgo);
	    if($sqlUpdatePublishedAlgoRes){
	    	echo 'Shifts are published with great success !';
	    }
	    else{
	    	echo "Opps!";
	    }
    }
?>