<?
session_start();

require $_SERVER['DOCUMENT_ROOT']."/fb_poster/facebook-php-sdk-v5/src/Facebook/autoload.php";

    // App ID � App Secret  ����������

    $app_id = "1527600314216580";

    $app_secret = "ea6b6502d320446f809374e9bb7691e4";
    
    $fb = new Facebook\Facebook([

    'app_id'  => $app_id,

    'app_secret' => $app_secret,

    'default_graph_version' => 'v2.6',

    ]);
    
    $helper = $fb->getRedirectLoginHelper();
    
    try {

        $accessToken = $helper->getAccessToken();

        } catch(Facebook\Exceptions\FacebookResponseException $e) {

        // When Graph returns an error

            echo 'Graph returned an error: ' . $e->getMessage();

            exit;

} catch(Facebook\Exceptions\FacebookSDKException $e) {

// When validation fails or other local issues

echo 'Facebook SDK returned an error: ' . $e->getMessage();

exit;

}
    if (! isset($accessToken)) {
        if ($helper->getError()) {
        header('HTTP/1.0 401 Unauthorized');
        echo "Error: " . $helper->getError() . "\n";
        echo "Error Code: " . $helper->getErrorCode() . "\n";
        echo "Error Reason: " . $helper->getErrorReason() . "\n";
        echo "Error Description: " . $helper->getErrorDescription() . "\n";
        } else {
            header('HTTP/1.0 400 Bad Request');
            echo 'Bad request';
        }
        exit;
    }  
// Logged in
    echo '<h3>Access Token</h3>';
    var_dump($accessToken->getValue());
    
    // The OAuth 2.0 client handler helps us manage access tokens

    $oAuth2Client = $fb->getOAuth2Client();
    
    // Get the access token metadata from /debug_token

    $tokenMetadata = $oAuth2Client->debugToken($accessToken);

    echo '<h3>Metadata</h3>';

    var_dump($tokenMetadata);
    
    // Validation (these will throw FacebookSDKException's when they fail)

    $tokenMetadata->validateAppId($app_id);

    // If you know the user ID this access token belongs to, you can validate it here

    //$tokenMetadata->validateUserId('123');

    $tokenMetadata->validateExpiration();
    
    if (! $accessToken->isLongLived()) {

    // Exchanges a short-lived access token for a long-lived one

    try {

    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);

    } catch (Facebook\Exceptions\FacebookSDKException $e) {

    echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";

    exit;

}

    echo '<h3>Long-lived</h3>';

    var_dump($accessToken->getValue());

}