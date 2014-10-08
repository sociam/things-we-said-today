<?php

function get_data($url)
{
  $ch = curl_init();
  $timeout = 5;
  curl_setopt($ch,CURLOPT_URL,$url);
  curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
  curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}

function write_data($source, $column, $label)
{
  $time = date('Y-m-d H:i:s');
  $next = json_decode(get_data($source));
  $rank = 0;
  //iterate through all data and put in db
  foreach ($next->{'results'} as &$value) {
    $rank++;
    $scrubbed_val = mysql_real_escape_string(str_replace('"', "", str_replace("'","",$value->{$column})));
    $query = "INSERT INTO topservatory VALUES ('".$label."', '".$time."', '', ".$rank.", '".$scrubbed_val."')";
    //echo $query;
    $data = mysql_query($query) or die(mysql_error());
  }
}

function get_and_write() {
  //get all data
  $reddit = "https://api.import.io/store/data/f4a12078-8874-459d-8716-c4927766f690/_query?input/webpage/url=http%3A%2F%2Fwww.reddit.com%2F&_user=06f7ccbe-2094-43e3-b58b-bfc6ddae660a&_apikey=TBVNWMPuIjVy6OdGQydfbEnBADwuF7rKU66T9dAk9ItTy4nHeW0SchN%2BN2pCMekSeaFCBxwmsQ6Gcxg5L%2FdzzQ%3D%3D";
  write_data($reddit, 'reddit_news', "reddit");

  $wikipedia = "https://api.import.io/store/data/dd98ab49-9826-4173-a9d4-318b419dbead/_query?input/webpage/url=http%3A%2F%2Fen.wikipedia.org%2Fwiki%2FMain_Page&_user=06f7ccbe-2094-43e3-b58b-bfc6ddae660a&_apikey=TBVNWMPuIjVy6OdGQydfbEnBADwuF7rKU66T9dAk9ItTy4nHeW0SchN%2BN2pCMekSeaFCBxwmsQ6Gcxg5L%2FdzzQ%3D%3D";
  write_data($wikipedia, "newsitem", "wikipedia");

  $twitter_worldwide = "https://api.import.io/store/data/e844ebad-c255-484f-8990-a2c334a498d4/_query?input/webpage/url=https%3A%2F%2Ftwitter.com%2Fsearch-home&_user=3c60555f-c805-4ac9-9343-4e115624bc6a&_apikey=PlT6w%2FVTTluKIPHAmfD73mZT0X49XJ0mYRSP%2BOEfNudJpz9OZhFf0RnRzQUoeuNVmPJC2RHjzNs1VB%2FNNOyNag%3D%3D";
  write_data($twitter_worldwide, "tw_worldwide", "twitter worldwide");

  $yahoo_us = "https://api.import.io/store/data/615922ec-02ee-4779-8590-6760e8984aac/_query?input/webpage/url=https%3A%2F%2Fus.yahoo.com%2F&_user=3c60555f-c805-4ac9-9343-4e115624bc6a&_apikey=PlT6w%2FVTTluKIPHAmfD73mZT0X49XJ0mYRSP%2BOEfNudJpz9OZhFf0RnRzQUoeuNVmPJC2RHjzNs1VB%2FNNOyNag%3D%3D";
  write_data($yahoo_us, "yahoo_us", "yahoo us");

  $yahoo_uk = "https://api.import.io/store/data/e46a9540-37a0-443b-aecf-09b6585eb843/_query?input/webpage/url=https%3A%2F%2Fuk.yahoo.com%2F&_user=3c60555f-c805-4ac9-9343-4e115624bc6a&_apikey=PlT6w%2FVTTluKIPHAmfD73mZT0X49XJ0mYRSP%2BOEfNudJpz9OZhFf0RnRzQUoeuNVmPJC2RHjzNs1VB%2FNNOyNag%3D%3D";
  write_data($yahoo_uk, "yahoo_uk", "yahoo uk");

  $google_us = "https://api.import.io/store/data/f392fecc-52fc-4d6b-a019-2aa4ea0f91e9/_query?input/webpage/url=https%3A%2F%2Fwww.google.com%2Ftrends%2Fhottrends&_user=3c60555f-c805-4ac9-9343-4e115624bc6a&_apikey=PlT6w%2FVTTluKIPHAmfD73mZT0X49XJ0mYRSP%2BOEfNudJpz9OZhFf0RnRzQUoeuNVmPJC2RHjzNs1VB%2FNNOyNag%3D%3D";
  write_data($google_us, "google_us", "google us");

  $reuters_us = "https://api.import.io/store/data/46c2a5cf-10d3-4c6a-99b9-e8b8db87f7c4/_query?input/webpage/url=http%3A%2F%2Fwww.reuters.com%2Fnews%2Farchive%2FworldNews%3Fview%3Dpage&_user=3c60555f-c805-4ac9-9343-4e115624bc6a&_apikey=PlT6w%2FVTTluKIPHAmfD73mZT0X49XJ0mYRSP%2BOEfNudJpz9OZhFf0RnRzQUoeuNVmPJC2RHjzNs1VB%2FNNOyNag%3D%3D";
  write_data($reuters_us, "reuters_us", "reuters us");

  $reuters_uk = "https://api.import.io/store/data/6a694fc9-63fa-4b69-9406-9a32d2f0c631/_query?input/webpage/url=http%3A%2F%2Fuk.reuters.com%2Fnews%2Farchive%2FworldNews%3Fview%3Dpage&_user=3c60555f-c805-4ac9-9343-4e115624bc6a&_apikey=PlT6w%2FVTTluKIPHAmfD73mZT0X49XJ0mYRSP%2BOEfNudJpz9OZhFf0RnRzQUoeuNVmPJC2RHjzNs1VB%2FNNOyNag%3D%3D";
  write_data($reuters_uk, "reuters_uk", "reuters uk");
  
  $digg = "https://api.import.io/store/data/4612a1ba-dd0a-4856-827f-a931af55a8f8/_query?input/webpage/url=http%3A%2F%2Fdigg.com%2F&_user=06f7ccbe-2094-43e3-b58b-bfc6ddae660a&_apikey=TBVNWMPuIjVy6OdGQydfbEnBADwuF7rKU66T9dAk9ItTy4nHeW0SchN%2BN2pCMekSeaFCBxwmsQ6Gcxg5L%2FdzzQ%3D%3D";
write_data($digg, "newsitem", "digg");
  
  // add more sources here 
}

// repeat every 5 minutes for ~30 hours (if it doesn't break the server, db, anything else, we might consider leaving this on for longer/ever)
$count = 0;
$log = fopen("fetch.log", "a");
while ($count < 400) {
  $count++;
  //echo "getting data and writing it to db at time ".date('d/M H:i:s')."<br>";
  $db_conn = mysql_connect("localhost", "db10659659-use", "KaT750AnA") or die(mysql_error()); 
  if ($db_conn) 
  {
    mysql_select_db("db10659659-usewod") or die(mysql_error());
    fwrite($log, "we have db connection ".var_dump($db_conn)."\n");
    fwrite($log, "getting data and writing it to db at time ".date('d M H:i:s')."\n");
    get_and_write();
    //echo "power napping <br>";
    mysql_close($db_conn);
    fwrite($log, "closed db connection\n");
  }
  fwrite($log, "power napping\n");
  fflush($log);
  sleep(300);
}


?>