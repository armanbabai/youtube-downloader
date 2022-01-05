<?php
set_time_limit(0);
require('../vendor/autoload.php');

$youtube = new \YouTube\YouTubeDownloader();
$youtube->getBrowser()->setCookieFile('./cookies.txt');
$youtube->getBrowser()->setUserAgent('Mozilla/5.0 (Windows NT 6.3; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0');

$videoId = isset($_GET['v']) ? $_GET['v'] : null;
$urlGet = "https://www.youtube.com/watch?v=$videoId";
try {
    $links = $youtube->getDownloadLinks($urlGet);


    if ($allFormats = $links->getAllFormats()) {

        foreach ($allFormats as $format){
            if ($format->qualityLabel == '720p' && $format->audioQuality != null){
                $url = $format->url;
                break;
            }
        }

    } else {
        echo 'No links found';
    }

    if ($url == false) {
        die("No url provided");
    }

    $youtube = new \YouTube\YouTubeStreamer();
    $youtube->stream($url);


} catch (\YouTube\Exception\YouTubeException $e) {

    send_json([
        'error' => $e->getMessage()
    ]);
}
