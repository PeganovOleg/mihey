<?php
include("config.php");
include("core.php");
if($default_country == 'on')
{
	include("country.php");
}
?>
<!DOCTYPE html>
<html lang="<?php echo $language_code; ?>">
    <head>
    <base href="<?php echo $siteurl; ?>" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $sitedescription; ?> - <?php echo $document_title; ?> - <?php echo _text( get_locale() ); ?>"  />
    <meta name="keywords" content="<?php echo ($document_title); ?>,<?php echo $sitekeywords; ?>" />
    <title><?php echo $document_title; ?><?php if(isset($_REQUEST['page'])): ?> - Page <?php echo $_REQUEST['page']; ?><?php endif; ?> - <?php echo $sitename; ?> - <?php echo _text( get_locale() ); ?></title>
    <?php if ( isset($theme) ): ?>
    <link id="theme_switcher" href="/assets/themes/<?php echo $theme; ?>/bootstrap.min.css" rel="stylesheet">
    <?php else: ?>
	<link href="/assets/themes/default/bootstrap.min.css" rel="preload" as="style" type="text/css" onload="this.rel='stylesheet'"/>
    <?php endif; ?>
    <link href="/assets/css/app.css" rel="stylesheet">
    <!-- FontAwesome icons -->
	<link href="/assets/css/font-awesome.min.css" type="text/css" onload="this.rel='stylesheet'"/>
    <!--[if lt IE 7]>
    <link href="/assets/css/font-awesome-ie7.min.css" rel="stylesheet">
    <![endif]-->
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="//www.google.com/jsapi"></script>
    <script type="text/javascript" src="//gdc.indeed.com/ads/apiresults.js"></script>
    <script type="text/javascript" src="/assets/js/spin.min.js"></script>
    <script type="text/javascript" src="/assets/js/iosOverlay.js"></script>
    <script type="text/javascript" src="/assets/js/jquery.tinysort.min.js"></script>
	
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js" type="text/javascript"></script>
    <![endif]-->
    <script type="text/javascript" src="//gdc.indeed.com/ads/apiresults.js"></script>
                                    
    <!-- Favorite and ios icons -->
    <link rel="shortcut icon" href="/assets/ico/favicon.ico">
    <link rel="apple-touch-icon" href="/assets/ico/icon.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="/assets/ico/icon-72.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="/assets/ico/icon@2x.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="/assets/ico/icon-72@2x.png" />

<style>
.addsize{width:50%}
@media (max-width:700px){.addsize{width:100% !important}}
</style>



