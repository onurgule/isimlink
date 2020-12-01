<?php
$infotype=$_GET["it"];
if($infotype == 1){
	?>
	<form>
    <div class="input-field">
        <input id="step2" type="email" value="" >
        <label for="step2">Email Adresiniz</label>
    </div>
</form>
	<?
}
else if($infotype == 2){
	?>
	<form>
    <div class="input-field">
        <input id="step2" type="tel" value="" >
        <label for="step2">Telefon Numaranız</label>
    </div>
</form>
	<?
}
else if($infotype == 3){
	
}