<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class ApiKeyFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $expectedKey = (string) env('API_KEY', 'pwl-course-demo-key');
        $providedKey = (string) $request->getHeaderLine('X-API-KEY');

        if ($expectedKey === '' || ! hash_equals($expectedKey, $providedKey)) {
            return service('response')
                ->setStatusCode(401)
                ->setJSON([
                    'status'  => 401,
                    'message' => 'API key tidak valid. Gunakan header X-API-KEY.',
                ]);
        }

        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        return null;
    }
}
