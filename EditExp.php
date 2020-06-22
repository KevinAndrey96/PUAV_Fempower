<?php
session_start();
if($_SESSION["Active"]!=true)
{
	?>
	<script type="text/javascript">
		window.location.href="index.php";
	</script>
	<?php
}
$USER=$_SESSION["UserName"];
require_once "lib/PDO.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<!-- Required meta tags -->
	<title>(F)EMPOWER</title>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Inteligencia para el trabajo">
	<meta name="author" content="(F)EMPOWER">
	<meta name="date" content="2020-05-26"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="robots" content="index, follow"/>
	<meta name="revisit-after" content="5 days"/>


	<link rel="shortcut icon" type="image/x-icon" href="assets/img/icono1.ico" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	<link rel="stylesheet" type="text/css" href="assets/css/general.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

</head>
<body>
	<div class="container"><div class="table row"> <div class="col-md-3">   <img class="logo" src="../images/logo_fempower.png"> </div> <div class="col-md-9 titulo">   <h1>Bienvenido    </h1>   <br>Pioneros en Colombia para quienes buscan crear oportunidades de trabajo decente y quienes desean emplearse en trabajos decentes.<br><h1></h1>  </div></div></div>


	<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <!--<a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
-->
<div class="collapse navbar-collapse" id="navbarSupportedContent">
	<ul class="navbar-nav mr-auto">
		<li class="nav-item active">
			<!--<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>-->
		</li>
		<li class="nav-item">
			<!--<a class="nav-link" href="#">Link</a>-->
		</li>
		<li class="nav-item dropdown">
        <!--<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
      </div>-->
  </li>
  <li class="nav-item">
  	<!--<a class="nav-link disabled" href="#">Disabled</a>-->
  </li>
</ul>
    <!--<form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  </form>-->
  <div class="form-inline my-2 my-lg-0">
  	<a class="nav-link" href="logout2.php">Cerrar Sesión</a>
  </div>

</div>
</nav>
<hr>
<a href="welcome.php" class="btn btn-info form-control" >Volver</a>
					<br>
					<br>
<?php
if($_SESSION["Rol"]==1)//Empresa
{
	?>
	<script type="text/javascript">
		window.location.href="welcome.php";
	</script>
	<?php
}elseif($_SESSION["Rol"]==3)//Persona
{
	$cont=0;
	$Q="SELECT * from usuarios where username='$USER'";
	foreach ($db->query($Q) as $Row) {
		$USERID=$Row["id"];
	}
	$Q="SELECT * from oferentes_bi where idUsuario =$USERID";
	foreach ($db->query($Q) as $Row) {
		$USERID=$Row["id"];
		$cont++;
	}
	
require "edit_experience.php";


}
?>
<script type="text/javascript">
	$(document).ready(function() {
		$('.selectpicker').select2();
	});
	function onoffcountry()
	{
		var x = document.getElementById("FOREIGNER").value;
		if(x=="2200")//SI
		{
			document.getElementById("COUNTRY").style="display:block";
			document.getElementById("COUNTRY2").style="display:block";
		}else
		{
			document.getElementById("COUNTRY").style="display:none";
			document.getElementById("COUNTRY2").style="display:none";
		}
	}
	function onoffdisability()
	{
		var x = document.getElementById("DISABILITY2").value;
    if(x=="2200")//SI
    {
    	document.getElementById("D1").style="display:inline";
    	document.getElementById("D11").style="display:inline";
    	document.getElementById("D2").style="display:inline";
    	document.getElementById("D22").style="display:inline";
    	document.getElementById("D3").style="display:inline";
    	document.getElementById("D33").style="display:inline";
    	document.getElementById("D4").style="display:inline";
    	document.getElementById("D44").style="display:inline";
    	document.getElementById("D5").style="display:inline";
    	document.getElementById("D55").style="display:inline";
    	document.getElementById("D6").style="display:inline";
    	document.getElementById("D66").style="display:inline";
    }else
    {
    	document.getElementById("D1").style="display:none";
    	document.getElementById("D11").style="display:none";
    	document.getElementById("D2").style="display:none";
    	document.getElementById("D22").style="display:none";
    	document.getElementById("D3").style="display:none";
    	document.getElementById("D33").style="display:none";
    	document.getElementById("D4").style="display:none";
    	document.getElementById("D44").style="display:none";
    	document.getElementById("D5").style="display:none";
    	document.getElementById("D55").style="display:none";
    	document.getElementById("D6").style="display:none";
    	document.getElementById("D66").style="display:none";
    }
}
function onoffmilitary()
{
	var x = document.getElementById("GENDER").value;
		if(x=="20")//MEN
		{
			document.getElementById("MILITARY").style="display:block";
			document.getElementById("MILITARY2").style="display:block";
		}else//WOMAN
		{
			document.getElementById("MILITARY").style="display:none";
			document.getElementById("MILITARY2").style="display:none";
		}
	}
</script>
<footer class="footer">
</footer>
</body>
