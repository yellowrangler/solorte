<?php

$EDon = 'N';
$key="2s0o0l4ort!e";

function bytexor($a,$b,$l)
{
	$c="";
	for($i=0;$i<$l;$i++) {
	 $c.=$a{$i}^$b{$i};
	}
	return($c);
}

function binmd5($val)
{
	return(pack("H*",md5($val)));
}

function decrypt_md5($msg,$heslo)
{
	$key=$heslo;$sifra="";
	$key1=binmd5($key);
	while($msg) {
		 $m=substr($msg,0,16);
		 $msg=substr($msg,16);
		 $sifra.=$m=bytexor($m,$key1,16);
		 $key1=binmd5($key.$key1.$m);
	}

	return($sifra);
}

function crypt_md5($msg,$heslo)
{
	$key=$heslo;$sifra="";
	$key1=binmd5($key);
	while($msg) {
		 $m=substr($msg,0,16);
		 $msg=substr($msg,16);
		 $sifra.=bytexor($m,$key1,16);
		 $key1=binmd5($key.$key1.$m);
	}

	return($sifra);
}

function spookDStr($MsgIn)
{
	global $EDon;
	global $key;
	
	if ($EDon == 'Y')
	{
		$result = decrypt_md5($MsgIn, $key);
	}
	else
	{
		$result = $MsgIn;
	}

	return($result); 	
}

function spookEStr($MsgIn)
{
	global $EDon;
	global $key;

		if ($EDon == 'Y')
	{
		$result = crypt_md5($MsgIn, $key);
	}
	else
	{
		$result = $MsgIn;
	}
	
	return($result); 	
}

?>
