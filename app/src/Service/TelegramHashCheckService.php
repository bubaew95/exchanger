<?php

namespace App\Service;

class TelegramHashCheckService
{
    public function isTelegramData(string $botName, array $query): bool
    {
        $queryHash = $query['hash'];
        unset($query['hash']);
        ksort($query);

        $queryString = urldecode(http_build_query($query, "", "\n"));
        $secretKey = hash('sha256', $botName, true);
        $hash = hash_hmac('sha256', $queryString, $secretKey);

        return strcmp($hash, $queryHash) === 0;
    }
}