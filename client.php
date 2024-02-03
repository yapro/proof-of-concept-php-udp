<?php

// все настройки и функции как в реализации jaeger client под php

function handleSocketError($socket, $msg)
{
    $errorCode = socket_last_error($socket);
    $errorMsg = socket_strerror($errorCode);

    var_dump(sprintf('%s: [code - %d] %s', $msg, $errorCode, $errorMsg));
}

try {
    $socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
    if ($socket === false) {
        handleSocketError($socket, 'socket_create failed');
    }

    $ok = socket_connect($socket, 'localhost', 1731);
    if ($ok === false) {
        handleSocketError($socket, 'socket_connect failed');
    }

    $ok = socket_write($socket, 'test test');
    if ($ok === false) {
        handleSocketError($socket, "socket_write failed");
    }
} catch (Throwable $exception) {
    var_dump($exception);
}