<?php

class Careerjet_API {
  var $locale = '' ;
  var $version = '3.6';
  var $careerjet_api_content = '';


  function call($fname , $args)
  {
    $url = 'http://public.api.careerjet.net/'.$fname.'?locale_code=ru_RU';

    if (empty($args['affid'])) {
      return (object) array(
        'type' => 'ERROR',
        'error' => "Your Careerjet affiliate ID needs to be supplied. If you don't " .
                   "have one, open a free Careerjet partner account."
      );
    }

    foreach ($args as $key => $value) {
      $url .= '&'. $key . '='. urlencode($value);
    }

    if (empty($_SERVER['REMOTE_ADDR'])) {
      return (object) array(
        'type' => 'ERROR',
        'error' => 'not running within a http server'
      );
    }

    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
      $ip = $_SERVER["HTTP_CF_CONNECTING_IP"];
    } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
      $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      $ip = trim(array_shift(array_values(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']))));
    } else {
      $ip = $_SERVER['REMOTE_ADDR'];
    }

    $url .= '&user_ip=' . $ip;
    $url .= '&user_agent=' . urlencode($_SERVER['HTTP_USER_AGENT']);
    
    // determine current page
    $current_page_url = '';
    if (!empty ($_SERVER["SERVER_NAME"]) && !empty ($_SERVER["REQUEST_URI"])) {
      $current_page_url = 'http';
      if (!empty ($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
        $current_page_url .= "s";
      }
      $current_page_url .= "://";
  
      if (!empty ($_SERVER["SERVER_PORT"]) && $_SERVER["SERVER_PORT"] != "80") {
        $current_page_url .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
      } else {
        $current_page_url .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
      }
    }

    $header = "User-Agent: careerjet-api-client-v" . $this->version . "-php-v" . phpversion();
    if ($current_page_url) {
      $header .= "\nReferer: " . $current_page_url;
    }

    $careerjet_api_context = stream_context_create(array(
      'http' => array('header' => $header)
    ));

    $response = file_get_contents($url, false, $careerjet_api_context);
    return json_decode($response);
  }
  function search($args)
  {
    $result =  $this->call('search' , $args);
    if ($result->type == 'ERROR') {
      trigger_error( $result->error );
    }
    return $result;
  }
}

?>
