<?php 
	include 'init_mysql.php';
	$CompetitorId = $_GET['var1']; 
	//echo "CompetitorId: ".$CompetitorId;
?>

<h2>Tulos</h2>
	
<?php
	
	//Competitors basic information
	$q = mysqli_query($cv,"SELECT * FROM ammunta.kilpailut_kilpailijat WHERE id = '$CompetitorId'");
	if ($q->num_rows > 0) {
		while($row = $q->fetch_assoc()) {
			$CompetitorName = $row["etunimi"]." ".$row["sukunimi"];
			//$CompetitorSeries = $row["sarja"];
			//$CompetitorSport = $row["laji"];
			$CompetitorSportSeries = $row["lajit_sarjat_id"];
			$CompetitorTrack = $row["apaikka"];
			$CompetitorHeat = $row["era"];
			$Competition = $row["kilpailu_id"];
			$CompetitorGroup = $row["ryhma"];
			}
		} else {
  		echo "0 results";
			}
		
	//Amount of shots in the game
	$q2 = mysqli_query($cv,"SELECT * FROM ammunta.lajit_sarjat WHERE id = '$CompetitorSportSeries'");
	if ($q2->num_rows > 0) {
		while($row = $q2->fetch_assoc()) {
			$Y_factor =  $row["laukaukset"];
			}
		} else {
			echo "0 results";
		}
	$Y_factor = $Y_factor / 10;
	
	//Competitors results to array
	$q3 = mysqli_query($cv,"SELECT * FROM ammunta.tulokset WHERE kilpailija_id = '$CompetitorId'");
	while($row = $q3->fetch_assoc()) {
  	$results[] = $row;
		}
	
	//Next competitor id
	$q4 = mysqli_query($cv,"SELECT * FROM ammunta.kilpailut_kilpailijat WHERE kilpailu_id = '$Competition' AND era = '$CompetitorHeat' AND ryhma = '$CompetitorGroup' AND apaikka > $CompetitorTrack ORDER BY apaikka LIMIT 1");
	if ($q4->num_rows > 0) {
		while($row = $q4->fetch_assoc()) {
			$NextCompetitorId =  $row["id"];
			$NextCompetitorName = $row["etunimi"]." ".$row["sukunimi"];
			$NextCompetitorTrack = $row["apaikka"];
			//echo "NextCompetitorId: ".$NextCompetitorId;
			}
		} else {
			//echo "0 results (next competitor)";
			$DisplayNextNone = "Display_none";
			}
		
	//Previous competitor id
	$q5 = mysqli_query($cv,"SELECT * FROM ammunta.kilpailut_kilpailijat WHERE kilpailu_id = '$Competition' AND era = '$CompetitorHeat' AND ryhma = '$CompetitorGroup' AND apaikka < $CompetitorTrack ORDER BY apaikka DESC LIMIT 1");
	if ($q5->num_rows > 0) {
		while($row = $q5->fetch_assoc()) {
			$PrevCompetitorId = $row["id"];
			$PrevCompetitorName = $row["etunimi"]." ".$row["sukunimi"];
			$PrevCompetitorTrack = $row["apaikka"];
			//echo "PrevCompetitorId: ".$PrevCompetitorId;
			}
		} else {
			//echo "0 results (prev competitor)";
			$DisplayPrevNone = "Display_none";
			}
				
	echo "<ul><li><h4>Paikka: ".$CompetitorTrack."</h4></li>";
	echo "<li>Nimi: ".$CompetitorName."</li></ul>";
	/*echo "CompetitorSport: ".$CompetitorSport;
	echo "CompetitorSeries: ".$CompetitorSeries;
	echo "Y_factor: ".$Y_factor;*/
?>
				
<div class="ResultTableContainer">
	<div class="inline_block next_prev_result <?php echo $DisplayPrevNone ?>">
		<button id="Button_List" value="<?php echo $PrevCompetitorId;?>" class="tulos">Edellinen kilpailija<br>(<?php echo $PrevCompetitorTrack.". ".$PrevCompetitorName ?>)</button>
	</div>

	<div class="inline_block next_prev_result">
		<form>
			<table id="ResultTable">
				<tr>
					<td colspan="10">Laukaukset</tr>
				</tr>
				<tr>
					<td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td><td>8</td><td>9</td><td>10</td>
				</tr>
		<?php
			
			echo "<input type='hidden' id='CompetitorId' value='".$CompetitorId."'>";
			for ($y = 1; $y <= $Y_factor; $y++) {
  			echo "<tr>";
	 			for ($x = 1; $x < 11; $x++) {
  				$shot = 's'.$x;
  				$array_row = $y - 1; //Pitaa miinustaa koska edella tehty arrayn 1 rivi on 0
  				echo "<td><input id='".$y."_".$x."' type='text' name='".$y."_".$x."' style='width:22px;' class='ResultInput' value='".$results[$array_row][$shot]."'></td>";
					}
				echo "</tr>";
				}
				echo "</table>";
				echo "</form>";
		?>
	</div>

	<div class="inline_block next_prev_result <?php echo $DisplayNextNone ?>">
		<button id="Button_List" value="<?php echo $NextCompetitorId;?>" class="tulos">Seuraava kilpailija<br>(<?php echo $NextCompetitorTrack.". ".$NextCompetitorName ?>)</button>
	</div>
</div>


<button id="Button_List" value="<?php echo $Competition; ?>" class="kilpailu">Takaisin kilpailuun</button>
