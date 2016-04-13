<?php 
	include 'init_mysql.php';
	
	$CompetitorId = $_GET['var1']; 
	
	echo "CompetitorId: ".$CompetitorId;
?>

	<h2>Tulos</h2>
	
	<?php
	
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
				}
				} else {
    			echo "0 results";
				}
			
			$q2 = mysqli_query($cv,"SELECT * FROM ammunta.lajit_sarjat WHERE id = '$CompetitorSportSeries'");
		if ($q2->num_rows > 0) {
			while($row = $q2->fetch_assoc()) {
				$Y_factor =  $row["laukaukset"];
			}
			} else {
    			echo "0 results";
				}
			$Y_factor = $Y_factor / 10;
			
			
			$q3 = mysqli_query($cv,"SELECT * FROM ammunta.tulokset WHERE kilpailija_id = '$CompetitorId'");
			while($row = $q3->fetch_assoc()) {
  	   $results[] = $row;
    }
			
				echo "<ul><li><h4>Paikka: ".$CompetitorTrack."</h4></li>";
				echo "<li>Nimi: ".$CompetitorName."</li></ul>";
				echo "CompetitorSport: ".$CompetitorSport;
				echo "CompetitorSeries: ".$CompetitorSeries;
				echo "Y_factor: ".$Y_factor;
				echo "<form>";
				echo "<table id='ResultTable'>";
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
				echo "<button id='Button_List' value='".$Competition."' class='kilpailu'>Takaisin kilpailuun</button>";
				
			
			?>


