<?php

require('../vendor/autoload.php');

$url = isset($_GET['url']) ? $_GET['url'] : null;

function send_json($data)
{
    header('Content-Type: application/json');
    echo json_encode($data, JSON_PRETTY_PRINT);
    exit;
}

if (!$url) {
    send_json([
        'error' => 'No URL provided!'
    ]);
}

$youtube = new \YouTube\YouTubeDownloader();
$youtube->getBrowser()->setCookieFile('./cookies.txt');
$youtube->getBrowser()->setUserAgent('Mozilla/5.0 (Windows NT 6.3; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0');
try {
    $links = $youtube->getDownloadLinks($url);

    send_json([
        'links' => [$links]
    ]);

//    if ($allFormats = $links->getAllFormats()) {
//
//        foreach ($allFormats as $format){
//            if ($format->qualityLabel == '720p' && $format->audioQuality != null){
//                $url = $format->url;
//                break;
//            }
//        }
//
//    } else {
//        echo 'No links found';
//    }
//
//
//    if ($url) {
//        send_json([
//            'links' => [$url]
//        ]);
//    } else {
//        send_json(['error' => 'No links found']);
//    }

} catch (\YouTube\Exception\YouTubeException $e) {

    send_json([
        'error' => $e->getMessage()
    ]);
}
