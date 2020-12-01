<?
session_start();
include "../../../conf/db.php";

$q = $db->prepare("CALL addContact(:uid,:query)");
$q->execute(array("uid" => $_SESSION['uid'], "query" => $_GET["contact"]));
$f = $q->fetchAll(PDO::FETCH_ASSOC);
echo "<script>document.location.href='https://onur.isim.link/admin/permissions.php?ret=".$f[0]["return"]."'</script>";