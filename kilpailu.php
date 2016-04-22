<?php 
	include 'init_mysql.php';
	$CompId = $_GET['var1']; 
	//echo "compid: ".$CompId;
	
?>

	
	
	<?php
	
		$q = mysqli_query($cv,"SELECT * FROM ammunta.kilpailut WHERE id = '$CompId'");
		if ($q->num_rows > 0) {
			while($row = $q->fetch_assoc()) {
				echo "<h2>".$row["nimi"]."</h2><p>".$row["aloituspaiva"]."-".$row["lopetuspaiva"].", ".$row["paikka"]."</p>";
     		}
				} else {
    			echo "0 results";
				}
			?>

			<!--
			<h3>Esitiedot ratapohjalle</h3>
			<br>Valitse rata
			<select id="selected_track">
				<option value="0">valitse ratapohja</option>
			  <option value="1">Aitovuori - 25 m</option>
			  <option value="5">Aitovuori - 25 m Isopistooli</option>
			  <option value="2">Aitovuori - 50 m</option>
			  <option value="3">Peltokatu - Ilma</option>
			  <option value="4">Peltokatu - Ilma-olympia</option>
			</select> 
			<input id="selected_heat" type="text" name="era" value="era">
			<input id="selected_day" type="text" name="paiva" value="paiva">
			<button class='Button_MakeTrack'>Luo ratapohja</button>
			-->
			
			<div id="div_NewCompetition"></div>

	<?php
	
	$GroupNumber = 0;
	$current_ryhma = "NULL";
	$q = mysqli_query($cv,"SELECT * FROM ammunta.kilpailut_kilpailijat WHERE kilpailu_id = '$CompId' ORDER BY ryhma");
	$q_rows = mysqli_num_rows($q);
	$q_row = 0;
				
		if ($q->num_rows > 0) {
			while($row = $q->fetch_assoc()) {
				
				if ($row["ryhma"] != $current_ryhma) {
					
					include 'kilpailu_ryhma.php';
				
					$current_ryhma = $row["ryhma"];
				}
				
			}
		}

?>

