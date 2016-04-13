<?php

$SelectedTrack = $_GET['SelectedTrack'];
$SelectedHeat = $_GET['SelectedHeat'];
$SelectedDay = $_GET['SelectedDay'];

echo $SelectedHeat;
echo $SelectedDay;


if ($SelectedTrack == '1'){
	$SelectedTrack_size = '60';
	} else if ($SelectedTrack == '2'){
		$SelectedTrack_size = '26';
		} else if ($SelectedTrack == '3'){		 
			$SelectedTrack_size = '30'; 
			} else if ($SelectedTrack == '4'){		 
				$SelectedTrack_size = '10'; 
				} else {		 
					$SelectedTrack_size = '20'; 
					} 

echo "<table id='Table_Competition'>
	<tr>
		<td></td>
		<td>Era</td>
		<td>Paiva</td>
		<td>Rata</td>
		<td>Ampumapaikka</td>
		<td>Nimi</td>
		<td>Seura</td>
		<td></td>
	</tr>";
			
for ($i = 1; $i <= $SelectedTrack_size; $i++) {			
	echo "
		<tr>
        		
  		<td>
  		
  			
  		</td>
  		<td>
  			
  			<input type='text' name='era' value='".$SelectedHeat."'>
  		</td>
  		<td>
  			<input type='text' name='paiva' value='".$SelectedDay."'>
  		</td>
  		<td>";
  		
  		echo "<select>";
  		echo "<option value='1'"; if ($SelectedTrack == '1'){echo "selected";} echo ">Aitovuori - 25 m</option>";
  		echo "<option value='2'"; if ($SelectedTrack == '2'){echo "selected";} echo ">Aitovuori - 50 m</option>";
  		echo "<option value='3'"; if ($SelectedTrack == '3'){echo "selected";} echo ">Peltokatu - Ilma</option>";
  		echo "<option value='4'"; if ($SelectedTrack == '4'){echo "selected";} echo ">Peltokatu - Ilma-olympia</option>";
  		echo "</select>";
  		
  		echo "</td>
  		<td>	
  			<input type='text' name='apaikka' value='".$i."'>
  		</td>
  		<td>
  			<input type='text' name='nimi' value=''>
  			
  		</td>
  		<td>
  			<input type='text' name='seura' value=''>
  			</td>
  			<td>
   			
   			
   		</td>
		</tr>";		
			
	}
			


	

?>