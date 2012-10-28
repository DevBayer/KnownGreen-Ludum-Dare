<?php
include("config/config.inc.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <title>KnownGreen - Discover footprints on the map</title>
    <!-- Bootstrap -->
	<link href="css/knowngreen.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/jquery-jvectormap-1.1.1.css" rel="stylesheet">
  </head>
  <body>
	<div class="navbar navbar-static-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand logo" href="home">KnownGreen</a>
          <div class="nav-collapse collapse" style="float:right;">
            <ul class="nav">
			<?php
			if(empty($_GET['pag']) OR $_GET['pag']=='home'){
			?>
              <li class="active"><a href="#">Home</a></li>
			<?php
			}else{
			?>
			<li><a href="home">Home</a></li>
			<?php
			}
			if(isset($_GET['pag']) && $_GET['pag']=='strains'){
			?>
            <li class="active"><a href="strains">Strains</a></li>
			<?php
			}else{
			?>
			 <li><a href="strains">Strains</a></li>
			<?php
			}
			if(isset($_GET['pag']) && $_GET['pag']=='about'){
			?>
            <li class="active"><a href="about">About</a></li>
			<?php
			}else{
			?>
			 <li><a href="about">About</a></li>
			<?php
			}
			?>
            </ul>
          </div><!--/.nav-collapse -->	  
        </div>
      </div>
    </div>
	
	
	<div class="container">
	<?php
	if(isset($_POST) && isset($_GET['form']) && $_GET['form']=="colabore" && $colabore==true){
		//var_dump($_POST);
		if($_POST['name'] && $_POST['desc']){
		if(DoExistStrain($_POST['name']) == false){
		$_POST['desc'] = substr($_POST['desc'],0,200)."...";
			$insert = array(
				"Name" => strip_tags($_POST['name']),
				"Description" => strip_tags($_POST['desc'])
			);
		$db->insert("strain", $insert);
			echo "<div class=\"alert alert-success\">
			<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
			<strong>Thanks</strong> For your help.
			</div>";
		}else{
			echo "<div class=\"alert alert-info\">
			<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
			<strong>Ups</strong> Already exists information
			</div>";
		}
		}else{
			echo "<div class=\"alert\">
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
  <strong>Error</strong> Not all fields have been filled.
</div>";
		}
	}else if(isset($_POST) && isset($_GET['form']) && $_GET['form']=="footprint"){
	if(isset($_POST['country']) && isset($_POST['strain']) && isset($_POST['rank'])){
		if(isset($_SESSION['footprint']) || isset($_COOKIE['ads'])){
		if(isset($_SESSION['footprint'])){
        $ahora=time();
        $segundos=$ahora-$_SESSION['footprint'];
        $dias=floor($segundos/86400);  
        $mod_hora=$segundos%86400;
        $horas=floor($mod_hora/3600);
		
		
        if($horas >= 24) {
        unset($_SESSION['footprint']);
        }else{
		echo "<div class=\"alert alert-warning\">
			<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
			<strong>Wait</strong> You must wait 24 hours to re-footprint on the map.
			</div>";
		}
		}else if(isset($_COOKIE['ads'])){
			if(isset($_COOKIE['last'])){
			$_SESSION['footprint'] = $_COOKIE['last'];
			}
		echo "<div class=\"alert alert-warning\">
			<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
			<strong>Wait</strong> You must wait 24 hours to re-footprint on the map.
			</div>";
		}
		
		}else{
			if(DoExistCountryISO($_POST['country']) == true && DoExistStrainID($_POST['strain']) == true && $_POST['rank'] >= 1 && $_POST['rank'] <= 10){
			$insert = array(
				"Country" => DoChangetoNameISO($_POST['country']),
				"Type" => $_POST['strain'],
				"Calification" => $_POST['rank'],
				"Date" => date("Y-m-d H:i:s"),
				"IP" => $_SERVER['REMOTE_ADDR']);
			if(FootPrintbyUserExist(DoChangetoNameISO($_POST['country']), $_SERVER['REMOTE_ADDR'], $_POST['rank'], $_POST['strain'])==true){
			echo "<div class=\"alert alert-info\">
			<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
			<strong>Updated</strong> We updated your existing footprint in the country.
			</div>";
			}else{
			$db->insert("reg", $insert);
			echo "<div class=\"alert alert-success\">
			<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
			<strong>Thanks</strong> For your help.
			</div>";
			}
			$_SESSION['footprint']=time();
			setcookie("ads",md5(date("Y-m-d H:i:s")), time()+3600*24);
			setcookie("last",date("Y-m-d H:i:s"), time()+3600*24);
			
			DoReguleColours(DoChangetoNameISO($_POST['country']));
			
			}else{
			echo "<div class=\"alert alert-warning\">
			<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
			<strong>Error</strong> Data altered.
			</div>";
			}
		unset($_POST);
		}
	}else{
		echo "<div class=\"alert\">
   <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
   <strong>Error</strong> Not all fields have been filled.
   </div>";
	}
	}
	if(empty($_GET['pag']) OR $_GET['pag']=='home'){
	?>
<div id="mark-index" class="container">
      <div class="row">
        <div class="span12" style="text-align: center">
          <h1>You footprint on the map</h1>
          <h2 class="lead">Totally anonymous</h2>
		  <div class="buttons">
		  <a style="width:150px; display:inline-block; " data-toggle="modal" class="btn btn-large btn-inverse" data-target="#Footprint">Footprint</a>
		  <?php if($colabore==true){ ?>
		  <span>&nbsp;or&nbsp;</span>
		  <a style="width:100px; display:inline-block; " data-toggle="modal" class="btn btn-mini btn-success" data-target="#Colabore">Colabore</a>
		  <?php
		  }
		  ?>
		  </div>
		  
        </div>
      </div>
    </div>
	
	<div id="map-status" class="container">
	<div id="world-map-gdp" style="width: 738px; height: 554px"></div>
	<div id="status-info">
	<ul class="nav nav-list">
	<li class="nav-header">Last Added</li>
	<?php echo LastAdd(); ?>
	</ul>
	</div>
	</div>
	<?php
	}elseif($_GET['pag']=='strains'){
	?>
<div id="mark-about" class="container">
      <div class="row">
        <div class="span12">
          <h1 style="font-size:48px;">Strains...</h1>
		  <hr>
		  <div class="span12">
		  		  	  <div style="width:450px; float:left; margin:20px;"><a href="#" class="thumbnail">
              <img src="http://www.growshoponlineterradecultiu.com/img/canna_cultivo2_logo.jpg" alt="">
              </a>
			  </div>
		  <h2 class="lead">Cannabis strains are either pure breeds or hybrid varieties of Cannabis, typically of the species C. indica or C. sativa. Varieties are developed to highlight a specific combination of properties of the plant or to establish marketing differentiation. Variety names are typically chosen by their growers, and often reflect properties of the plant, such as taste, color, smell, or the origin of the variety.</h2>
		  <?php
		 	$results = $db->select("strain");
	echo "<ul class=\"thumbnails\">";
	$num=0;
	foreach($results as $item){
	$num++;
	$info = DoReturnInfoStrain($item['ID']);
	if (!isset($info[0])) {
    $info[0]["type"]="0";
	$info[0]["TotalTipos"]="0";
	$info[0]["Promedio"]="0";
	}
	echo "<li class=\"span3\" style=\"padding:5px; width:290px; float:left;\"><h3 style=\"font-size:16px; margin:0; padding:0; float:left;\">".strip_tags($item['Name'])."</h3><span style=\"float:right; margin-top: 10px; font-size:10px;\"><a class=\"report-strain\" href=\"report_".$item['ID']."\"><i class=\"icon icon-eye-open\"></i> Report abuse</a></span><div class=\"clearfix\"></div><hr style=\"margin:0; padding:0;\"><p style=\"text-align:justify;\">".strip_tags($item['Description'])."</p>
	<b>Statistics over the world</b><br>
	<i class=\"icon-user\"></i> ".$info[0]['TotalTipos']."<br>
	<i class=\"icon-star\"></i> ".$info[0]['Promedio']."
	</li>";
	if($num == 3){
	$num = 0;
	echo "</ul><ul class=\"thumbnails\">";
	}
	}
	echo "</ul>";
	?>
        </div>
		</div>
      </div>
	  
	  <hr>
    </div>
	<?php
	}elseif($_GET['pag']=='about'){
	?>
<div id="mark-about" class="container">
      <div class="row">
        <div class="span12">
          <h1 style="font-size:48px;">About...</h1>
		  <hr>
		  <div class="span12" style="width:550px;">
		  <h2 class="lead">KnownGreen "<a href="">Website Dare II: Rise of The Evil Code</a>" is a 72-hour competition, under the "Marijuana" category, i decided to make a map of the world where people who smoked ganja could see strains are chosen and how rankings all over the world.</h2>
		  <h2 class="lead">The technology used is: <b><a href="http://twitter.github.com/bootstrap">Bootstrap</a></b> (FrontEnd), <b><a href="http://jvectormap.com/">jVectorMap</a></b> (FrontEnd), <b><a href="http://jquery.com/">jQuery</a></b> (FrontEnd), <b><a href="http://www.myqsl.com/">mySQL</a></b> (SQL)</h2>
		  <h2 class="lead">Contact at the creator: <b><a href="http://www.mediavida.com/id/Mujiwara">Mujiwara</a></b> <b><a href="https://twitter.com/levelside">@levelSide</a></b></h2>
        </div>
			<div style="width:300px; float:right; margin:5px;"><a href="#" class="thumbnail">
             <img src="http://i.imgur.com/Hmdi7.png" alt="">
              </a>
			  </div>
			  <div style="width:300px; float:right; margin:5px;"><a href="#" class="thumbnail">
              <img src="http://blog.danikgames.com/wp-content/uploads/2011/02/LD48_1_7-1024x538.png" alt="">
              </a>
			  </div>
		</div>
      </div>
	  
	  <hr>
    </div>
<?php
}
?>	
	</div>
	
<footer class="footer-content">
<hr>
	<div class="container">
		<div class="layer-text">
        <p>KnownGreen © <a href="http://www.mediavida.com/id/Mujiwara">Mujiwara</a> | <a href="http://www.mediavida.com/foro/9/website-dare-ii-rise-of-the-evil-code-461879">Website Dare II: Rise of The Evil Code</a></p>
		</div>
		<ul class="breadcrumb">
		<li class="active">Developed with</li>
		<li><a href="http://twitter.github.com/bootstrap">Bootstrap</a> <span class="divider">/</span></li>
		<li><a href="http://www.php.net/">PHP5</a> <span class="divider">/</span></li>
		<li><a href="http://www.mysql.com/">mySQL</a> <span class="divider">/</span></li>
		<li><a href="http://jvectormap.com/">jVectorMap</a> <span class="divider">/</span></li>
		<li><a href="http://jquery.com/">jQuery</a></li>
		</ul>
	</div>
      </footer>	
	
<div class="modal hide fade" id="Footprint">
<form style="margin:0;" action="footprint" method="post">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Footprint</h3>
  </div>
  <div class="modal-body">
<div class="input-prepend"><span style="width:120px;" class="add-on">Country</span>
<select class="span4" name="country">
<?php
echo DoReturnCountry();
?>
</select>
</div>

<div class="input-prepend"><span style="width:120px;" class="add-on">Favorite strain</span>
<select class="span4" name="strain">
<?php
echo DoReturnStrain();
?>
</select>
</div>

<div class="input-prepend"><span style="width:120px;" class="add-on">Calification strain</span>
<select class="span4" name="rank">
  <option value="10">10 ( Better )</option>
  <option value="9">9</option>
  <option value="8">8</option>
  <option value="7">7</option>
  <option value="6">6</option>
  <option value="5">5</option>
  <option value="4">4</option>
  <option value="3">3</option>
  <option value="2">2</option>
  <option value="1">1 ( Worst )</option>
</select>
</div>

  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-primary" type="submit">Send</button>
  </div>
</form>
</div>

<div class="modal hide fade" id="Colabore">
<form style="margin:0;" action="colabore" method="post">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Colabore</h3>
	<span>Adding news strains</span>
  </div>
  <div class="modal-body">
<div class="input-prepend"><span style="width:120px;" class="add-on">Name</span>
<input class="input-xlarge" type="text" name="name" placeholder="White Widow" />
</div>

<div class="input-prepend"><span style="width:120px;" class="add-on">Description</span>
<textarea rows="5" class="span5"  name="desc" placeholder="White Widow: a name, a legend. This plant has appeared on the market in 1995 and it has been the dominator of the scene ever since. White Widow is a cross between Indian and Brazilian, medium height, excellent taste with notes of fruit."></textarea>
</div>

  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-primary" type="submit">Send</button>
  </div>
</form>
</div>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="js/jquery-jvectormap-1.1.1.min.js"></script>
	<script src="http://jvectormap.com/js/jquery-jvectormap-world-mill-en.js"></script>
	<script src="http://jvectormap.com/js/gdp-data.js"></script>
	<script src="js/KnownGreen.js"></script>
	
	
  </body>

</html>