<?php
$query = $_GET["query"];
$action = $_GET["a"];


//burada arama yapabiliriz.
if($action == "Git")
echo "<script>document.location.href='https://".$query.".isim.link/'</script>";
else if($action == "s"){
include "../conf/db.php";
$q = $db->prepare("CALL doSearch(:query)");
$q->execute(array("query" => $query));
$f = $q->fetchAll(PDO::FETCH_ASSOC);
$html = "";
foreach($f as $pp){
$html.='<li class="collection-item avatar">';
$type = $pp["Type"] == "c" ? "business" : "person";
$html.= '<i class="material-icons circle">'.$type.'</i>';
$html.= '<span class="title">'.$pp["Isim"].'</span>';
$html.= '<p>'.$pp["Domain"].'.isim.link</p>';
$html.= '<a href="https://'.$pp["Domain"].'.isim.link/" class="secondary-content"><i class="material-icons">arrow_forward_ios</i></a></li>';
}
echo $html;
//echo json_encode($f);
}
?>