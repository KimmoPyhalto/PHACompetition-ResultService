var jq = $.noConflict();
jq(document).ready(function(){
	jq(".Buttons_General").hide();
			
	//*** SAVE RESULT ***
	jq(document).on("keyup", ".ResultInput", function(){
		var CompetititorId = jq("#CompetitorId").val();
		var ResultNumber = this.value; 
		var ResultPosition = jq(this).attr('id');
		var ResultYpos = ResultPosition.substring(0, ResultPosition.indexOf('_'));
		var ResultXpos = ResultPosition.substring(ResultPosition.indexOf('_')+1);
		
		if (ResultNumber == 0 && ResultNumber != ''){
			jq(this).val('10');
			ResultNumber = 10;
			}
				
		jq(":input")[jq(":input").index(document.activeElement) + 1].focus();
  		
		jq.ajax({
			type: "POST",
			url: "processResultNumber.php",
			data: {"CompetititorId": CompetititorId, "ResultNumber": ResultNumber, "ResultYpos": ResultYpos, "ResultXpos": ResultXpos},
			success: function(msg){
				jq("#status").text(msg);
				},
				error: function(msg){
					jq("#status").text('errori');
					}
			});
		});


//*** LOAD TABLE ***
	jq(document).on("click", "#Button_List", function(){
			var ListItem = this.value; 
			var ListType = jq(this).attr('class');
			jq("#div_Competitions").load(ListType+".php?var1="+ListItem+"");
			jq(".Buttons_General").show();
			})
						
	
	//*** SAVE DATA - ARRAY ***
	var TableData;
	TableData = storeTblValues()
	TableData = jq.toJSON(TableData);
	function storeTblValues(TableId){
		
		var TableData = new Array();
		
		var TableId = TableId;
		var x = '#'+TableId+' tr';
		//alert (x);
		jq(x).each(function(row, tr){
				TableData[row]={
					"0" : jq(tr).find('input:eq(0)').val(),
					"1" : jq(tr).find('input:eq(1)').val(),
					"2" : jq(tr).find('input:eq(2)').val(),
					"3" : jq(tr).find('input:eq(3)').val(),
					"4" : jq(tr).find('input:eq(4)').val(),					
					"5" : jq(tr).find('input:eq(5)').val(),
					"6" : jq(tr).find('input:eq(6)').val(),
					"7" : jq(tr).find('input:eq(7)').val(),
					"8" : jq(tr).find('input:eq(8)').val(),
					"9" : jq(tr).find('input:eq(9)').val(),
					"10" : jq(tr).find('input:eq(10)').val(),
					"11" : jq(tr).find('input:eq(11)').is(':checked'), //checked .is(':checked'),
					"12" : jq(tr).find('input:eq(12)').val(),
					"13" : jq(tr).find('select:eq(0)').val(),
					"14" : jq(tr).find('select:eq(1)').val()
					}
				});
			TableData.shift();  // first row is the table header - so remove
			return TableData;
		}
	
	
		//*** SAVE DATA - DATABASE (USES ARRAY) ***
		jq(document).on('click', '#button_SaveTable', function(){
			var ListType = jq(this).attr('class'); //Type e.g. kilpailu
			var ListItem = this.value; //CompId
			var TableId = jq(this).prev().prev().attr('id');
			var TableData = jq.toJSON(storeTblValues(TableId)); //Whole data on table
			
			
			
			jq.ajax({
				type: "POST",
				url: "processJSONarray.php",
				data: {"pTableData": TableData, "SaveType": ListType, "ListItem": ListItem},
				success: function(msg){
					jq("#div_Competitions").load(ListType+".php?var1="+ListItem+"");
  				//jq("#status").text(msg);
  				jq("#status").text(msg).fadeIn();
  				jq("#status").text(msg).delay(1000).fadeOut();
  				
  				//jq("#"+TableId+"_statusdiv").text(msg);
  				//jq("#"+TableId+"_statusdiv").text(msg).delay(1000).fadeOut();
  				
  				},
					error: function(msg){
  					jq("#status").text('errori');
						}
				});/**/
			});
	
		
		//*** ADD ROW ***
		jq(document).on('click', '#button_Add', function(){
			var AddItem = jq(this).attr('class'); 
			var GroupTableId = this.value;
			
			var row = jq(this).prev().find('tr:last-child').clone();
			 row.find("input[name='id']").val('');
			 var apaikka = parseInt(row.find("input[name='apaikka']").val(),10);
			 var apaikka = apaikka + 1;
			 row.find("input[name='apaikka']").val(apaikka); 
			 row.find("input[name='etunimi']").val('');
			 row.find("input[name='sukunimi']").val('');
			 row.find("input[name='maksanut']").removeAttr('checked');
			 row.find("input[name='muuta']").val('');
			jq('#'+GroupTableId).append(row);
			
			//jq.get('templates/'+AddItem+'.html', function(data){ // Loads content into the 'data' variable.
			//jq('#'+GroupTableId).append(data); // Injects 'data' after the #Table_Competitions element.
			//});
		});
	
			
		//*** REMOVE ***	
		jq(document).on("click", "#Button_Remove", function(){
			var Id = this.value; 
			var RemoveType = jq(this).attr('class');
			jq.ajax({
				type: "POST",
				url: "RemoveCompetition.php",
				data: {"Id": Id, "RemoveType": RemoveType},
				//data: "pCompId=" + CompId,
				success: function(msg){
  				// return value stored in msg variable
  				//jq("#div_Competitions").load("kilpailut.php");
  				jq("#status").text(msg);
				},
				error: function(msg){
  				// return value stored in msg variable
  				jq("#status").text('errori');
				}
			});
		});
	
	
		//*** COMPETITION MAKE TRACK TEMPLATE ***
		jq(document).on('click', '.Button_MakeTrack', function(){
			var SelectedTrack = jq("#selected_track").val();
			var SelectedHeat = jq("#selected_heat").val();
			var SelectedDay = jq("#selected_day").val();
			//alert(SelectedTrack+SelectedHeat+SelectedDay);
			jq("#div_NewCompetition").load("kilpailu_rata.php?SelectedTrack="+SelectedTrack+"&SelectedHeat="+SelectedHeat+"&SelectedDay="+SelectedDay+"");
		})
	
		
		//*** Assisting functions ***			
		jq(document).on('click', '#hide', function(){
			jq(".input_ryhma,.input_paiva,.special_property").hide();
			});

		jq(document).on('click', '#show', function(){
			jq(".input_ryhma,.input_paiva,.special_property").show();
			});
						
	});
	