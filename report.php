<?php
include("config/config.inc.php");
if(isset($_GET['id'])){
	if(DoExistStrainID($_GET['id'])==true){
		if(DoExistReport($_GET['id'])==false){
			DoAddReport($_GET['id']);
			echo "Reported";
		}else{
		echo "Already reported";
		}
	}else{
	echo "No exist reference";
	}
}
?>