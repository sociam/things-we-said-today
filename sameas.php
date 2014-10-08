<?php

$headers = array( 
            "HTTP_ACCEPT: text/plain"
        ); 

$source = $_GET['uri'];

$url = 'http://sociam-pub.ecs.soton.ac.uk/sociam/closeMatch/canons/'.urlencode($source).'/';

function get_data($url)
{
  $ch = curl_init();
  $timeout = 5;
  curl_setopt($ch,CURLOPT_URL,$url);
  curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
  curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}

echo get_data($url);

?>