<?

// ����� ������ ��������� ����������

session_start();

require $_SERVER['DOCUMENT_ROOT']."/fb_poster/facebook-php-sdk-v5/src/Facebook/autoload.php";

    // App ID � App Secret  ����������

    $app_id = "1527600314216580";

    $app_secret = "ea6b6502d320446f809374e9bb7691e4";
    
    // ������ �� �������� �������� ����� �����������

    $callback = "http://obyektiv.press/fb_poster/callback.php";
    
    $fb = new Facebook\Facebook([

    'app_id'  => $app_id,

    'app_secret' => $app_secret,

    'default_graph_version' => 'v2.6',

    ]);
    
    $helper = $fb->getRedirectLoginHelper();
    
    // ��� ���������� � ������� ���������� ���������� publish_actions

    // ��� ���������� �� ��������� ����� ��� 3 ��������

    $permissions = ['publish_actions','manage_pages','publish_pages'];

    $loginUrl = $helper->getLoginUrl($callback, $permissions);

    echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
    
?>