<?php

if(!($sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP)))
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);

    die("Couldn't create socket: [$errorcode] $errormsg \n");
}

echo "Socket created \n";

if( !socket_bind($sock, "0.0.0.0" , 1731) )
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);

    die("Could not bind socket : [$errorcode] $errormsg \n");
}

echo "Socket bind OK \n";

while(1)
{
    echo "\n Waiting for data ... \n";

    sleep(10);

    $r = socket_recvfrom($sock, $buf, 512, 0, $remote_ip, $remote_port);
    echo "$remote_ip : $remote_port -- " . $buf;

    sleep(2);
}

socket_close($sock);