</head>
<body data-spy="scroll" data-target=".navbar">

    <nav id="topnav" class="navbar navbar-fixed-top navbar-default" role="navigation">
        <div class="container">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                     <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo $siteurl; ?>"><i class="fa fa-briefcase"></i> <?php echo $sitename; ?></a>
              </div>

              <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="<?php echo get_site_url(array(), 'top'); ?>"><i class="fa fa-home"></i> <?php echo _text('MENU_HOME'); ?></a></li>
                    <li><a href="<?php echo get_site_url(array(), 'search'); ?>"><i class="fa fa-search"></i> <?php echo _text('MENU_SEARCH'); ?></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo _text('MENU_BROWSE'); ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo get_site_url(array(), 'categories'); ?>"><i class="fa fa-th-large"></i> <?php echo _text('MENU_CATEGORIES'); ?></a></li>
                            <li><a href="<?php echo get_site_url(array(), 'locations'); ?>"><i class="fa fa-map-marker"></i> <?php echo _text('MENU_LOCATIONS'); ?></a></li>
                        </ul>
                    </li>
                    <li><a href="#<?php echo _text('JOB_RESULTS'); ?>"><i class="fa fa-briefcase"></i> <?php echo _text('MENU_LATEST'); ?></a></li>
                    <li data-toggle="modal" data-target="#about_modal"><a href="#about"><i class="fa fa-info-sign"></i> <?php echo _text('MENU_ABOUT_US'); ?></a></li>
                    <?php if ( ((isset($language_switcher) && $language_switcher=='on') || !isset($language_switcher)) && $languages = get_languages() ): ?>
                    <li class="dropdown mega-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <?php echo _text('MENU_LANGUAGE'); ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu mega-dropdown-menu row">
                            <?php
                            $cols = 4;
                            $per_col = ceil(count($languages) / 4);
                            $i = 0;
                            $j = 0;
                            usort($languages, create_function('$a, $b', 'return strcmp( _text($a), _text($b));'));
                            ?>
                            <?php foreach ($languages as $lang):
                                @list($tmp, $_country) = explode('-', $lang);
                                $return = base64_encode( get_current_url() );
                                $lang_url = trailingslashit($siteurl) . $_country . '/';
                                if ($i % $per_col == 0){
                                    if ( $i > 0 ){
                                        echo '</ul></li>'; $j--;
                                    }
                                    echo '<li class="col-sm-3"><ul>';
                                    $j++;
                                }
                                $i++;
                            ?>
                            <li><a href="<?php echo $lang_url; ?>"><?php echo _text($lang); ?></a></li>
                            <?php
                            endforeach;
                            if ($j>0){
                                echo '</ul></li>'; $j--;
                            }
                            ?>
                        </ul>
                    </li>
                    <?php endif; ?>
                </ul>
                <?php if (isset($themeswitcher) && $themeswitcher=='on'): ?>
                <ul class="nav navbar-nav navbar-right">
                     
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span id="current_theme"><?php echo isset($theme) && isset($_themes[$theme]) ? $_themes[$theme] : 'Default'; ?></span> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <?php foreach ($_themes as $t => $label): ?>
                            <li<?php if(isset($theme) && $theme==$t) echo ' class="active"'; ?>><a data-toggle="theme" href="<?php echo "#$t"; ?>"><?php echo $label; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                </ul>
                <?php endif; ?>
            </div>
            <!-- /.navbar-collapse -->
        </div>
    </nav>

    <?php if ($home): ?>
    <!-- HEADER -->
    <header id="top">
        <!-- Carousel ================================================== -->
        <div id="myCarousel" class="carousel slide">
                  <!-- Indicators -->
                  <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                    <li data-target="#myCarousel" data-slide-to="3"></li>
                  </ol>
    
                  <div class="carousel-inner">
                    <div class="item active">
<img src="/assets/img/slider1.jpg" width="900" height="252" alt="<?php echo $sitename; ?>" class="img-responsive">

                          <div class="container">
                            <div class="carousel-caption">
                                  <h1><?php echo $sitename; ?></h1>
                                  <p><?php echo $siteslogan; ?></p>
                                  <p><a class="btn btn-large btn-primary" data-target="#myCarousel" data-slide-to="1"><?php echo _text('BTN_LEARN_MORE'); ?></a></p>
                            </div>
                          </div>
                    </div>
                    <div class="item">
<img src="/assets/img/slider2.jpg" alt="<?php echo $slide1_title; ?>" class="img-responsive">
                          <div class="container">
                            <div class="carousel-caption">
                                  <h1><?php echo $slide1_title; ?></h1>
                                  <p><?php echo $slide1_description; ?></p>
                                  <p><a class="btn btn-large btn-primary" data-target="#myCarousel" data-slide-to="2"><?php echo _text('BTN_JOB_AGGREGATOR'); ?></a></p>
                            </div>
                          </div>
                    </div>
                    <div class="item">
<img src="/assets/img/slider3.jpg" alt="<?php echo $slide2_title; ?>" class="img-responsive">
                          <div class="container">
                            <div class="carousel-caption">
                                  <h1><?php echo $slide2_title; ?></h1>
                                  <p><?php echo $slide2_description; ?></p>
                                  <p><a class="btn btn-large btn-primary" data-target="#myCarousel" data-slide-to="3"><?php echo _text('BTN_JOB_AGGREGATOR'); ?></a></p>
                            </div>
                          </div>
                    </div>
                    <div class="item">
