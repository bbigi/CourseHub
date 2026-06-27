<?php

namespace Config;

use CodeIgniter\Database\Config;

class Database extends Config
{
    public string $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;

    public string $defaultGroup = 'default';

    public array $default = [
        'DSN'          => '',
        'hostname'     => 'localhost',
        'username'     => '',
        'password'     => '',
        'database'     => '',
        'DBDriver'     => 'MySQLi',
        'DBPrefix'     => '',
        'pConnect'     => false,
        'DBDebug'      => false,
        'charset'      => 'utf8mb4',
        'DBCollat'     => 'utf8mb4_general_ci',
        'swapPre'      => '',
        'encrypt'      => false,
        'compress'     => false,
        'strictOn'     => false,
        'failover'     => [],
        'port'         => 3306,
        'numberNative' => false,
        'foundRows'    => false,
        'dateFormat'   => [
            'date'     => 'Y-m-d',
            'datetime' => 'Y-m-d H:i:s',
            'time'     => 'H:i:s',
        ],
    ];

    public array $tests = [
        'DSN'         => '',
        'hostname'    => '127.0.0.1',
        'username'    => '',
        'password'    => '',
        'database'    => ':memory:',
        'DBDriver'    => 'SQLite3',
        'DBPrefix'    => 'db_',
        'pConnect'    => false,
        'DBDebug'     => true,
        'charset'     => 'utf8',
        'DBCollat'    => '',
        'swapPre'     => '',
        'encrypt'     => false,
        'compress'    => false,
        'strictOn'    => true,
        'failover'    => [],
        'port'        => 3306,
        'foreignKeys' => true,
        'busyTimeout' => 1000,
        'synchronous' => null,
        'dateFormat'  => [
            'date'     => 'Y-m-d',
            'datetime' => 'Y-m-d H:i:s',
            'time'     => 'H:i:s',
        ],
    ];

    public function __construct()
    {
        parent::__construct();

        $this->default['hostname'] = $this->readEnv('DB_HOST', 'localhost');
        $this->default['username'] = $this->readEnv('DB_USER', '');
        $this->default['password'] = $this->readEnv('DB_PASS', '');
        $this->default['database'] = $this->readEnv('DB_NAME', '');
        $this->default['DBDriver'] = $this->readEnv('DB_DRIVER', 'MySQLi');
        $this->default['DBPrefix'] = $this->readEnv('DB_PREFIX', '');

        $port = $this->readEnv('DB_PORT', '3306');
        $this->default['port'] = is_numeric($port) ? (int) $port : 3306;

        $debug = strtolower($this->readEnv('CI_ENVIRONMENT', 'production'));
        $this->default['DBDebug'] = $debug === 'development';

        $ssl = strtolower($this->readEnv('DB_SSL', 'false'));

        if (in_array($ssl, ['true', '1', 'yes'], true)) {
            $this->default['encrypt'] = [
                'ssl_verify' => false,
            ];
        }

        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
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