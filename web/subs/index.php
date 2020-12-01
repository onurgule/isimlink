<?php
session_start();
?>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
<link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
  <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
<style>
@import url("https://fonts.googleapis.com/css2?family=Baloo+Paaji+2:wght@400;500&display=swap");

.container {
  //display: grid;
  //grid-template-columns: 300px 300px 300px;
  grid-gap: 50px;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-color: #f5f5f5;
  font-family: 'Baloo Paaji 2', cursive;
}

.card {
  background-color: #222831;
  height: 37rem;
  border-radius: 5px;
  display: flex;
  flex-direction: column;
  align-items: center;
  box-shadow: rgba(0, 0, 0, 0.7);
  color: white;
  height:100%;
}

.card__name {
  margin-top: 15px;
  font-size: 1.5em;
}

.card__image {
  height: 160px;
  width: 160px;
  border-radius: 50%;
  border: 5px solid #272133;
  margin-top: 20px;
  box-shadow: 0 10px 50px rgba(235, 25, 110, 1);
}


.draw-border {
  box-shadow: inset 0 0 0 4px #58cdd1;
  color: #58afd1;
  -webkit-transition: color 0.25s 0.0833333333s;
  transition: color 0.25s 0.0833333333s;
  position: relative;
}

.draw-border::before,
.draw-border::after {
  border: 0 solid transparent;
  box-sizing: border-box;
  content: '';
  pointer-events: none;
  position: absolute;
  width: 0rem;
  height: 0;
  bottom: 0;
  right: 0;
}

.draw-border::before {
  border-bottom-width: 4px;
  border-left-width: 4px;
}

.draw-border::after {
  border-top-width: 4px;
  border-right-width: 4px;
}

.draw-border:hover {
  color: #ffe593;
}

.draw-border:hover::before,
.draw-border:hover::after {
  border-color: #eb196e;
  -webkit-transition: border-color 0s, width 0.25s, height 0.25s;
  transition: border-color 0s, width 0.25s, height 0.25s;
  width: 100%;
  height: 100%;
}

.draw-border:hover::before {
  -webkit-transition-delay: 0s, 0s, 0.25s;
  transition-delay: 0s, 0s, 0.25s;
}

.draw-border:hover::after {
  -webkit-transition-delay: 0s, 0.25s, 0s;
  transition-delay: 0s, 0.25s, 0s;
}

.btn {
  background: none;
  border: none;
  cursor: pointer;
  line-height: 1.5;
  font: 700 1.2rem 'Roboto Slab', sans-serif;
  padding: 0.75em 2em;
  letter-spacing: 0.05rem;
  margin: 1em;
  width: 13rem;
}

.btn:focus {
  outline: 2px dotted #55d7dc;
}


.social-icons {
  padding: 0;
  list-style: none;
  margin: 1em;
}

.social-icons li {
  display: inline-block;
  margin: 0.15em;
  position: relative;
  font-size: 1em;
}

.social-icons i {
  color: #fff;
  position: absolute;
  top: 0.95em;
  left: 0.96em;
  transition: all 265ms ease-out;
}

.social-icons a {
  display: inline-block;
}

