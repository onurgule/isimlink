<?php

function sifrele($sifre){
	return password_hash($sifre, PASSWORD_ARGON2I, ['memory_cost' => 2048, 'time_cost' => 4, 'threads' => 3]);
}
function dogrula($sifre,$hash){
if(password_verify($sifre,$hash) == 1) return 1;
else return 0;
}