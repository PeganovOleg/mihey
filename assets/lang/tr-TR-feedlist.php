<?php
$feedlist = array(
			
		array(
				'title' => 'Indeed',
				'url' => 'http://api.indeed.com/ads/apisearch?publisher='.$indeed_publisher_id.'&q='.space2plus($q).'&l='.space2plus(get_location_nicename(@$query_vars['loc'])).'&userip='.$_SERVER['REMOTE_ADDR'].'&v=2&co=tr&useragent='.$_SERVER['HTTP_USER_AGENT'],
				'folder' => 'Jobs',
				'api' => true
		),
		array(
				'title' => 'CareerJet',
				'url' => 'http://rss.careerjet.com/rss?s='.$q.'&l='.space2plus(get_location_nicename(@$query_vars['loc'])).'&affid='.$careerjet_publisher_id.'',
				'folder' => 'Jobs',
				'api' => 'careerjet_loader'
		)
);
