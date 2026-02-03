<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class HybridAuth extends BaseConfig
{
    public array $providers = [
        'Google' => [
            'enabled' => true,
            'keys' => [
                'key'    => 'YOUR_GOOGLE_CLIENT_ID',
                'secret' => 'YOUR_GOOGLE_CLIENT_SECRET',
            ],
            'scope' => 'email profile',
        ],
        'GitHub' => [
            'enabled' => true,
            'keys' => [
                'key'    => 'YOUR_GITHUB_CLIENT_ID',
                'secret' => 'YOUR_GITHUB_CLIENT_SECRET',
            ],
            'scope' => 'user:email',
        ],
    ];

    public string $callback = 'auth/callback';
}