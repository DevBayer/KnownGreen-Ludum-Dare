<?php
session_start();
$colabore=false;
require_once('class.db.php');
$db = new db("mysql:host=127.0.0.1;port=3306;dbname=knowngreen", "root", "");
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_CLASS | PDO::FETCH_CLASSTYPE);
function DoReturnCountry() {
$return = "";
	global $db;
	$results = $db->select("country");
foreach($results as $item){
    $return .= "<option value=".$item['iso'].">".$item['name']."</option>";
}
return $return;
}

function DoReturnStrain() {
$return = "";
	global $db;
	$results = $db->select("strain");
foreach($results as $item){
    $return .= "<option value=".$item['ID'].">".$item['Name']."</option>";
}
return $return;
}

function DoReturnInfoStrain($s){
global $db;
$results = $db->select("reg", "Type = '$s'", "", "reg.type,count(*) as TotalTipos, ROUND(AVG(reg.Calification),0) as Promedio", "reg.type");
return $results;
}

function DoMapInfo(){
global $db;
$Array=array();
$Array2['result']=array();
$results = $db->select("country");
foreach($results as $item){
	$cache = $item['name'];
	$Array2['result'][$item['iso']] = $item['LVL'];
	$results2 = $db->select("reg", "Country = '".$item['name']."'");
	if(empty($results2)){
	$Array[$cache]=array("People" => 0, "1" => Array("","",""), "2" => Array("","",""), "3" => Array("","",""), "4" => Array("","",""), "5" => Array("","","") );
	}else{
	foreach($results2 as $item2){
	$rank=DoReturnTypeRepeats($cache);

	if (!isset($rank[0])) {
    $rank[0]["type"]="";
	$rank[0]["TotalTipos"]="";
	$rank[0]["Promedio"]="";
	}else{
	$rank[0]["type"] = DoChangetoName($rank[0]["type"]);
	}
	if (!isset($rank[1])) {
    $rank[1]["type"]="";
	$rank[1]["TotalTipos"]="";
	$rank[1]["Promedio"]="";
	}else{
	$rank[1]["type"] = DoChangetoName($rank[1]["type"]);
	}
	if (!isset($rank[2])) {
    $rank[2]["type"]="";
	$rank[2]["TotalTipos"]="";
	$rank[2]["Promedio"]="";
	}else{
	$rank[2]["type"] = DoChangetoName($rank[2]["type"]);
	}
	if (!isset($rank[3])) {
    $rank[3]["type"]="";
	$rank[3]["TotalTipos"]="";
	$rank[3]["Promedio"]="";
	}else{
	$rank[3]["type"] = DoChangetoName($rank[3]["type"]);
	}
	if (!isset($rank[4])) {
    $rank[4]["type"]="";
	$rank[4]["TotalTipos"]="";
	$rank[4]["Promedio"]="";
	}else{
	$rank[4]["type"] = DoChangetoName($rank[4]["type"]);
	}
	$Array[$cache]=array("People" => count($results2), "1" => array_values($rank[0]), "2" => array_values($rank[1]), "3" => array_values($rank[2]), "4" => array_values($rank[3]), "5" => array_values($rank[4]) );
	}
}
}

return json_encode(array_merge($Array,$Array2));
}

function DoReturnTypeRepeats($country){
global $db;
$results = $db->select("reg", "reg.Country = '$country'", "", "reg.type,count(*) as TotalTipos, ROUND(AVG(reg.Calification),0) as Promedio", "reg.type", "Promedio DESC, TotalTipos DESC");
return $results;
}

function DoChangetoName($ref){
global $db;
$results = $db->select("strain", "ID = $ref", "", "name", "");
return $results[0]['name'];
}

function DoChangetoNameISO($ref){
global $db;
$results = $db->select("country", "iso = '$ref'", "", "name", "");
return $results[0]['name'];
}

function LastAdd(){
global $db;
$return = "";
$results = $db->select("reg", "", "", "*", "", "ID DESC", "0,17");
foreach($results as $item){
    $return .= "<li class=\"active\"><a href=\"#\">#".$item['ID']." ".$item['Country']."</a></li>";
}
return $return;
}

function DoExistStrain($name){
global $db;
$bind = array(
    ":Name" => "%$name%"
);

$results = $db->run("SELECT * FROM strain WHERE Name LIKE :Name", $bind);

	if(count($results) > 0){
	return true;
	}else{
	return false;
	}
}

function DoExistStrainID($id){
global $db;
$bind = array(
    ":ID" => "$id"
);

$results = $db->run("SELECT * FROM strain WHERE ID = :ID", $bind);

	if(count($results) > 0){
	return true;
	}else{
	return false;
	}
}

function DoExistReport($id){
global $db;
$bind = array(":ID" => "$id");
$results = $db->run("SELECT * FROM abuses WHERE STRAIN = :ID", $bind);
	if(count($results) > 0){
	return true;
	}else{
	return false;
	}
}

function DoExistCountryISO($ISO){
global $db;
$bind = array(
    ":ISO" => "$ISO"
);

$results = $db->run("SELECT * FROM country WHERE iso = :ISO", $bind);

	if(count($results) > 0){
	return true;
	}else{
	return false;
	}
}

function DoReguleColours($s){
global $db;
$color="";
$bind = array(":country" => "$s");
$results = $db->select("reg", "Country = :country", $bind, "count(*) as People");
$people = $results[0]["People"];
if($people > 0 && $people < 100){
$color=1;
}else if($people > 100 && $people < 200){
$color=2;
}else if($people > 200 && $people < 300){
$color=3;
}else if($people > 300 && $people < 400){
$color=4;
}else if($people > 400 && $people < 500){
$color=5;
}else if($people > 500 && $people < 600){
$color=6;
}else if($people > 600 && $people < 700){
$color=7;
}else if($people > 700 && $people < 800){
$color=8;
}else if($people > 900 && $people < 1000){
$color=9;
}else if($people > 1000){
$color=10;
}

$update = array("LVL" => $color);
$db->update("country", $update, "name = '".$s."'");

}

function DoAddReport($s){
global $db;
$bind = array(":strain" => "$s");
$results = $db->run("INSERT INTO abuses (STRAIN) values (:strain)", $bind);
}

function FootPrintbyUserExist($country,$ip,$points,$strain){
global $db;
$bind = array(":country" => "$country", ":ip" => $ip);
$results = $db->select("reg", "Country = :country AND IP = :ip", $bind, "count(*) as People");
	if($results[0]['People'] > 0){
	$update = array("Calification" => $points, "Type" => $strain);
	$db->update("reg", $update, "Country = '".$country."', IP = '".$ip."'");
	return true;
	}else{
	return false;
	}
}

?>