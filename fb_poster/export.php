<?

require $_SERVER['DOCUMENT_ROOT']."/fb_poster/facebook-php-sdk-v5/src/Facebook/autoload.php";

require 'config.php';



class fbExport
{
     public function wallPost($fb_app_id, $fb_app_secret, $fb_page_id, $fbToken, $link, $message)
     {
          $fb = new Facebook\Facebook([

            'app_id'  => $fb_app_id,

            'app_secret' => $fb_app_secret,

            'default_graph_version' => 'v2.6',
    ]);
        // описание параметров есть в документации

        $linkData = [

            'link' => $link,

            'message' => $message,

            /*'caption' => 'Captoin of post',

            'description' => "Description of post" */
            ];
            try {

                // Returns a `Facebook\FacebookResponse` object

                $response = $fb->post("/{$fb_page_id}/feed", $linkData, $fbToken);

                } catch(Facebook\Exceptions\FacebookResponseException $e) {

                echo 'Graph returned an error: ' . $e->getMessage();

                exit;

                } catch(Facebook\Exceptions\FacebookSDKException $e) {

                echo 'Facebook SDK returned an error: ' . $e->getMessage();

                exit;

}  
        $graphNode = $response->getGraphNode();
    
        return 'Posted with id: ' . $graphNode['id'];
     } 
     
     public function wallPostDelay ($fb_app_id, $fb_app_secret, $fb_page_id, $fbToken, $fbCreateTime, $link, $message)
     {
          $fb = new Facebook\Facebook([

            'app_id'  => $fb_app_id,

            'app_secret' => $fb_app_secret,

            'default_graph_version' => 'v2.6',
    ]);
        // описание параметров есть в документации

        $linkData = [

            'link' => $link,

            'message' => $message,

            'created_time' => $fbCreateTime,
            
            //'is_published' => false
            
            ];
            try {

                // Returns a `Facebook\FacebookResponse` object

                $response = $fb->post("/{$fb_page_id}/feed", $linkData, $fbToken);

                } catch(Facebook\Exceptions\FacebookResponseException $e) {

                echo 'Graph returned an error: ' . $e->getMessage();

                exit;

                } catch(Facebook\Exceptions\FacebookSDKException $e) {

                echo 'Facebook SDK returned an error: ' . $e->getMessage();

                exit;

}  
        $graphNode = $response->getGraphNode();
    
        return 'Deferred with id: ' . print_r($response)/*$graphNode['id']*/;
     }
       
}
    ?>