<?php
//Google reCAPTCHA configuration

define('6Ldt07AsAAAAADvf8TsB5wxwsdu915Rqhke3_1yT', '10043456789-abc123def456ghi789jkl012mno345pqrstu');
define('6Ldt07AsAAAAAC7-oAkuEzKwhdBx2Ue2IGMQKYnk', '10043456789-abc123def456ghi789jkl012mno345pqrstu');

//Function to verify reCAPTCHA response
function verifyRecaptcha($response) {
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = [
        'secret' => RECAPTCHA_SECRET_KEY,
        'response' => $response
    ];

    $options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data)
        ]
    ];
    
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    if ($result === false) {
        return false;
    }

    $result = json_decode($result, true);
    return $result['success'] ?? false;
}
?>