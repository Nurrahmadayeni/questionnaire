<?php

require_once('vendor/autoload.php');

return \parinpan\fanjwt\libs\JWTAuth::recv([
    'ssotok' => @$_GET['ssotok'],
    'secured' => true
]);

