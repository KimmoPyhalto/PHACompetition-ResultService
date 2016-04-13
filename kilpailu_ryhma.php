<?php 
	$GroupNumber = $row["ryhma"];
	$GroupTableId = "Table_Competitions".$GroupNumber;
	echo "<table>";
	echo "<tr><td colspan='11'><h3>Ryhm&auml; ".$GroupTableId."</h3></td></tr>";
	?>
	
</table>

<?php 

	echo "<table id='".$GroupTableId."'>";
 	 				?>

	<tr>
		<td></td>
		<td class="special_property">Ry</td>
		<td>Er&auml;</td>
		<td class="special_property">P&auml;iv&auml;</td>
		<td class="special_property">Rata</td>
		<td>AP</td>
		<td>Etunimi</td>
		<td>Sukunimi</td> 
		
		<td>Laji/Sarja</td>
		
		
		<td>Seura</td>
		
		<td>Maks.</td>
		<td>Muuta</td>
		 
		
		<td></td>
	</tr>
	

<?php 

	
	$str_Md5 = "Ryhma".$row["ryhma"];
	$str_row = "Row".$row["ryhma"];
	$str_LajitSarjat = "LajitSarjat".$row["ryhma"];
	$str_rowLajitSarjat = "LajitSarjatRow".$row["ryhma"];
	
	${$str_Md5} = mysqli_query($cv,"SELECT * FROM ammunta.kilpailut_kilpailijat WHERE kilpailu_id = '$CompId' AND ryhma = '$GroupNumber' ORDER BY apaikka");
	$q_rows = mysqli_num_rows(${$str_Md5});
	$q_row = 0;
		
				
		if (${$str_Md5}->num_rows > 0) {
			while(${$str_row} = ${$str_Md5}->fetch_assoc()) {
				
				
				/*
				if ($row["ryhma"] != $current_ryhma) {
    			$GroupNumber = $GroupNumber + 1;
    			if ($GroupNumber != 1){
    				echo "</table>";
 	 					echo "<button id='button_Add' class='kilpailija'>Lis&auml;&auml; kilpailija</button>";
						echo "<button id='button_SaveTable' class='kilpailu' value='".$CompId."'>Tallenna</button>";
    				}
    			$GroupTableId = "Table_Competitions".$GroupNumber;
    			
 	 				}
				*/
				
				echo "
					<tr>
        		<td>
        		";
        		
        		$sarja = ${$str_row}["sarja"];
        		$laji = ${$str_row}["laji"];
        		
						switch ($laji){
    					
    					case "red": echo "Your favorite color is red!"; 
      				break;
    
							}
        		
        		echo "
        			
        		<button id='Button_List' value='".${$str_row}["id"]."' class='tulos'>Tulokset</button>
        		
        		<input type='hidden' name='id' value='".${$str_row}["id"]."'>  <!-- 0 -->
        		</td>
						<td class='special_property'>
							<input type='text' name='ryhma' value='".${$str_row}["ryhma"]."' class='input_ryhma'>  <!-- 1 -->
						</td>
        		<td>
        			
        			<input type='text' name='era' value='".${$str_row}["era"]."' class='input_era'>  <!-- 2 -->
        		</td>
        		<td>
        			<input type='text' name='paiva' value='".${$str_row}["paiva"]."' class='input_paiva'> <!-- 3 -->
        		</td>
        		<td class='special_property'>";
        		
        			echo "<select name='rataselect' class='input_rata'>"; //<!-- 13 -->
				  		echo "<option value='1'"; if (${$str_row}["rata"] == '1'){echo "selected";} echo ">Aitovuori - 25 m</option>";
				  		echo "<option value='5'"; if (${$str_row}["rata"] == '5'){echo "selected";} echo ">Aitovuori - 25 m Isopistooli</option>";
				  		echo "<option value='2'"; if (${$str_row}["rata"] == '2'){echo "selected";} echo ">Aitovuori - 50 m</option>";
				  		echo "<option value='3'"; if (${$str_row}["rata"] == '3'){echo "selected";} echo ">Peltokatu - Ilma</option>";
				  		echo "<option value='4'"; if (${$str_row}["rata"] == '4'){echo "selected";} echo ">Peltokatu - Ilma-olympia</option>";
				  		echo "</select>";
        			
        		echo "</td>
        		<td>	
        			<input type='text' name='apaikka' value='".${$str_row}["apaikka"]."' class='input_apaikka'> <!-- 4 -->
        		</td>
        		<td>
        			<input type='text' name='etunimi' value='".${$str_row}["etunimi"]."' class='input_etunimi'> <!-- 5 -->
        			
        		</td>
        		<td>
        			<input type='text' name='sukunimi' value='".${$str_row}["sukunimi"]."' class='input_sukunimi'> <!-- 6 -->
        		</td>
        		
        		<td>";
        		echo ${$str_row}["lajit_sarjat_id"];
        		
        		
        		
        		echo "<select name='lajisarjaselect' class='input_lajisarja'>"; //<!-- 14 -->
        		${$str_LajitSarjat} = mysqli_query($cv,"SELECT * FROM ammunta.lajit_sarjat ORDER BY laji, sarja");
		if (${$str_LajitSarjat}->num_rows > 0) {
			while(${$str_rowLajitSarjat} = ${$str_LajitSarjat}->fetch_assoc()) {
				echo "<option value='".${$str_rowLajitSarjat}["id"]."'"; if (${$str_row}["lajit_sarjat_id"] == ${$str_rowLajitSarjat}["id"]){echo "selected";} echo ">".${$str_rowLajitSarjat}["laji"]." ".${$str_rowLajitSarjat}["sarja"]."</option>";
				}
				} else {
    			echo "0 results";
				}
        		
        		echo "</select>";
        		
        		echo "
        			<input type='hidden' name='sarja' value='".${$str_row}["sarja"]."' class='input_sarja'> <!-- 7  - ei kayteta enaa mutta synkin takia taytyy olla -->
        			<input type='hidden' name='laji' value='".${$str_row}["laji"]."' class='input_laji'> <!-- 8 - ei kayteta enaa mutta synkin takia taytyy olla -->
        		</td>
        		
        		<td>
        			<input type='text' name='seura' value='".${$str_row}["seura"]."' class='input_seura'> <!-- 9 -->
        			<input type='hidden' name='CompId' value='".$CompId."'>  <!-- 10 -->
        		</td>
        		
        		<td>
        			<input type='checkbox' name='maksanut' value='".${$str_row}["maksanut"]."' class='input_maksanut'";
        			if (${$str_row}["maksanut"] == '1'){echo "checked";}
        			echo "> <!-- 11 -->
        		</td>
        		<td>
        			<input type='text' name='muuta' value='".${$str_row}["muuta"]."' class='input_muuta'> <!-- 12 -->
        		</td>
        		
        			<td>
         				<button id='Button_Remove' value='".${$str_row}["id"]."' class='Remove_Competitor'>Poista kilpailija</button>
         			
         		</td>
					</tr>";
     			    
     			    /* 			
     			if ($row["ryhma"] != $current_ryhma) {
    				$current_ryhma = $row["ryhma"];
 	 					}
     			if ($q_row == $q_rows){
     				echo "</table>";
     				echo "<button id='button_Add' class='kilpailija'>Lis&auml;&auml; kilpailija</button>";
						echo "<button id='button_SaveTable' class='kilpailu' value='".$CompId."'>Tallenna</button>";
     				}
    			*/
    		}
     			
     			
				} else {
    			echo "0 results".$CompId;
    		
				}
				
		
						echo "</table>";
     				echo "<button id='button_Add' class='kilpailija' value='".$GroupTableId."'>Lis&auml;&auml; kilpailija</button>";
						echo "<button id='button_SaveTable' class='kilpailu' value='".$CompId."'>Tallenna</button>";


?>

