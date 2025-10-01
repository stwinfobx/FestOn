<?php $time = time(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<base href="<?php echo(base_url()); ?>/" />
	<title>JA FestOn : FrontEnd</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta charset="utf-8" />

	<meta property="og:locale" content="en_US" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="" />
	<meta property="og:url" content="" />
	<meta property="og:site_name" content="" />

	<link rel="canonical" href="<?php echo(current_url()); ?>" />
	<link rel="shortcut icon" href="assets/media/favicon.png" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

	<!-- <link href="assets/bootstrap/css/bootstrap.css" rel="stylesheet"> -->
	<!-- <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script> -->

	<!-- jquery e bootstrap -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>


	<!-- FONT-AWESOME -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<link href="assets/line-awesome/css/line-awesome.min.css" rel="stylesheet" type="text/css" />

	<link rel="stylesheet" type="text/css" media="all" href="assets/css/stellarnav.css">
	<link defer type="text/css" rel="stylesheet" href="assets/css/style-menu.css">

	<!-- <link href="assets/css/reset.css" rel="stylesheet" type="text/css" /> -->
	<link href="assets/css/style-frontend.css" rel="stylesheet" type="text/css" />

	<!-- choose one -->
	<!-- <script src="https://unpkg.com/feather-icons"></script> -->
	<!-- <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script> -->

	<?php //$this->renderSection('headers'); ?>
</head>
<body onload="onLoaderFunc()">


<div style="padding-top: 25px;">

	<div class="inputForm">
		<center>
			Nome *: <input type="text" id="Username" required>
			Número de Assentos *: <input type="number" id="Numseats" required>
			<br/><br/>
			<button onclick="takeData()">Iniciar Seleção</button>
		</center>
	</div>
	  


	<div class="seatStructure">
		<center>
			<p id="notification"></p>
			<table id="seatsBlock">
				<tr>
					<td colspan="14">
						<div class="screen">FRONT</div>
					</td>
					<td rowspan="20">
						<div class="smallBox greenBox">Assentos Selecionados</div> <br/>
						<div class="smallBox redBox">Assentos Reservados</div><br/>
						<div class="smallBox emptyBox">Assentos Livres</div><br/>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>1</td>
					<td>2</td>
					<td>3</td>
					<td>4</td>
					<td>5</td>
					<td></td>
					<td>6</td>
					<td>7</td>
					<td>8</td>
					<td>9</td>
					<td>10</td>
					<td>11</td>
					<td>12</td>
				</tr>
				<tr>
					<td>A</td>
					<td><input type="checkbox" class="seats" value="A1"></td>
					<td><input type="checkbox" class="seats" value="A2"></td>
					<td><input type="checkbox" class="seats" value="A3"></td>
					<td><input type="checkbox" class="seats" value="A4"></td>
					<td><input type="checkbox" class="seats" value="A5"></td>
					<td class="seatGap"></td>
					<td><input type="checkbox" class="seats" value="A6"></td>
					<td><input type="checkbox" class="seats" value="A7"></td>
					<td><input type="checkbox" class="seats" value="A8"></td>
					<td><input type="checkbox" class="seats" value="A9"></td>
					<td><input type="checkbox" class="seats" value="A10"></td>
					<td><input type="checkbox" class="seats" value="A11"></td>
					<td><input type="checkbox" class="seats" value="A12"></td>
				</tr>
				<tr>
					<td>B</td>
					<td><input type="checkbox" class="seats" value="B1"></td>
					<td><input type="checkbox" class="seats" value="B2"></td>
					<td><input type="checkbox" class="seats" value="B3"></td>
					<td><input type="checkbox" class="seats" value="B4"></td>
					<td><input type="checkbox" class="seats" value="B5"></td>
					<td></td>
					<td><input type="checkbox" class="seats" value="B6"></td>
					<td><input type="checkbox" class="seats" value="B7"></td>
					<td><input type="checkbox" class="seats" value="B8"></td>
					<td><input type="checkbox" class="seats" value="B9"></td>
					<td><input type="checkbox" class="seats" value="B10"></td>
					<td><input type="checkbox" class="seats" value="B11"></td>
					<td><input type="checkbox" class="seats" value="B12"></td>
				</tr>
				<tr>
					<td>C</td>
					<td><input type="checkbox" class="seats" value="C1"></td>
					<td><input type="checkbox" class="seats" value="C2"></td>
					<td><input type="checkbox" class="seats" value="C3"></td>
					<td><input type="checkbox" class="seats" value="C4"></td>
					<td><input type="checkbox" class="seats" value="C5"></td>
					<td></td>
					<td><input type="checkbox" class="seats" value="C6"></td>
					<td><input type="checkbox" class="seats" value="C7"></td>
					<td><input type="checkbox" class="seats" value="C8"></td>
					<td><input type="checkbox" class="seats" value="C9"></td>
					<td><input type="checkbox" class="seats" value="C10"></td>
					<td><input type="checkbox" class="seats" value="C11"></td>
					<td><input type="checkbox" class="seats" value="C12"></td>
				</tr>
				<tr>
					<td>D</td>
					<td><input type="checkbox" class="seats" value="D1"></td>
					<td><input type="checkbox" class="seats" value="D2"></td>
					<td><input type="checkbox" class="seats" value="D3"></td>
					<td><input type="checkbox" class="seats" value="D4"></td>
					<td><input type="checkbox" class="seats" value="D5"></td>
					<td></td>
					<td><input type="checkbox" class="seats" value="D6"></td>
					<td><input type="checkbox" class="seats" value="D7"></td>
					<td><input type="checkbox" class="seats" value="D8"></td>
					<td><input type="checkbox" class="seats" value="D9"></td>
					<td><input type="checkbox" class="seats" value="D10"></td>
					<td><input type="checkbox" class="seats" value="D11"></td>
					<td><input type="checkbox" class="seats" value="D12"></td>
				</tr>
				<tr>
					<td>E</td>
					<td><input type="checkbox" class="seats" value="E1"></td>
					<td><input type="checkbox" class="seats" value="E2"></td>
					<td><input type="checkbox" class="seats" value="E3"></td>
					<td><input type="checkbox" class="seats" value="E4"></td>
					<td><input type="checkbox" class="seats" value="E5"></td>
					<td></td>
					<td><input type="checkbox" class="seats" value="E6"></td>
					<td><input type="checkbox" class="seats" value="E7"></td>
					<td><input type="checkbox" class="seats" value="E8"></td>
					<td><input type="checkbox" class="seats" value="E9"></td>
					<td><input type="checkbox" class="seats" value="E10"></td>
					<td><input type="checkbox" class="seats" value="E11"></td>
					<td><input type="checkbox" class="seats" value="E12"></td>
				</tr>
				<tr class="seatVGap"></tr>
				<tr>
					<td>F</td>
					<td><input type="checkbox" class="seats" value="F1"></td>
					<td><input type="checkbox" class="seats" value="F2"></td>
					<td><input type="checkbox" class="seats" value="F3"></td>
					<td><input type="checkbox" class="seats" value="F4"></td>
					<td><input type="checkbox" class="seats" value="F5"></td>
					<td></td>
					<td><input type="checkbox" class="seats" value="F6"></td>
					<td><input type="checkbox" class="seats" value="F7"></td>
					<td><input type="checkbox" class="seats" value="F8"></td>
					<td><input type="checkbox" class="seats" value="F9"></td>
					<td><input type="checkbox" class="seats" value="F10"></td>
					<td><input type="checkbox" class="seats" value="F11"></td>
					<td><input type="checkbox" class="seats" value="F12"></td>
				</tr>
				<tr>
					<td>G</td>
					<td><input type="checkbox" class="seats" value="G1"></td>
					<td><input type="checkbox" class="seats" value="G2"></td>
					<td><input type="checkbox" class="seats" value="G3"></td>
					<td><input type="checkbox" class="seats" value="G4"></td>
					<td><input type="checkbox" class="seats" value="G5"></td>
					<td></td>
					<td><input type="checkbox" class="seats" value="G6"></td>
					<td><input type="checkbox" class="seats" value="G7"></td>
					<td><input type="checkbox" class="seats" value="G8"></td>
					<td><input type="checkbox" class="seats" value="G9"></td>
					<td><input type="checkbox" class="seats" value="G10"></td>
					<td><input type="checkbox" class="seats" value="G11"></td>
					<td><input type="checkbox" class="seats" value="G12"></td>
				</tr>
				<tr>
					<td>H</td>
					<td><input type="checkbox" class="seats" value="H1"></td>
					<td><input type="checkbox" class="seats" value="H2"></td>
					<td><input type="checkbox" class="seats" value="H3"></td>
					<td><input type="checkbox" class="seats" value="H4"></td>
					<td><input type="checkbox" class="seats" value="H5"></td>
					<td></td>
					<td><input type="checkbox" class="seats" value="H6"></td>
					<td><input type="checkbox" class="seats" value="H7"></td>
					<td><input type="checkbox" class="seats" value="H8"></td>
					<td><input type="checkbox" class="seats" value="H9"></td>
					<td><input type="checkbox" class="seats" value="H10"></td>
					<td><input type="checkbox" class="seats" value="H11"></td>
					<td><input type="checkbox" class="seats" value="H12"></td>
				</tr>
				<tr>
					<td>I</td>
					<td><input type="checkbox" class="seats" value="I1"></td>
					<td><input type="checkbox" class="seats" value="I2"></td>
					<td><input type="checkbox" class="seats" value="I3"></td>
					<td><input type="checkbox" class="seats" value="I4"></td>
					<td><input type="checkbox" class="seats" value="I5"></td>
					<td></td>
					<td><input type="checkbox" class="seats" value="I6"></td>
					<td><input type="checkbox" class="seats" value="I7"></td>
					<td><input type="checkbox" class="seats" value="I8"></td>
					<td><input type="checkbox" class="seats" value="I9"></td>
					<td><input type="checkbox" class="seats" value="I10"></td>
					<td><input type="checkbox" class="seats" value="I11"></td>
					<td><input type="checkbox" class="seats" value="I12"></td>
				</tr>
				<tr>
					<td>J</td>
					<td><input type="checkbox" class="seats" value="J1"></td>
					<td><input type="checkbox" class="seats" value="J2"></td>
					<td><input type="checkbox" class="seats" value="J3"></td>
					<td><input type="checkbox" class="seats" value="J4"></td>
					<td><input type="checkbox" class="seats" value="J5"></td>
					<td></td>
					<td><input type="checkbox" class="seats" value="J6"></td>
					<td><input type="checkbox" class="seats" value="J7"></td>
					<td><input type="checkbox" class="seats" value="J8"></td>
					<td><input type="checkbox" class="seats" value="J9"></td>
					<td><input type="checkbox" class="seats" value="J10"></td>
					<td><input type="checkbox" class="seats" value="J11"></td>
					<td><input type="checkbox" class="seats" value="J12"></td>
				</tr>

				<tr>
					<td>M</td>
					<td></td>
					<td><input type="checkbox" class="seats" value="M1"></td>
					<td><input type="checkbox" class="seats" value="M2"></td>
					<td><input type="checkbox" class="seats" value="M3"></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</table>
		  
			<br/><button onclick="updateTextArea()">Confirm Selection</button>
		</center>
	</div>



		  
	<br/><br/>

	<div class="displayerBoxes">
		<center>
			<table class="Displaytable">
				<tr>
					<th>Name</th>
					<th>Number of Seats</th>
					<th>Seats</th>
				</tr>
				<tr>
					<td><textarea id="nameDisplay"></textarea></td>
					<td><textarea id="NumberDisplay"></textarea></td>
					<td><textarea id="seatsDisplay"></textarea></td>
				</tr>
			</table>
		</center>
	</div>

</div>




<style>
body
{
  font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
}

#Username
{
  border:none;
  border-bottom:1px solid;
}

.screen
{
  width:100%;
  height:20px;
  background:#4388cc;
  color:#fff;
  line-height:20px;
  font-size:15px;
}

.smallBox::before
{
  content:".";
  width:15px;
  height:15px;
  float:left;
  margin-right:10px;
}
.greenBox::before
{
  content:"";
  background:Green;
}
.redBox::before
{
  content:"";
  background:Red;
}
.emptyBox::before
{
  content="";
  box-shadow: inset 0px 2px 3px 0px rgba(0, 0, 0, .3), 0px 1px 0px 0px rgba(255, 255, 255, .8);
    background-color:#ccc;
}

.seats
{
  border:1px solid red;background:yellow;
} 



.seatGap
{
  width:40px;
}

.seatVGap
{
  height:40px;
}

table
{
  text-align:center;
}


.Displaytable
{
  text-align:center;
}
.Displaytable td, .Displaytable th {
    border: 1px solid;
    text-align: left;
}

textarea
{
  border:none;
  background:transparent;
}



input[type=checkbox] {
    width:0px;
    margin-right:18px;
}

input[type=checkbox]:before {
    content: "";
    width: 15px;
    height: 15px;
    display: inline-block;
    vertical-align:middle;
    text-align: center;
    box-shadow: inset 0px 2px 3px 0px rgba(0, 0, 0, .3), 0px 1px 0px 0px rgba(255, 255, 255, .8);
    background-color:#ccc;
}

input[type=checkbox]:checked:before {
    background-color:Green;
    font-size: 15px;
}
</style>



<script>
function onLoaderFunc(){
	$(".seatStructure *").prop("disabled", true);
	$(".displayerBoxes *").prop("disabled", true);
}

function takeData(){
	if( ( $("#Username").val().length == 0 ) || ( $("#Numseats").val().length == 0 ) ){
		alert("Please Enter your Name and Number of Seats");
	} else {
		$(".inputForm *").prop("disabled", true);
		$(".seatStructure *").prop("disabled", false);
		document.getElementById("notification").innerHTML = "<b style='margin-bottom:0px;background:yellow;'>Please Select your Seats NOW!</b>";
	}
}

function updateTextArea() { 
    
  if ($("input:checked").length == ($("#Numseats").val()))
    {
      $(".seatStructure *").prop("disabled", true);
      
     var allNameVals = [];
     var allNumberVals = [];
     var allSeatsVals = [];
  
     //Storing in Array
     allNameVals.push($("#Username").val());
     allNumberVals.push($("#Numseats").val());
     $('#seatsBlock :checked').each(function() {
       allSeatsVals.push($(this).val());
     });
    
     //Displaying 
     $('#nameDisplay').val(allNameVals);
     $('#NumberDisplay').val(allNumberVals);
     $('#seatsDisplay').val(allSeatsVals);
    }
  else
    {
      alert("Please select " + ($("#Numseats").val()) + " seats")
    }
  }


function myFunction() {
  alert($("input:checked").length);
}

/*
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
*/


$(":checkbox").click(function() {
  if ($("input:checked").length == ($("#Numseats").val())) {
    $(":checkbox").prop('disabled', true);
    $(':checked').prop('disabled', false);
  }
  else
    {
      $(":checkbox").prop('disabled', false);
    }
});
</script>




quant. de colunas









A -->  formatar coluna { X X X X X _ X X X X X } 
B --> formatar coluna { X X X X X _ _________ _ X X X X X }
C --> formatar coluna { X X X X X _ X X X X X _ X X X X X }
D --> formatar coluna { X X X X X _ X X X X X _ X X X X X }





A1, A2, A3 





</body>
</html>