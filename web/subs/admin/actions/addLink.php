<?
session_start();
include "../../../conf/db.php";

$q = $db->prepare("CALL connectDomainInfo(:uid,:did,:iid,:pid)");
$q->execute(array("uid" => $_SESSION['uid'], "did" => $_GET["did"], "iid" => $_GET["iid"], "pid" => $_GET["pid"]));
$f = $q->fetchAll(PDO::FETCH_ASSOC);
echo "<script>document.location.href='https://onur.isim.link/admin/connect-domain-info.php?ret=".$f[0]["return"]."'</script>";