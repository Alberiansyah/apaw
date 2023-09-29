<?php
require 'vendor/autoload.php';

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

$text = 'test';
$qrCode = QrCode::create($text)
    ->setSize(300)
    ->setMargin(20);
$writer = new PngWriter;
$result = $writer->write($qrCode);

header("Content-Type: " . $result->getMimeType());

echo $result->getString();
