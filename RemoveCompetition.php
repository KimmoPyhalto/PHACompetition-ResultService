<?php

	$Id = stripcslashes($_POST['Id']); 
	$RemoveType = stripcslashes($_POST['RemoveType']);
	
	include 'init_mysql.php';
	
	if($Id != ''){
		
		if($RemoveType == 'Remove_Competition'){
			mysqli_query($cv,"DELETE FROM ammunta.kilpailut WHERE id = '$Id'");
			mysqli_query($cv,"DELETE FROM ammunta.kilpailut_kilpailijat WHERE kilpailu_id = '$Id'");
			}
		
		if($RemoveType == 'Remove_Competitor'){
			echo ("poistetaan ".$Id);
			mysqli_query($cv,"DELETE FROM ammunta.kilpailut_kilpailijat WHERE id = '$Id'");
			}
			
		if($RemoveType == 'Remove_Result'){
			mysqli_query($cv,"DELETE FROM ammunta.kilpailut_tulokset WHERE kilpailija_id = '$Id'");
			}
			
			
		if($RemoveType == 'Remove_Sports'){
			mysqli_query($cv,"DELETE FROM ammunta.lajit_sarjat WHERE id = '$Id'");
			}
				
		}
	
	echo "Poistettu";

?>