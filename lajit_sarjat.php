<?php 
	include 'init_mysql.php';
?>

<h2>Lajit, Sarjat ja Laukaukset</h2>
	
<table id="Table_Competitions">
	<tbody>
		<tr><td>Laji</td><td>Sarja</td><td>laukaukset</td><td>Kuvaus/Muuta</td></tr>	
	<?php
	
		$q = mysqli_query($cv,"SELECT * FROM ammunta.lajit_sarjat");
		if ($q->num_rows > 0) {
			while($row = $q->fetch_assoc()) {
				echo "
        	<tr>
        		<td>
        			<input type='hidden' name='id' value='".$row["id"]."'>
        			<input type='text' name='laji' value='".$row["laji"]."'>
        		</td>
        		<td>
        			<input type='text' name='sarja' value='".$row["sarja"]."'>
        		</td>
        		<td>
        			<input type='text' name='laukaukset' value='".$row["laukaukset"]."'>
        		</td>
        		<td>
        			<input type='text' name='kuvaus' value='".$row["kuvaus"]."'>
         			<button id='Button_Remove' class='Remove_Sports' value='".$row["id"]."'>Poista</button>
         		</td>
					</tr>";
     			}
				} else {
    			echo "0 results";
				}
				
			
			?>
		</tbody>
</table>

<button id="button_Add" class="lajit" value="Table_Competitions">Lis&auml;&auml; laji</button>
<button id="button_SaveTable" class="lajit_sarjat" value="">Tallenna</button>

