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

try {
//    $links = $youtube->getDownloadLinks($url);

//    $best = $links->getFirstCombinedFormat();
    $best = 'https://rr4---sn-5hnedn7l.googlevideo.com/videoplayback?expire=1641418536&ei=x7rVYZ_mO966x_APtp2ViAw&ip=46.137.15.86&id=o-AB-X5zf-znwmn077oWrGL4hZcoa5ccjUaSna7ajwWux0&itag=22&source=youtube&requiressl=yes&mh=Bz&mm=31%2C29&mn=sn-5hnedn7l%2Csn-5hne6nzk&ms=au%2Crdu&mv=m&mvi=4&pl=24&gcr=nl&initcwndbps=245000&vprv=1&mime=video%2Fmp4&ns=QYljhjIhF87SfkVYjsaWvVYG&cnr=14&ratebypass=yes&dur=2866.108&lmt=1613329499548306&mt=1641396537&fvip=4&fexp=24001373%2C24007246&c=WEB&txp=5535432&n=tR_vRwRjloCvYcWL&sparams=expire%2Cei%2Cip%2Cid%2Citag%2Csource%2Crequiressl%2Cgcr%2Cvprv%2Cmime%2Cns%2Ccnr%2Cratebypass%2Cdur%2Clmt&sig=AOq0QJ8wRAIgTARQaDUf47rkF6OPFWTqi67naYiG-gLPLkOm7VWgg3cCIDVLaR3Caq7yrS5W9pQDzVsQTHI-KGwho7phejjylxgk&lsparams=mh%2Cmm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpl%2Cinitcwndbps&lsig=AG3C_xAwRQIhAM9gXnq9LDoQAT_nFOKn5_tZE1WSwXpEQ8NhzNWHjovGAiA7MEUeGswGY4zXbkYDbgINmX-bK8Nk3dE-uargqh1iVw%3D%3D';

    if ($best) {
        send_json([
            'links' => [$best]
        ]);
    } else {
        send_json(['error' => 'No links found']);
    }

} catch (\YouTube\Exception\YouTubeException $e) {

    send_json([
        'error' => $e->getMessage()
    ]);
}
