<?php
/*
*SHC 
*
*/
error_reporting(E_ALL);
ini_set('display_errors','On');

//include the main class
include('class/spc.php');
$className = 'spc';
$spc = new $className;
//Get the root url.
//echo $_SERVER['SERVER_NAME'];
$spc->server = $_SERVER['SERVER_NAME'];
$spc->findsite();
$spc->fetchTwitter();
$spc->fetchRssFeed(1);
$spc->processYoutube();
//$spc->debug();
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title><?php echo $spc->site->title; ?></title>
  <meta name="description" content="">
  <meta name="author" content="">

  <meta name="viewport" content="width=device-width,initial-scale=1">

  <!-- CSS concatenated and minified via ant build script-->
  <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="<?php echo $spc->site->css; ?>">
  <!-- end CSS-->

  <script src="js/libs/modernizr-2.0.6.min.js"></script>
 		
</head>

<body>

  <div id="container">
    <header>
	<img src="<?php echo $spc->site->headerimage; ?>" />
    </header>
    <div id="main" role="main">
	

<div id="contentwrapper">
	<div id="contentcolumn">
		<div class='about'>
			<?php include($spc->site->about);?>
		</div>
		<div class='rss'>
			<strong>RSS FEED</strong><br/>
			<?php
				foreach ($spc->rssFeed1 as $rss)
				{
					$tw = (object) $rss;
					echo "<a href='$tw->link' target='_blank'>$tw->title</a><br/>";
				}
			?>	
		</div>
	</div>
	<div id='youtube'>
		<strong>You Tube</strong><br/>
		<ul id="mycarousel" class="jcarousel-skin-tango">

		  <?php
		foreach ($spc->youtubes as $youtube)
		{
			$tw = (object) $youtube;
			echo "<li><a href='javascript:launchIt(\"$tw->link\");' target='_blank'><img src='$tw->thumb' height='97' width='130' /></a></li>";
		}
	  ?>	
</ul>
	</div>

	<div id='customhtml1'>
	<?php
		echo $spc->site->customhtml1;
	?>
	</div>

	<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like href="" send="true" width="450" show_faces="true" font=""></fb:like>



<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:comments href="http://www.facebook.com/gravastar" num_posts="2" width="500"></fb:comments>

<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#appId=188809594520234&amp;xfbml=1"></script><fb:live-stream event_app_id="188809594520234" width="400" height="500" xid="" always_post_to_friends="false"></fb:live-stream>
</div>



<div id="rightcolumn">
	<div id='twitter'>
		<Strong><a href='http://twitter.com/#!/<?php echo $spc->site->twitter; ?>' target="_blank">TWITTER FEED</a></strong><br/>
	  	<?php
			$i = 0;
			foreach ($spc->twitterFeed as $twitter)
			{
				$tw = (object) $twitter;
				$txt = substr($tw->text, 0, 50);  
				echo $txt."... Created ".$tw->date."<br/>";
				$i++;
				if ($i == $spc->site->twittercount)
					break;			
			}
	  	?>
	</div>
</div>
</div>
    <footer>

    </footer>
  </div> <!--! end of #container -->


  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/libs/jquery-1.6.2.min.js"><\/script>')</script>
 <link rel="stylesheet" href="js/libs/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
<script type="text/javascript" src="js/libs/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript" src="js/libs/jcarousel/jquery.jcarousel.min.js"></script>
<link rel="stylesheet" type="text/css" href="js/libs/jcarousel/tango/skin.css" />
<style type="text/css"> 
 
/**
 * Overwrite for having a carousel with dynamic width.
 */
.jcarousel-skin-tango .jcarousel-container-horizontal {
    width: 60%;
}
 
.jcarousel-skin-tango .jcarousel-clip-horizontal {
    width: 100%;
}
 
</style> 
 

  <!-- scripts concatenated and minified via ant build script-->
  <script defer src="js/plugins.js"></script>
  <script defer src="js/script.js"></script>
  <!-- end scripts-->


  <script> // Change UA-XXXXX-X to be your site's ID
    window._gaq = [['_setAccount','UAXXXXXXXX1'],['_trackPageview'],['_trackPageLoadTime']];
    Modernizr.load({
      load: ('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js'
    });
  </script>


  <!--[if lt IE 7 ]>
    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
  <![endif]-->
  
<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery('#mycarousel').jcarousel({
        // Configuration goes here
	 visible: 4
    });
});
</script>
<script>


function launchIt(url)
{
		$ = jQuery;
		$.fancybox({

         'autoScale' : false,
         'transitionIn' : 'none',
         'transitionOut' : 'none',
         'content' : '',
         'type' : 'iframe',
         'href' : url

		});
	//alert(url);
}

		</script>
</body>
</html>