.social-icons a:before {
  transform: scale(1);
  -ms-transform: scale(1);
  -webkit-transform: scale(1);
  content: " ";
  width: 45px;
  height: 45px;
  border-radius: 100%;
  display: block;
  background: linear-gradient(45deg, #ff003c, #c648c8);
  transition: all 265ms ease-out;
}

.social-icons a:hover:before {
  transform: scale(0);
  transition: all 265ms ease-in;
}

.social-icons a:hover i {
  transform: scale(2.2);
  -ms-transform: scale(2.2);
  -webkit-transform: scale(2.2);
  color: #ff003c;
  background: -webkit-linear-gradient(45deg, #ff003c, #c648c8);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  transition: all 265ms ease-in;
}

.grid-container {
  display: grid;
  grid-template-columns: 1fr 1fr;
  grid-gap: 20px;
  font-size: 1.2em;
}
body{
	margin:0;
	text-align:center;
}
</style>

<style>
.wrapper {
	 max-width: 400px;
	 margin: 0px auto;
}
 .page {
	 width: 100vw;
	 height: 100vh;
	 padding: 20px;
	 box-sizing: border-box;
	 display: flex;
	 flex-direction: row;
	 justify-content: center;
	 align-items: center;
}
 .page img {
	 max-width: 60%;
	 height: auto;
	 display: block;
}
 .bottom-appbar {
	 height: 70px;
	 position: fixed;
	 bottom: 0;
	 left: 0;
	 right: 0;
	 z-index: 20;
}
 .bottom-appbar .tabs {
	 display: flex;
	 flex-direction: row;
	 height: 100%;
}
 .bottom-appbar .tabs .tab {
	 background-color: #fff;
	 width: 33.4%;
	 height: 100%;
	 display: flex;
	 justify-content: center;
	 align-items: center;
	 flex-direction: column;
	 border-top: 1px solid #eee;
	 box-shadow: 1x 1x 3px #ccc, -1px -1px 3px #ccc;
	 font-size: 24px;
}
 .bottom-appbar .tabs .tab--left {
	 width: 100%;
	 border-top-right-radius: 30px;
	 border-top: 1px solid rgba(167, 161, 161, 0.69);
	 box-shadow: 0px 6px 7px 0px rgba(23, 23, 23, 0.28);
}
 .bottom-appbar .tabs .tab--right {
	 width: 100%;
	 border-top-left-radius: 30px;
	 border-top: 1px solid rgba(167, 161, 161, 0.69);
	 box-shadow: 15px 4px 15px 0px rgba(23, 23, 23, 0.28);
}
 .bottom-appbar .tabs .tab--fab {
	 width: 180px;
	 height: 100%;
	 background: transparent;
	 border: none;
	 display: flex;
}
 .bottom-appbar .tabs .tab--fab .top {
	 width: 100%;
	 height: 50%;
	 border-bottom-left-radius: 100px;
	 border-bottom-right-radius: 100px;
	 background-color: transparent;
	 box-shadow: 0px 30px 0px 25px #fff;
	 border-bottom: 1px solid rgba(167, 161, 161, 0.69);
	 display: flex;
}
 .bottom-appbar .tabs .tab span {
	 font-size: 12px;
}
 .bottom-appbar .tabs .tab i {
	 font-size: 24px;
}
 .bottom-appbar .tabs .tab.is-active {
	 color: #2373BF;
}
.whatsapp{
	color: #43D854;
}
 .bottom-appbar .tabs .fab {
	 border-radius: 50%;
	 background-color: #2373BF;
	 display: flex;
	 justify-content: center;
	 align-items: center;
	 width: 70px;
	 height: 70px;
	 font-weight: bold;
	 font-size: 22px;
	 color: #fff;
	 position: relative;
	 justify-content: center;
	 transform: translate(2px, -60%);
}
 
</style>
<?php
include "../conf/db.php";
$username = $_GET["user"];
$q=$db->prepare('CALL LogToDom(:domain,:fuid,:logtype)');
$uid = ($_SESSION['uid'] != null) ? $_SESSION['uid'] : 0;
$q->execute(array("domain" => $username, "fuid" => $uid, "logtype" => "0"));

$uid = ($_SESSION["uid"] != null) ? $_SESSION["uid"] : '0';

$q = $db->prepare("CALL getDomainInfos_new(:username,:uid)");
$q->execute(array("username" => $username, "uid" => $uid));
$f = $q->fetchAll(PDO::FETCH_ASSOC);
if(count($f)>0){
	$name = "";
	$surname = "";
	$phones = [];
	$emails = [];
	foreach($f as $info){
		if($info["Type"] == "-1") $name = $info["Info"];
		if($info["Type"] == "-2") $surname = $info["Info"];
		if($info["Type"] == "1") array_push($emails,array("value" => $info["Info"],"privacy" => $info["Privacy"]));
		if($info["Type"] == "2") array_push($phones,array("value" => $info["Info"],"privacy" => $info["Privacy"]));
		
	}		
	//$f=$f[0];
	?>
	<form action="call.php" id="frm">
	<input type="hidden" name="num" value="<?=$phones[0]["value"]?>" /> 
  </form>
	<!--<h3 style="text-align:center;"><?=$name." ".$surname?></h3>
	<h3 style="text-align:center;"><?=$phones[0]["value"]?></h3>-->
	<style>a{color:lightblue;}</style>
	<div class="container">
  <div class="card">
  <?if($_SESSION["domain"] == $username){?>
	<a href="admin">
   <?}?>
	
    <img src="https://media-s3-us-east-1.ceros.com/lee/images/2020/03/13/526652c2552319459bf6d52c8c3eb77f/covidweb-05-mask.png" alt="Person" class="card__image">
  <?if($_SESSION["domain"] == $username){?>
	</a>
   <?}?>
    <p class="card__name" style="margin-bottom:0px;"><?=$name." ".$surname?></p>
	<h4 style="margin-top:0px; font-weight:normal;"><?=$username?>.isim.link</h5>
    <div>
      <div class="grid-child-posts">
        <p style="text-align:center; display:flex; flex-direction:space-between; font-size:larger;">
           <?
		   foreach($phones as $phone){
			   if($phone["privacy"] != "3") echo "<p><a href='tel:".$phone["value"]."'>".$phone["value"]."</a></p>";
			   else echo "<p><a href='tel:".$phone["value"]."'><b>".$phone["value"]."</b></a></p>";
		   }
		   foreach($emails as $email){
			   if($email["privacy"] != "3") echo "<p><a href='mailto:".$email["value"]."'>".$email["value"]."</a></p>";
			   else echo "<p><a href='mailto:".$email["value"]."'><b>".$email["value"]."</b></a></p>";
		   }
		   ?></p>

      </div>

      <!--<div class="grid-child-followers">
        1012 Likes
      </div>-->

    </div>
	<div style="display:none">
    <ul class="social-icons" >
      <li><a href="#"><i class="fa fa-instagram"></i></a></li>
      <li><a href="#"><i class="fa fa-twitter"></i></a></li>
      <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
      <li><a href="#"><i class="fa fa-codepen"></i></a></li>
    </ul>
	<?php
	if(count($phones) > 0){
	?>
    <button onclick='document.getElementById("frm").submit();' class="btn draw-border">Ara</button>
    <button onclick='document.location.href="https://api.whatsapp.com/send?phone=<?=$phones[0]["value"]?>"' class="btn draw-border">Whatsapp'tan Yaz</button>
	<?}?>
</div>
<? if(isset($_SESSION["uid"])){

}
else{?>
<p style="text-align:center;">Giriş yapmadığınız için bazı bilgileri göremeyebilirsiniz.</p>
<? } ?>
  </div>
  <div class="bottom-appbar">
    <div class="tabs">
	<? if(isset($_SESSION["uid"])){
		?>
		<div onclick='paylas();' class="tab is-active tab--left">
	<i class="fa fa-share-alt" aria-hidden="true"></i>
        <span>Paylaş</span>
      </div>
	<?
}
else{?>
<div onclick='document.location.href="https://isim.link/login.php?redir=<?=$username?>"' class="tab is-active tab--left">
        <i class="fa fa-sign-in" aria-hidden="true"></i>
        <span>Giriş</span>
      </div>
<? } ?>
      <?php
	if(count($phones) > 0){
	?>
      <div onclick='document.getElementById("frm").submit();' class="tab tab--fab ">
        <div class="top">
          <div class="fab">
            <i class="fa fa-phone" aria-hidden="true"></i>
          </div>
        </div>
      </div>
      <div onclick='document.location.href="https://api.whatsapp.com/send?phone=<?=$phones[0]["value"]?>"' class="tab tab--right whatsapp">
        <i class="fa fa-whatsapp" aria-hidden="true"></i>
        <span>Whatsapp</span>
      </div>
	<? }
		else if(count($emails) > 0) {?>
		<div onclick='document.location.href="mailto:<?=$emails[0]['value']?>"' class="tab tab--fab ">
        <div class="top">
          <div class="fab">
            <i class="fa fa-envelope" aria-hidden="true"></i>
          </div>
        </div>
      </div>
	  <?
	  if(isset($_SESSION["uid"])){ ?>
      <div onclick='document.location.href="https://api.whatsapp.com/send?phone=<?=$phones[0]["value"]?>"' class="tab tab--right whatsapp">
        <i class="fa fa-lock" aria-hidden="true"></i>
        <span>Erişim İste</span>
      </div>
	  <? } else {?>
	  <div onclick='document.location.href="https://api.whatsapp.com/send?phone=<?=$phones[0]["value"]?>"' class="tab tab--right whatsapp">
        <i class="fa fa-plus" aria-hidden="true"></i>
        <span>Link Oluştur</span>
      </div>
		<?}
		}
		else {?>
		
			<div onclick='document.location.href="https://isim.link/login.php?redir=<?=$username?>"' class="tab tab--fab ">
        <div class="top">
          <div class="fab">
            <i class="fa fa-sign-in" aria-hidden="true"></i>
          </div>
        </div>
      </div>
	  <div onclick='document.location.href="https://api.whatsapp.com/send?phone=<?=$phones[0]["value"]?>"' class="tab tab--right whatsapp">
        <i class="fa fa-plus" aria-hidden="true"></i>
        <span>Link Oluştur</span>
      </div>
		<?}?>
    </div>
  </div>
</div>

	<script>
	function paylas(){
  if (navigator.share) {
    navigator.share({
      title: 'IsimLink',
      url: 'https://isim.link/'
    }).then(() => {
      console.log('Thanks for sharing!');
    })
    .catch(console.error);
  } else {
    window.navigator.clipboard.writeText("https://<?=$username?>.isim.link/")
  }
	}
		const isMobile = () =>
  /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series([46])0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(
    navigator.userAgent
  ) ||
  /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br([ev])w|bumb|bw-([nu])|c55\/|capi|ccwa|cdm-|cell|chtm|cldc|cmd-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc-s|devi|dica|dmob|do([cp])o|ds(12|-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly([-_])|g1 u|g560|gene|gf-5|g-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd-([mpt])|hei-|hi(pt|ta)|hp( i|ip)|hs-c|ht(c([- _agpst])|tp)|hu(aw|tc)|i-(20|go|ma)|i230|iac([ \-/])|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja([tv])a|jbro|jemu|jigs|kddi|keji|kgt([ /])|klon|kpt |kwc-|kyo([ck])|le(no|xi)|lg( g|\/([klu])|50|54|-[a-w])|libw|lynx|m1-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t([- ov])|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30([02])|n50([025])|n7(0([01])|10)|ne(([cm])-|on|tf|wf|wg|wt)|nok([6i])|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan([adt])|pdxg|pg(13|-([1-8]|c))|phil|pire|pl(ay|uc)|pn-2|po(ck|rt|se)|prox|psio|pt-g|qa-a|qc(07|12|21|32|60|-[2-7]|i-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h-|oo|p-)|sdk\/|se(c([-01])|47|mc|nd|ri)|sgh-|shar|sie([-m])|sk-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h-|v-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl-|tdg-|tel([im])|tim-|t-mo|to(pl|sh)|ts(70|m-|m3|m5)|tx-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c([- ])|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas-|your|zeto|zte-/i.test(
    navigator.userAgent.substr(0, 4)
  );
  /*
  Direkt arama iptal edildi...
  if(isMobile()){
		{
        
		document.getElementById("frm").submit();
		setTimeout(function(){
		if(confirm("<?=$f["Name"]." ".$f["Surname"]?> adlı kişiyi aramak istiyor musunuz?"))
		{
			document.getElementById("frm").submit();
		}
		},200);
		}
	}
	else{
		window.location.href = "tel:<?=$phones[0]?>";
	}*/
	</script>
	<?
}
else{
	header("Location: https://isim.link/");
	echo "<script>document.location.href='https://isim.link/';</script>";
}