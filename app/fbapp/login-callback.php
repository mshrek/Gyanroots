<?php
session_start();
require_once __DIR__ . '/src/Facebook/autoload.php';

$fb = new Facebook\Facebook([
  'app_id' => '1080349038652621',
  'app_secret' => '0e71c3997bd893dbcca5dd68596cd02e',
  'default_graph_version' => 'v2.5'
]);

$helper = $fb->getJavaScriptHelper();

try {
  $accessToken = $helper->getAccessToken();
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
}

if (isset($accessToken)) {
   $fb->setDefaultAccessToken($accessToken);

  try {
  
    $requestProfile = $fb->get("/me?fields=id,name,first_name,last_name,email,picture");
    $profile = $requestProfile->getGraphNode()->asArray();
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
  }
    $_SESSION['fblogin'] = $profile['id'];
    $_SESSION['name'] = $profile['name'];
    $_SESSION['firstname'] = $profile['first_name'];
    $_SESSION['lastname'] = $profile['last_name'];
    $_SESSION['email'] = $profile['email'];
    $_SESSION['image_url']='http://graph.facebook.com/'.$profile['id'].'/picture?type=small';
    //$_SESSION['image_url'] = $profile['picture']['data']['url'];
  header('location: ../../php/Landingpage.php');
  exit;
} else {
    echo "Unauthorized access!!!";
    exit;
}
