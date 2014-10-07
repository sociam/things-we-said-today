<?php

function put_data($url)
{
$data = array("a" => $a);
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
curl_setopt($ch, CURLOPT_USERPWD, "ragld:ragld");

$response = curl_exec($ch);
if(!$response) {
    return false;
}
}

mysql_connect("localhost", "db10659659-use", "KaT750AnA") or die(mysql_error()); mysql_select_db("db10659659-usewod") or die(mysql_error());

$data =  mysql_query("SELECT sm, content FROM topservatory WHERE sm ='twitter worldwide'") or die(mysql_error());

$results = array();
while($info = mysql_fetch_array( $data )) { 
	//echo str_replace('#','',$info['content']);
	$data2 =  mysql_query("SELECT sm, tstamp, rank, content FROM topservatory WHERE content LIKE '%".str_replace('#','',$info['content'])."%' AND sm <>'twitter worldwide'") or die(mysql_error());
	
	put_data('http://sociam-pub.ecs.soton.ac.uk/sociam/label/pairs/'.urlencode($info['sm'].'/a/'.str_replace('#','',$info['content'])).'/'.urlencode(str_replace('#','',$info['content'])));
	
	while($info2 = mysql_fetch_array( $data2 )) { 
		//echo 'http://sociam-pub.ecs.soton.ac.uk/sociam/closeMatch/'.$info['sm'].'/a/'.urlencode($info['content']) . ' - ' . 'http://sociam-pub.ecs.soton.ac.uk/sociam/closeMatch/'.$info2['sm'].'/a/'.urlencode($info2['content']) . '<br />';
		put_data('http://sociam-pub.ecs.soton.ac.uk/sociam/closeMatch/pairs/'.urlencode($info['sm'].'/a/'.str_replace('#','',$info['content'])).'/'.urlencode($info2['sm'].'/a/'.str_replace('#','',$info2['content'])));

put_data('http://sociam-pub.ecs.soton.ac.uk/sociam/label/pairs/'.urlencode($info2['sm'].'/a/'.str_replace('#','',$info2['content'])).'/'.urlencode(str_replace('#','',$info2['content'])));

	}
}

echo "done";

?>