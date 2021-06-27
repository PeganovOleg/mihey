<?php
$feedlist = array(
			
		array(
				'title' => 'Indeed',
				'url' => 'http://api.indeed.com/ads/apisearch?publisher='.$indeed_publisher_id.'&q='.space2plus($q).'&l='.space2plus(get_location_nicename(@$query_vars['loc'])).'&userip='.$_SERVER['REMOTE_ADDR'].'&v=2&useragent='.$_SERVER['HTTP_USER_AGENT'],
				'folder' => 'Jobs',
				'api' => true
		),
		array(
				'title' => 'Simplyhired',
				'url' => 'http://api.simplyhired.com/a/jobs-api/xml-v2/q-'.space2plus($q).'/l-'.space2plus(get_location_nicename(@$query_vars['loc'])).'?pshid='.$simpleyhired_publisher_id.'&ssty=3&cflg=r&clip='.$_SERVER['REMOTE_ADDR'],
				'folder' => 'Jobs',
				'api' => 'jobamatic_loader'
		),
		array(
				'title' => 'CareerJet',
				'url' => 'http://rss.careerjet.com/rss?s='.$q.'&l='.space2plus(get_location_nicename(@$query_vars['loc'])).'&affid='.$careerjet_publisher_id.'',
				'folder' => 'Jobs',
				'api' => 'careerjet_loader'
		),
		array(
				'title' => 'CareerBuilder',
				'url' => 'http://rtq.careerbuilder.com/RTQ/rss20.aspx?RSSID=RSS_PD&city=atlanta&state=GA&country=US&kw='.$q.'',
				'folder' => 'Jobs',
		),
		array(
				'title' => 'Monster',
				'url' => 'http://rss.jobsearch.monster.com/rssquery.ashx?brd=1&q='.$q.'&cy=us&where=&where= OR&rad=20rad_units=miles&baseurl=jobview.monster.com',
				'folder' => 'Jobs',
		)
);