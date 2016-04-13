<?php 
	include 'init_mysql.php';
?>

<h2>Sarjat, Lajit ja Laukaukset</h2>
	
<table id="Table_Competitions">
	<tbody>
		<tr><td>Kilpailu</td><td>Aika</td><td>Paikka</td></tr>	
	<?php
	
		$q = mysqli_query($cv,"SELECT * FROM ammunta.kilpailut");
		if ($q->num_rows > 0) {
			while($row = $q->fetch_assoc()) {
				echo "
        	<tr>
        		
        		<td>
        		<button id='Button_List' value='".$row["id"]."' class='kilpailu'>Kilpailuun</button>
        			<input type='hidden' name='id' value='".$row["id"]."'>
        			<input type='text' name='nimi' value='".$row["nimi"]."'>
        		</td>
        		<td>
        			<input type='text' name='aloituspaiva' value='".$row["aloituspaiva"]."'>
        			<input type='text' name='lopetuspaiva' value='".$row["lopetuspaiva"]."'>
        		</td>
        		<td>
        			<input type='text' name='paikka' value='".$row["paikka"]."'>
         				<button id='Button_Remove' class='Remove_Competition' value='".$row["id"]."'>Poista kilpailu</button>
         			
         		</td>
					</tr>";
     			}
				} else {
    			echo "0 results";
				}
				
			
			?>
		</tbody>
</table>

<button id="button_Add" class="kilpailu" value="Table_Competitions">Lis&auml;&auml; kilpailu</button>
<button id="button_SaveTable" class="kilpailut" value="">Tallenna</button>

