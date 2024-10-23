<?php
# اپن شد توسط چنل پامیک منبع بزن بفرست چنلت #
# @PaMicK #
function validateInput($data, $default, $allowed = []) {
    if (isset($_GET[$data])) {
        $input = trim($_GET[$data]);
        if (!empty($allowed) && !in_array($input, $allowed, true)) {
            return $default;
        }
        return $input;
    }
    return $default;
}

$url = 'https://api.ttsmaker.com/v1/create-tts-order';
$headers = [
    'Content-Type: application/json; charset=utf-8'
];
# اپن شد توسط چنل پامیک منبع بزن بفرست چنلت #
# @PaMicK #
$text = validateInput('text', 'test API');
$character = validateInput('character', 'male', ['male', 'female']);

$voice_id = ($character === 'female') ? 410001 : 410002;

$params = [
    'token' => 'ttsmaker_demo_token',
    'text' => $text,
    'voice_id' => $voice_id,
    'audio_format' => 'wav',
    'audio_speed' => 1.0,
    'audio_volume' => 0,
    'text_paragraph_pause_time' => 0
];

$options = [
    'http' => [
        'header' => "Content-Type: application/json; charset=utf-8\r\n",
        'method' => 'POST',
        'content' => json_encode($params),
        'ignore_errors' => true
    ]
];

$context = stream_context_create($options);
$response = file_get_contents($url, false, $context);

if ($response === false) {
    echo 'Error: Request failed';
} else {
    $responseData = json_decode($response, true);
    if (json_last_error() === JSON_ERROR_NONE) {
        echo "<pre>" . json_encode($responseData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "</pre>";
    } else {
        echo 'Error: Invalid JSON response';
    }
}
# اپن شد توسط چنل پامیک منبع بزن بفرست چنلت #
# @PaMicK #
?>
