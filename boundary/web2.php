<?php

//require_once __DIR__."/../control/main.php";

/**
* 	Boundary for accessing API through web interface
*/

?>

<!DOCTYPE html>
<html>
<head>
	<title>Web interface for Haulmatic</title>
</head>
<body>

<div>
	<div>
		<button id="t1" name="t1">View All (GET)</button><br><br>
		<button id="t2" name="t2">View All (GET)</button>
	</div>
	<div id="dtable1">
		
	</div>
</div>

<hr/>
<div id="">
	Edit view
	<div>
		ID: <input type="text" name="" id="sid" value="" disabled="true"> <br>
		<input type="text" name="studID" id="studID" value="" hidden="true"> 
		Name: <input type="text" name="studName" value="" id="studName"> <br>
		Age: <input type="text" name="studAge" value="" id="studAge"> <br>

		<button id="saveData">Save</button>
		<button id="insertNew">Add</button>
	</div>
</div>


<script src="../lib/jquery-3.3.1.min.js">
</script>

<script>

var gvar1="k1";
switchSave(0);

$("#t2").click(function(){
	//alert(gvar1); // working
	 var var2="k1";
	$.ajax({ 
		url:"../control/main.php", 
		//{ "read": "ok", "get":"ok"},
		data: { "read": gvar1, "get":""},
		//data: { "read": var2, "get":""},
		//data: { "read": "k1", "get":""},
		success: function( data ) {
			console.log(data);
			$("#dtable1").empty();
			$("#dtable1").append("<tr><th>"+"Student ID"+"</th><th>"+"Student Name"+"</th><th>"+"Age"+"</th></tr>");
			for(i=0; i<data.data.length; i++){
				tmp=data.data[i];
				$("#dtable1").append("<tr><td>"+tmp.stid+"</td><td>"+tmp.stname+"</td><td>"+tmp.stage+"</td> <td><button id='edit' name='edit' onclick='editST("+tmp.stid+")'>Edit</button></td> <td><button id='delete' name='delete' onclick='delST("+tmp.stid+")'>Delete</button></td> </tr>");
			}
			$("#saveData").hide();
		}
	});
});


$("#t1").click(function(){
	$.post( "../control/main.php?read=1", 
		function( data ) {
			console.log(data);
		}
	);
});

$(document).ajaxError(function(xhr, status, error){
	console.log(error);
});

/** edit view formatting */
function editST(stuId){
	$.get( "../control/main.php", 
		{ "read": "ok", "get":"ok", "stID":stuId},
		function( data ) {
			console.log(data);
			//$("#dtable1").empty();
			//$("#dtable1").append("<tr><th>"+"Student ID"+"</th><th>"+"Student Name"+"</th><th>"+"Age"+"</th></tr>");
			for(i=0; i<data.data.length; i++){ //only one row
				tmp=data.data[i];
				$("#sid").val(tmp.stid);
				$("#studID").val(tmp.stid);
				$("#studName").val(tmp.stname);
				$("#studAge").val(tmp.stage);
			}
			//$("#saveData").show();
			switchSave(1);
		}
	);
}

function delST(stuId){
	$.post( "../control/main.php", 
		{ "del": "ok", "get":"ok", "stID":stuId},
		function( data ) {
			console.log(data);
			//$("#dtable1").empty();
			//$("#saveData").show();
			$("#t2").click();
		}
	);
	switchSave(0);
	$("#t2").click();
}


$("#saveData").click(function(){
	//sid=$("#sid").val();
	sID=$("#studID").val();
	sName=$("#studName").val();
	sAge=$("#studAge").val();
	//call save method in API
	$.post(
		"../control/main.php", 
		{ "saveEdit":1, "sID":sID, "sName":sName, "sAge":sAge  },
		function(data){
			console.log(data);
		}
	);
	switchSave(0);
	$("#t2").click();

});

//new
$("#insertNew").click(function(){
	//sid=$("#sid").val();
	//sID=$("#studID").val();
	sName=$("#studName").val();
	sAge=$("#studAge").val();
	//call save method in API
	$.post(
		"../control/main.php", 
		{ "saveNew":"ok", "sID":"999", "sName":sName, "sAge":sAge  },
		function(data){
			console.log(data);
		}
	);
	switchSave(0);
	$("#t2").click();

});

/** switch between saveedit & insertnew data */
/** save btn and its content */
function switchSave(val){
	if(val==0){ //add new
		$("#studID").val("");
		$("#sid").val("");
		$("#studName").val("");
		$("#studAge").val("");
		$("#saveData").hide();
		$("#insertNew").show();
	}
	else{
		/*$("#studID").val("");
		$("#sid").val("");
		$("#studName").val("");
		$("#studAge").val("");/**/
		$("#saveData").show();
		$("#insertNew").hide();
	}
}

</script>

</body>
</html>