<img src="/assets/img/slider4.jpg" alt="<?php echo $slide3_title; ?>" class="img-responsive">
                          <div class="container">
                            <div class="carousel-caption">
                                  <h1><?php echo $slide3_title; ?></h1>
                                  <p><?php echo $slide3_description; ?></p>
                                  <p><a class="btn btn-large btn-primary newsearch" href="<?php echo get_site_url(array(), 'search'); ?>"><?php echo _text('BTN_FIND_YOUR_JOB'); ?></a></p>
                            </div>
                          </div>
                    </div>
                  </div>
                  <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="fa fa-prev"></span></a>
                  <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="fa fa-next"></span></a>
        </div><!-- /.carousel -->
    </header>
    <!-- / HEADER -->
    <?php endif; ?>
    
    <!-- SEARCH -->
    <section id="search">
        <div class="container">
            <div class="row text-center ">
                <h1><i class="fa fa-search"></i> <?php echo _text('HEADING_SEARCH_JOBS'); ?></h1>
                <p class="lead"> <?php echo _text('LEADING_FIND_JOBS_BY_KEYWORD_OR_LOCATION'); ?> </p>
                <!-- search form -->
                <hr>
                <div class="col-sm-12 col-lg-12">
                    <div class="text-center col-sm-12 col-lg-12">

                        <form class="form-inline form-search" role="form" action="" method="get">
                          <div class="form-group">
                            <input type="text" class="form-control input-lg" name="keyword" value="<?php if (isset($q)&&!empty($q)) { $show_categories=false; echo $q;}?>" id="q" placeholder="<?php echo _text('PLACEHOLDER_SEARCH'); ?>">
                          </div>
                          <div class="form-group">
                            <input type="text" class="form-control input-lg" name="job_location" value="<?php if (isset($query_vars['loc'])&&!empty($query_vars['loc'])) { $show_locations=false; echo $query_vars['loc']; }?>" id="loc" placeholder="<?php echo _text('PLACEHOLDER_LOCATION'); ?>">
                          </div>
                          <button type="submit" class="btn btn-info btn-lg"><?php echo _text('SEARCH'); ?></button>
                        </form>
                        <!-- /search form -->
                    </div>

                </div>
                <hr>
            </div>
        </div>

		<p class="text-center"> </p>


        <p class="text-center"><?php echo _text('TEXT_SEARCH_ON'); ?></p>
        
    </section>
    <!-- / SEARCH -->


    <!-- ADS -->
    <div class="container">
        <div class="well well-lg text-center"><?php echo $adsenseads; ?></div>
    </div>
    <!-- / ADS-->

    
    <?php if ( isset($show_categories) && $show_categories == true ): ?>
    <!-- CATEGORIES -->
    <section id="categories">
        <div class="container">
            <div class="row">
                <div class="page-header text-center col-sm-12 col-lg-12">
                    <h2><i class="fa fa-th-large"></i> <?php echo _text('HEADING_CATEGORIES'); ?></h2>
                    <p><?php echo _text('DESCRIPTION_CATEGORIES', $sitename); ?></p>
                </div>
            </div>
            <div class="row multi-columns-row"><?php print_categories( $categories ); ?></div>
            
        </div><!-- / CONTAINER-->
    </section>
     <!-- / CATEGORIES -->
    <?php endif; ?>

    <?php if ( isset($show_locations) && $show_locations == true ): ?>
    <!-- LOCATIONS -->
    <section id="locations">
        <div class="container">
            <div class="row">
                <div class="page-header text-center col-sm-12 col-lg-12">
                    <h2><i class="fa fa-map-marker"></i> <?php echo _text('HEADING_LOCATIONS'); ?></h2>
                    <p><?php echo _text('DESCRIPTION_LOCATIONS'); ?></p>
                </div>
            </div>
            <div class="row multi-columns-row"><?php print_locations( $locations ); ?></div>
        </div>
    </section>
    <!-- / LOCATIONS -->
    <?php endif; ?>




    <!-- ADS -->
    <div class="container">
        <div class="well well-lg text-center"><?php echo $adsenseads; ?></div>
    </div>
    <!-- / ADS-->
    
    <!--  SEARCHRESULTS -->
    <section   id="<?php echo _text('JOB_RESULTS'); ?>" class="results">
        <div class="container addsize" style="horizontal-align:center !important">
            <div class="row">
                <div class="page-header text-center col-sm-12 col-lg-12">
                    <h2><i class="fa fa-briefcase"></i> <?php
                        if ( !empty($q) && empty($query_vars['loc']) ){
                            echo _text('SEARCHRESULT_JOBS_FOR_TODAY_JOB', $q);
                        } else if ( empty($q) && !empty($query_vars['loc']) ){
                            echo _text('SEARCHRESULT_JOBS_FOR_TODAY_LOC', ucfirst($query_vars['loc']) );
                        } else if ( !empty($q) && !empty($query_vars['loc']) ){
                            echo sprintf( _text('SEARCHRESULT_JOBS_FOR_TODAY_ALL'), ucfirst($q), ucfirst($query_vars['loc']) );
                        }
                    ?> </h2>
                    <p><?php
                        $rp = !isset($q) || empty($q) ? ' ' : $q;
                        echo _text('SEARCHRESULT_DESCRIPTION', $rp); ?></p>
                </div>
            </div>


            <!-- CONTENT SIDE-->
    
            <?php
            if ( isset($feedlist) && is_array($feedlist) ){
                $c = 0;
            ?>

                <div class="tabbable" id="myTabs">
                      <ul class="nav nav-tabs">
                        <li class="active"><a id="tabAll" href="#">Результаты поиска</a></li>
                       
                      </ul>
                    <div class="tab-content">
                        <?php foreach($feedlist as $section): ?>
                        <div class="tab-pane active" id="tab<?php echo $c++; ?>"></div>
                        <?php endforeach; $c = 0; ?>
                    </div>
                </div>
                <script type="text/javascript">
                    google.load("feeds", "1");
                    var opts = {
                        lines: 13, // The number of lines to draw
                        length: 11, // The length of each line
                        width: 5, // The line thickness
                        radius: 17, // The radius of the inner circle
                        corners: 1, // Corner roundness (0..1)
                        rotate: 0, // The rotation offset
                        color: '#FFF', // #rgb or #rrggbb
                        speed: 1, // Rounds per second
                        trail: 60, // Afterglow percentage
                        shadow: false, // Whether to render a shadow
                        hwaccel: false, // Whether to use hardware acceleration
                        className: 'spinner', // The CSS class to assign to the spinner
                        zIndex: 2e9, // The z-index (defaults to 2000000000)
                        top: 'auto', // Top position relative to parent in px
                        left: 'auto' // Left position relative to parent in px
                    };
                  

                    var numfeed = <?php echo count($feedlist); ?>;
                <?php
                $paginator = new Paginator();
                $count = count($feedlist);
                foreach ($feedlist as $feed){
                    if ( !isset($feed['api']) || !$feed['api'] ) {
                        
                        echo 'google.setOnLoadCallback(showFeed' . $c . ');';
                        echo 'function showFeed' . $c . '() {
                            var feed' . $c . ' = new google.feeds.Feed("' . $feed['url'] . '");
                            feed' . $c . '.setNumEntries('.$limit_listings.');
                            feed' . $c . '.includeHistoricalEntries();';
                            ?>
                            feed<?php echo $c; ?>.load(function(result) {
                                if (!result.error) {
                                    var i=0;
                                    $.each(result.feed.entries, function(i, entry){
                                        var div = document.createElement("div");
                                        div_innerHTML = '<h3><a href="' + entry.link + '" target="_blank" rel="nofollow">' + entry.title + '</a>' + '</h3>';
                                        var timestamp = new Date(entry.publishedDate).getDate();
                                        div_innerHTML += '<p class="clearfix"><? if( $la_code == "rus"){?><? if($entry['site']){?><span class="label label-info"><?=addslashes($entry['site']);?></span><span style="margin-left:10px"></span><?}else{?><span class="label label-info"><?=$jhsfd[rand(0,21)];?></span><span style="margin-left:10px"></span><?}?><?}?><? if($entry['salary_min']){?><? if( $la_code == "rus"){?><span class="label label-info" style="background:green" ><?="Оплата  ".addslashes($entry['salary_min']); ?><?=" рублей в месяц"; ?></span><?}else{?><span class="label label-info"><?="  ".addslashes($entry['salary_min']); ?><?=" ".addslashes($entry['salary_currency_code']); ?></span><?}}?><? if($entry['salary_min'] OR $entry['site']){?><br><br><?}?><?php echo _text('PUBLISHED_ON'); ?> <span class="realdate">' + entry.publishedDate + '</span></p>';
                                        div_innerHTML += '<p>' + entry.contentSnippet + '</p><hr/>';
                                        div.innerHTML = div_innerHTML;
                                        jQuery(div).appendTo('#tab<?php echo $c; ?>');
                                    });
                                    if (result.feed.entries.length == 0){
                                        <?php
                                            $js_q = '';
                                            if ($q){
                                                $js_q = "\"$q\"";
                                            }
                                        ?>
                                        jQuery('#tab<?php echo $c; ?>').html( '<?php echo sprintf( _text('TEXT_NO_RESULT'), $js_q, $feed['title'] ) ?>' );
                                    }
                                } else {
                                    jQuery('#tab<?php echo $c; ?>').html('<div><a href=\"<?php echo $feed['url']; ?>\"><?php echo $feed['title']; ?></a></div>');
                                }
                                //There has got to be a way to get this to trigger only after completion right? Figure it out.
                                try{
                                    if (jQuery('#tab<?php echo $c; ?> > div').length )
                                        jQuery('#tab<?php echo $c; ?> > div').tsort("span.realdate", {order:'desc'});
                                } catch(e){}
                            });
                            if ( --numfeed == 0 ){
                                overlay.hide();
                            }
                        }
                    <?php
                    } else {
                        $per_page = 25;
                        $pagination = array();
                        if ( !isset($pagination['start_key']) ) {
                            $pagination['start_key'] = 'start';
                        }
                        if ( !isset($pagination['limit_key']) ) {
                            $pagination['limit_key'] = 'limit';
                        }
                        
                        if (isset($_REQUEST['page'])){
                            $pagination['page'] = (int)$_REQUEST['page'];
                            if (!$pagination['page']){
                                $pagination['page'] = 1;
                            }
                        } else if ( !isset($pagination['page']) ) {
                            $pagination['page'] = 1;
                        }
                        
                        if ( isset($feed['url']) ){
                            // var_dump($pagination, $feed['url'], parse_url($feed['url'])); die;
                            $inf = parse_url($feed['url']);
                            $inf_query = array();
                            if (isset($inf['query'])){
                                $tmp = explode('&', $inf['query']);
                                for( $i=0; $i<count($tmp); $i++ ){
                                    $nvp = explode('=', $tmp[$i]);
                                    if (count($nvp)){
                                        $inf_query[$nvp[0]] = !isset($nvp[1]) ? true : $nvp[1];
                                    }
                                }
                            }
                            
                            if ( $inf['host'] == 'api.indeed.com' ){
                                if ( !isset($inf_query['start']) ){
                                    $inf_query['start'] = ($pagination['page']-1)*$per_page;
                                }
                                if ( !isset($inf_query['limit']) ){
                                    $inf_query['limit'] = $per_page;
                                }
                                if ( !isset($inf_query['co']) ){
                                    $indeed_co = '';
                                    $locale = get_locale();
                                    $indeed_co = explode('-', $locale);
                                    if (count($indeed_co)){
                                        $indeed_co = array_pop($indeed_co);
                                    }
                                    $inf_query['co'] = strtolower($indeed_co);;
                                }
                                
                            } else if ( $inf['host'] == 'api.simplyhired.com' ){
                                /*
                                if ( !isset($inf_query['si']) ){
                                    $inf_query['si'] = ($pagination['page']-1)*$per_page;
                                }
                                if ( !isset($inf_query['rpd']) ){
                                    $inf_query['rpd'] = $per_page;
                                }
                                */
                            } else {
                                
                            }
                            
                            // rebuild url
                            $new_query = '';
                            $tmp = array();
                            foreach ($inf_query as $n => $v){
                                $tmp[] = $n . '=' . urlencode($v);
                            }
                            $new_query = implode('&', $tmp);
                            
                            $scheme   = isset($inf['scheme']) ? $inf['scheme'] . '://' : '';
                              $host     = isset($inf['host']) ? $inf['host'] : '';
                              $port     = isset($inf['port']) ? ':' . $inf['port'] : '';
                              $user     = isset($inf['user']) ? $inf['user'] : '';
                              $pass     = isset($inf['pass']) ? ':' . $inf['pass']  : '';
                              $pass     = ($user || $pass) ? "$pass@" : '';
                              $path     = isset($inf['path']) ? $inf['path'] : '';
                              $query    = isset($new_query) ? '?' . $new_query : '';
                              $fragment = isset($inf['fragment']) ? '#' . $inf['fragment'] : '';
  
                            $feed['url'] = "$scheme$user$pass$host$port$path$query$fragment";
                            
                        }
                        
                        
                        if ( is_string($feed['api']) ){
                            if ( preg_match('#careerjet#', $feed['api']) ) {
                                $feed['url'] = array(
                                    'page' => $pagination['page'],
                                    'pagesize' => $per_page
                                );
                            }
                            $items = call_user_func_array($feed['api'], array($feed['url']));
                        } else {
                            $items = get_live_feeds($feed['url']);
                        }
                        
                        if ( count($items) ){
                            
                            foreach ($items as $entry):
                                $att = isset($entry['onmousedown']) ? ' onmousedown="' . $entry['onmousedown'] . '"' : '';
                            ?>
                            try{
                                var div = document.createElement("div");
                                div_innerHTML = '<h3><a href="<?php echo $entry['url']; ?>" rel="nofollow" target="_blank" <?php echo addslashes($att); ?> ><?php echo addslashes($entry['title']); ?></a>' + '</h3>';
                                var timestamp = new Date('<?php echo $entry['date']; ?>').getDate();
                                div_innerHTML += '<p class="clearfix"><? if( $la_code == "rus"){?><? if($entry['site']){?><span class="label label-info"><?=addslashes($entry['site']);?></span><span style="margin-left:10px"></span><?}else{?><span class="label label-info"><?=$jhsfd[rand(0,21)];?></span><span style="margin-left:10px"></span><?}?><?}?><? if($entry['salary_min']){?><? if( $la_code == "rus"){?><span class="label label-info" style="background:green" ><?="Оплата  ".addslashes($entry['salary_min']); ?><?=" рублей в месяц"; ?></span><?}else{?><span class="label label-info"><?="  ".addslashes($entry['salary_min']); ?><?=" ".addslashes($entry['salary_currency_code']); ?></span><?}}?><? if($entry['salary_min'] OR $entry['site']){?><br><br><?}?><?php echo _text('PUBLISHED_ON'); ?> <span class="realdate"><?php echo $entry['date']; ?></span> - <span class="company-name"><?php echo addslashes($entry['company']); ?></span></p>';
                                <?php if (isset($entry['company']) && isset($entry['city']) && isset($entry['state'])): ?>
                                div_innerHTML += '<p class="clearfix"><?php echo addslashes($entry['company']); ?> - <?php echo addslashes($entry['city']); ?>, <?php echo addslashes($entry['state']); ?></p>';
                                <?php endif; ?>
                                div_innerHTML += "<p><?php echo clean_string( $entry['snippet'] ); ?></p>";
div_innerHTML += '<h6><a href="<?php echo $entry['url']; ?>" rel="nofollow" target="_blank" <?php echo addslashes($att); ?> >Перейти к работадателю</a>' + '</h6><hr/>';
                                div.innerHTML = div_innerHTML;
                                jQuery(div).appendTo('#tab<?php echo $c; ?>');
                                
                            } catch(e){
                                console.log && console.log(e);
                            }
                            <?php
                            endforeach;
                        }
                        
                        ?>
                            if ( --numfeed == 0 ){
                                overlay.hide();
                            }
                        <?php
                    }
                    $c++;
                }
                ?>
                </script>
                <?php if ( $paginator->items_total ): ?>
                <div class="text-center">
                <?php $paginator->paginate(); echo $paginator->display_pages(); ?>
                </div>
                <?php endif; ?>
                <div class="row">
                    <div class="col-12 col-lg-12 page-header page-header-custom text-center">
                        <p><a class="btn btn-lg btn-success newsearch" href="<?php echo get_site_url(array(), 'search'); ?>"><i class="fa fa-search"></i> <?php echo _text('START_NEW_SEARCH'); ?></a>    </p>
                    </div>
                </div>
            <?php } ?>
            <!-- /CONTENT SIDE-->
        </div>
        <!-- / CONTAINER-->
    </section>
    <!-- / SEARCHRESULTS -->



    <!-- ADS -->
    <div class="container">
        <div class="well well-lg text-center"><?php echo $adsenseads; ?></div>
    </div>
    <!-- / ADS-->


 
    <!-- FOOTER -->
    <footer id="footer">
        <div class="container">
    
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                    <h4 class="line3 center standart-h4title">
                        <span><?php echo _text('HEADING_NAVIGATION'); ?></span>
                    </h4>
                    <ul class="list-unstyled footer-links">
                        <li><a href="#top"><?php echo _text('MENU_HOME'); ?></a></li>
                        <li><a href="<?php echo get_site_url(array(), 'search'); ?>"><?php echo _text('MENU_SEARCH'); ?></a></li>
                        <li data-toggle="modal" data-target="#about_modal"><a href="#about"><?php echo _text('MENU_ABOUT_US'); ?></a></li>
                        <li data-toggle="modal" data-target="#privacy_modal"><a href="#privacy"><?php echo _text('MENU_PRIVACY'); ?></a></li>
                        <li data-toggle="modal" data-target="#termofuse_modal"><a href="#termofuse"><?php echo _text('MENU_TERM_OF_USE'); ?></a></li>
                    </ul>
                </div>
    
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                    <h4 class="line3 center standart-h4title">
                        <span><?php echo _text('HEADING_JOBSITES_ADDED'); ?></span>
                    </h4>
                    <ul class="list-unstyled footer-links">
                        <?php
                        foreach ($feedlist as $feed){
                            echo '<li><a href="#'.$feed['title'].'" data-toggle="jump2feed">'.$feed['title'].'</a></li>';
                        }
                        ?>
                    </ul>
                </div>
    
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                    <h4 class="line3 center standart-h4title">
                        <span><?php echo _text('HEADING_STAY_IN_TOUCH'); ?></span>
                    </h4>
                    <p><?php echo empty($q) ? _text('TEXT_SOCIAL', ' ') : _text('TEXT_SOCIAL', $q); ?></p>


