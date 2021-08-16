<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
set_time_limit(0);
ini_set('memory_limit','-1');
$allowedExts = array("gif", "jpeg", "jpg", "png");

if(isset($_FILES["service_image"])) {
    $file = $_FILES["service_image"];
    if ($file["error"] > 0 || $file["size"] <= 0) {
        // header("HTTP/1.1 401 Unauthorized");
        die("Exception Error : " . $file["error"]);
    }
    $temp = explode("/", $file["type"]);
    $extension = end($temp);
    if (!in_array($extension, $allowedExts)) {
        // header("HTTP/1.1 401 Unauthorized");
        die($extension." format file is not allowed.");
    }
    if (($file["size"]/1024/1024) > 2) {
        // header("HTTP/1.1 401 Unauthorized");
        die("It cannot exceed 2MB.");
    }
} else {
    // header("HTTP/1.1 401 Unauthorized");
    die("no image");
}

require_once $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

$bucket_name = '***BUCKET***';
$access_key = '***ACCESS_KEY***';
$secret_key = '***SECRET_KEY***';

try {
    $client = new S3Client([
        'version' => 'latest',
        'region' => 'ap-northeast-2',
        'credentials' => [
            'key'    => $access_key,
            'secret' => $secret_key,
        ],
        'signature' => 'v4',
        'scheme'  => 'http'
    ]);
    
    $key = sha1($file["tmp_name"].microtime()) . '.' . $extension;
    
    $result = $client->putObject([
        'Bucket' => $bucket_name,
        'Key'    => $key,
        'Body'   => fopen($file["tmp_name"], 'r'),
        'ACL'    => 'public-read',
    ]);
} catch (S3Exception $e) {
    die($e->getMessage() . PHP_EOL);
}

echo $key;