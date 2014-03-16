<?php 

function constructQuery($query, $url)
{
   $format = 'application/sparql+xml';
 
   $searchUrl = $url . '?'
      .'query='.urlencode($query)
      .'&output='.$format;
	  
   return $searchUrl;
}
 
 
function request($url)
{
   if (!function_exists('curl_init')){ 
      die('CURL is not installed!');
   }
   $ch= curl_init();
 
   curl_setopt($ch, 
      CURLOPT_URL, 
      $url);
 
   curl_setopt($ch, 
      CURLOPT_RETURNTRANSFER, 
      true);
 
   $response = curl_exec($ch);
 
   curl_close($ch);
 
   return $response;
}

$query = $_POST['query'];
$url = $_POST['endpoint'];

$requestURL = constructQuery($query, $url);
 
$responseArray = request($requestURL);
?>
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml">
 
<head>
 
<title>SPARQL Proxy Executor</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
 
<body><?php echo $responseArray; ?>
</body>
</html>