<!-- Go to www.addthis.com/dashboard to customize your tools -->
<div class="addthis_sharing_toolbox"></div>



                </div>
    
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                    <h4 class="line3 center standart-h4title">
                        <span><?php echo _text('HEADING_OUR_OFFICE'); ?></span>
                    </h4>
                    <address>
                        <strong><?php echo $sitename; ?> </strong><br> <i
                            class="fa fa-map-marker"></i>
                        <?php echo $contact_address_street; ?>
                        <br>
                        <?php echo $contact_address_city; ?>
                        <br> <i class="fa fa-phone-sign"></i>
                        <?php echo $contact_tel; ?>
    
                    </address>
                </div>
    
            </div>
        </div>
    
        <div class="container">
            <hr>
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <p> &copy; 2014 -2018 <?php echo _text('POWERED_BY'); ?> <a class="newsearch" href="<?php echo $siteurl;?>"><?php echo $contact_company_name;?></a></p>
                </div>
            </div>
        </div>
    </footer>
    <!-- / FOOTER -->


    <!-- ABOUT -->
    <div id="about_modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                    <h4 class="modal-title"><?php echo _text('MENU_ABOUT_US'); ?></h4>
                </div>
                <div class="modal-body">
                    <p><?php echo $about_text; ?></p>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button"><?php echo _text('CLOSE'); ?></button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- / ABOUT -->
    
    <!-- PRIVACY -->
    <div id="privacy_modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                    <h4 class="modal-title"><?php echo _text('MENU_PRIVACY'); ?></h4>
                </div>
                <div class="modal-body">
                    <p><?php echo $privacy_text;?></p>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button"><?php echo _text('CLOSE'); ?></button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- / PRIVACY -->
    
    <!-- TERMOFUSE -->
    <div id="termofuse_modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                    <h4 class="modal-title"><?php echo _text('MENU_TERM_OF_USE'); ?></h4>
                </div>
                <div class="modal-body">
                    <p><?php echo $term_of_use_text; ?></p>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button"><?php echo _text('CLOSE'); ?></button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- / TERMOFUSE -->

    
    <!-- Latest compiled and minified JavaScript -->
    <script src="/assets/js/bootstrap.min.js"></script>
    <!-- PAGE CUSTOM SCROLLER -->
    <?php if (isset($smooth_scroll) && $smooth_scroll=='on'): ?>
    <script src="/assets/js/jquery.nicescroll.min.js" type="text/javascript" ></script>
    <script src="/assets/js/jquery.localscroll-1.2.7-min.js" type="text/javascript" ></script>
    <script src="/assets/js/jquery.scrollTo-1.4.6-min.js" type="text/javascript" ></script>
    <?php endif; ?>
    <?php if ( !empty($q) || !empty($query_vars['loc']) ): ?>
    <script type="text/javascript" >if (!window.location.hash) window.location.hash = '#<?php echo _text('JOB_RESULTS'); ?>'; </script>
    <?php endif; ?>
    <script src="/assets/js/app.js" type="text/javascript" ></script>

<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" defer src="//s7.addthis.com/js/300/addthis_widget.js#pubid=<?php echo $addthis;?>"></script>
</body>
</html>