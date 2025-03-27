<?php
require("vendor/autoload.php");
// $openapi = \OpenApi\Generator::scan(['/application/controllers/']);
// $openapi = \OpenApi\Generator::scan($_SERVER['DOCUMENT_ROOT'].'/application/controllers/');
$openapi = \OpenApi\Generator::scan(['./application/controllers/api/v1']);
header('Content-Type: application/json');
echo $openapi->toJSON();