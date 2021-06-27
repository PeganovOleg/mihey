<?php
session_start();
if(!isset($_SESSION['code']))
{
	require_once('geoplugin.class.php');
	$geoplugin = new geoPlugin();

	//locate the IP
	$geoplugin->locate();

	foreach($_locales as $code=>$country)
	{
		if($geoplugin->countryCode == $code)
		{
			$_SESSION['code'] = $code;
			$url = $siteurl.$code."/";
			
			header("Location: $url ");
			exit;
		}
	}
}
else
{
	
	if(count($parts) == 0)
	{
		session_destroy();
		header('location:./');
		exit;
	}
}



?>