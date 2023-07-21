<?php

/**
 * CertificatePay客户端
 * @param string $route
 * @param array $params
 * @return array|null|string
 */
use Bojian\CertificatePay\Certificate\Pay;

function certificatePayClient(string $route, array $params = [])
{
     $client = new Pay($route, $params);
     return $client->getResult();
}

