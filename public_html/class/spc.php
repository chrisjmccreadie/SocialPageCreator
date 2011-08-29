<?php
error_reporting(E_ALL);
ini_set('display_errors','On');
class spc
{
    var $sites;  //sites config
     var $site; //site
     var $server; //hold the server 	
     var $youtubeembedurl; //hold the youtube image url
     var $youtubeimage; //hold the you tube image
     var $twitterFeed; //twitter feed
     var $rssfeed1; //first rss feed
     var $youtubes; //hold the you tube information
   

    function __construct()
    {
	
      	 include('config/sites.php');       
      	 $this->sites = $sites;
     	  $this->youtubeembedurl = $youtubeembedurl;
       	$this->youtubeimage = $youtubeimage;
     }

    function findsite()
    {
	foreach ($this->sites as $site)
	{
		//echo "$this->server : ".$site['url'];
		if ($this->server == $site['url'])
		{
			$this->site = (object) $site;
			
			//return();
		}
	}

    }

   function fetchTwitter()
   {
	 $url = 'http://twitter.com/statuses/user_timeline.xml?screen_name=' . $this->site->twitter;
    	
    	$data = file_get_contents($url);
    	$xmlDoc = DOMDocument::loadXML($data);
    	$statuses = $xmlDoc->getElementsByTagName('status');
    	$updates = array();
    	if($statuses->length > 0) {
        	foreach($statuses as $status) {
		
            		$id = $status->getElementsByTagName('id')->item(0)->nodeValue;
            		$text = $status->getElementsByTagName('text')->item(0)->nodeValue;
            		$date = $status->getElementsByTagName('created_at')->item(0)->nodeValue;
			$date = str_replace("+0000","",$date);
            		$updates[] = array('id'=>$id, 'text'=>$text,'date'=> $date);
        	}
    	}
	//print_r($updates);
    	 $this->twitterFeed = (object) $updates;
   }

   function fetchRssFeed($index)
   {
	if ($index == 1)
		$file = file_get_contents($this->site->rss1);
	$xml = new SimpleXMLElement($file);
	foreach($xml->channel->item as $feed)
	{
		$updates[] = array('title'=>$feed->title, 'link'=>$feed->link);

	}
	if ($index == 1)
		 $this->rssFeed1 = (object) $updates;
   }

   function processYoutube()
   {
	$yt = explode(",",$this->site->youtubeurl);
	foreach($yt as $tube)
	{	
		
		$url = $this->youtubeembedurl.$tube;
		$thumb = str_replace('[CODE]',$tube,$this->youtubeimage);
		$updates[] = array('thumb'=>$thumb, 'link'=>$url);
	}
	 $this->youtubes = (object) $updates;
   }

    function debug()
   {
	print_r($this->site);
	echo $this->site->title;
   }
	
   
}
?>
