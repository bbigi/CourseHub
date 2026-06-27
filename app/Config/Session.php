<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Session\Handlers\BaseHandler;
use CodeIgniter\Session\Handlers\FileHandler;

class Session extends BaseConfig
{
    /**
     * @var class-string<BaseHandler>
     */
    public string $driver = FileHandler::class;

    public string $cookieName = 'ci_session';

    public int $expiration = 7200;

    public string $savePath = WRITEPATH . 'session';

    public bool $matchIP = false;

    public int $timeToUpdate = 300;

    public bool $regenerateDestroy = false;

    public ?string $DBGroup = null;

    public int $lockRetryInterval = 100_000;

    public int $lockMaxRetries = 300;

    public function __construct()
    {
        parent::__construct();

        $driver = $this->readEnv('SESSION_DRIVER');

        if ($driver !== '') {
            $this->driver = $driver;
        }

        $savePath = $this->readEnv('SESSION_SAVE_PATH');

        if ($savePath !== '') {
            $this->savePath = rtrim($savePath, '/\\');
        }

        if (! is_dir($this->savePath)) {
            mkdir($this->savePath, 0777, true);
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