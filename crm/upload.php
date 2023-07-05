<?php
define('PASTA_UPLOAD', 'fotos/');

if (isset($_GET['filename']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $cl = (int) $_SERVER['CONTENT_LENGTH'];

    $tmpFile = tempnam(sys_get_temp_dir(), '~upload-');

    $file = fopen($tmpFile, 'w');
    $fh   = fopen('php://input', 'r');
    if ($file && $fh) {
        $data = '';
        while (FALSE === feof($fh)) {
            $data .= fgets($fh, 256);
        }
        fwrite($file, base64_decode($data));
    }

    if ($file) {
        fclose($file);
    }

    if ($fh) {
        fclose($fh);
    }

  
    copy($tmpFile, PASTA_UPLOAD . '/' . $_GET['filename']);
} else {
  
}