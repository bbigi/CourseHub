<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * BaseController memuat helper umum yang dipakai seluruh controller aplikasi.
 * Aplikasi ini dibuat untuk final project Pemrograman Web Lanjut:
 * Sistem Manajemen Kursus Online berbasis CodeIgniter 4.
 *
 * @property CLIRequest|IncomingRequest $request
 */
abstract class BaseController extends Controller
{
    protected $helpers = ['form', 'url', 'text'];

    protected $session;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $this->session = service('session');
    }
}
