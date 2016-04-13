<?php
	// Unescape the string values in the JSON array
	$tableData = stripcslashes($_POST['pTableData']);
	// Decode the JSON array
	$tableData = json_decode($tableData,TRUE);
	// now $tableData can be accessed like a PHP array

	$SaveType = stripcslashes($_POST['SaveType']);
	$ListItem = stripcslashes($_POST['ListItem']);
	$count = count($tableData); //amount of rows

	include 'init_mysql.php';
	
	echo("keke".$count.$SaveType);
	
	for ($i = 0; $i < $count; $i++) {
 		
 		if ($SaveType == 'kilpailut'){
		
		$id = $tableData[$i]['0'];
		$name = $tableData[$i]['1'];
		$startdate = $tableData[$i]['2'];
		$enddate = $tableData[$i]['3'];
		$location = $tableData[$i]['4'];
   	echo "*".$id."*";
  	if ($id==''){
			mysqli_query($cv,"INSERT INTO `ammunta`.`kilpailut` (`nimi`, `aloituspaiva`, `lopetuspaiva`, `paikka`) VALUES ('$name', '$startdate', '$enddate', '$location')");
			//print "Tallennetaan uusi".$name;
			}
  		else {
  			mysqli_query($cv,"UPDATE ammunta.kilpailut SET nimi='$name',aloituspaiva='$startdate',lopetuspaiva='$enddate',paikka='$location' WHERE id='$id'");
  			//print "Paivitetaan vanha".$name;
  			}
  	
  		} else if ($SaveType == 'kilpailu'){
  	
  				$id = $tableData[$i]['0'];
					$group = $tableData[$i]['1'];
					$heat = $tableData[$i]['2'];
					$date = $tableData[$i]['3'];
					$position = $tableData[$i]['4'];
					$firstname = $tableData[$i]['5'];
					$lastname = $tableData[$i]['6'];
					$class = $tableData[$i]['7'];
					$sport = $tableData[$i]['8'];
					$club = $tableData[$i]['9'];
					$CompId = $tableData[$i]['10'];
					if ($CompId == ''){ $CompId = $ListItem; } //When creating new, theres no CompId which is mandatory
					$paid = $tableData[$i]['11'];
					$other = $tableData[$i]['12'];
					$track = $tableData[$i]['13'];
					$sport_class = $tableData[$i]['14'];
					
			   	echo "id: ".$id." ";
			   	echo "compid: ".$CompId." ";
			   	echo "group: ".$group." ";
			   	echo "heat: ".$heat." ";
			   	echo "date: ".$date." ";
			   	echo "position: ".$position." ";
			   	echo "paid: ".$paid."<br><br>";/**/
			   	
			  	if ($id==''){
						mysqli_query($cv,"INSERT INTO `ammunta`.`kilpailut_kilpailijat` (`ryhma`, `era`, `kilpailu_id`, `paiva`, `rata`, `apaikka`, `etunimi`, `sukunimi`, `lajit_sarjat_id`, `sarja`, `laji`, `seura`, `maksanut`, `muuta`) VALUES ('$group', '$heat', '$CompId', '$date', '$track', '$position', '$firstname', '$lastname', '$sport_class', '$class', '$sport', '$club', '$paid', '$other')");
						print "Tallennetaan uusi".$firstname;
						}
			  		else {
			  			mysqli_query($cv,"UPDATE ammunta.kilpailut_kilpailijat SET ryhma='$group', era='$heat', paiva='$date', rata='$track', apaikka='$position', etunimi='$firstname', sukunimi='$lastname', lajit_sarjat_id='$sport_class', sarja='$class', laji='$sport', seura='$club', maksanut='$paid', muuta='$other' WHERE id='$id'");
			  			print "Paivitetaan vanha".$firstname;
			  			}		
  			
  				}

				else if ($SaveType == 'lajit_sarjat'){
					$id = $tableData[$i]['0'];
					$laji = $tableData[$i]['1'];
					$sarja = $tableData[$i]['2'];
					$laukaukset = $tableData[$i]['3'];
					$kuvaus = $tableData[$i]['4'];
			   	echo "*".$id."*";
			  	if ($id==''){
						mysqli_query($cv,"INSERT INTO `ammunta`.`lajit_sarjat` (`laji`, `sarja`, `laukaukset`, `kuvaus`) VALUES ('$laji', '$sarja', '$laukaukset', '$kuvaus')");
						//print "Tallennetaan uusi".$name;
						}
			  		else {
			  			mysqli_query($cv,"UPDATE ammunta.lajit_sarjat SET laji='$laji',sarja='$sarja',laukaukset='$laukaukset',kuvaus='$kuvaus' WHERE id='$id'");
			  			//print "Paivitetaan vanha".$name;
			  			}
					}

}

		echo "Tiedot tallennettiin";


?>