<?php

mysql_connect("localhost", "db10659659-use", "KaT750AnA") or die(mysql_error()); mysql_select_db("db10659659-usewod") or die(mysql_error());

$data =  mysql_query("SELECT * FROM topservatory") or die(mysql_error());

//$data =  mysql_query("select * from topservatory as a inner join (SELECT sm, MAX( tstamp ) as tstamp FROM topservatory GROUP BY sm) as b on a.sm=b.sm and a.tstamp=b.tstamp") or die(mysql_error());

//$info = mysql_fetch_array( $data );

$results = array();

while($info = mysql_fetch_array( $data )) { 
	array_push($results,array('sm' => $info['sm'],'tstamp' => $info['tstamp'],'topic' => $info['topic'],'rank' => $info['rank'],'content' => $info['content']));
}

echo json_encode($results);

?>