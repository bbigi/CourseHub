<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class App extends BaseConfig
{
    public string $baseURL = 'http://localhost:8080/';

    public array $allowedHostnames = [];

    public string $indexPage = '';

    public string $uriProtocol = 'REQUEST_URI';

    public string $permittedURIChars = 'a-z 0-9~%.:_\-';

    public string $defaultLocale = 'id';

    public bool $negotiateLocale = false;

    public array $supportedLocales = ['id', 'en'];

    public string $appTimezone = 'Asia/Jakarta';

    public string $charset = 'UTF-8';

    public bool $forceGlobalSecureRequests = false;

    public array $proxyIPs = [];

    public bool $CSPEnabled = false;

    public function __construct()
    {
        parent::__construct();

        $baseURL = $this->readEnv('APP_BASE_URL');

        if ($baseURL !== '') {
            $this->baseURL = rtrim($baseURL, '/') . '/';
        }

        $host = parse_url($this->baseURL, PHP_URL_HOST);

        if (is_string($host) && $host !== '') {
            $this->allowedHostnames = [$host];
        }
    }

    private function readEnv(string $key, string $default = ''): string
    {
        $value = getenv($key);

        if ($value === false || $value === '') {
            $value = $_ENV[$key] ?? $_SERVER[$key] ?? $default;
        }

        return is_string($value) ? $value : $default;
    }
}