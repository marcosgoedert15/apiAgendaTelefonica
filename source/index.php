<?php
$method = strtolower($_SERVER['REQUEST_METHOD']);
require 'services.php';

try {
    echo json_encode(call_user_func([new Services, $method], $_REQUEST));
} catch (\Throwable $e) {
    echo json_encode($e);
}