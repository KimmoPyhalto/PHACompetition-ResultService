<?php
	
	$CompetititorId = stripcslashes($_POST['CompetititorId']);
	$ResultNumber = stripcslashes($_POST['ResultNumber']);
	$ResultYpos = stripcslashes($_POST['ResultYpos']);
	$ResultXpos = stripcslashes($_POST['ResultXpos']);
	
	

	include 'init_mysql.php';
	
	echo("CompetititorId: ".$CompetititorId." ResultNumber: ".$ResultNumber." ResultYpos: ".$ResultYpos." ResultXpos: ".$ResultXpos);
	
	$q = mysqli_query($cv,"SELECT * FROM ammunta.tulokset WHERE kilpailija_id = '$CompetititorId' AND sarja = '$ResultYpos'");
	if ($q->num_rows > 0) {
		$NewRow = 'false';
		} else {
    	$NewRow = 'true';
			}
	
	if ($NewRow == 'true'){
		mysqli_query($cv,"INSERT INTO `ammunta`.`tulokset` (`kilpailija_id`, `sarja`, s$ResultXpos) VALUES ('$CompetititorId', '$ResultYpos', '$ResultNumber')");
		echo "uusi";
		}
		else {
  		mysqli_query($cv,"UPDATE ammunta.tulokset SET s$ResultXpos='$ResultNumber' WHERE kilpailija_id = '$CompetititorId' AND sarja = '$ResultYpos'");
  		echo "paivitys";		
  		}
	?>