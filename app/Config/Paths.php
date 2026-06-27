<?php

namespace Config;

/**
 * Paths
 *
 * Holds the paths that are used by the system to
 * locate the main directories, app, system, etc.
 *
 * All paths are relative to the project's root folder.
 */
class Paths
{
    /**
     * ---------------------------------------------------------------
     * SYSTEM FOLDER NAME
     * ---------------------------------------------------------------
     */
    public string $systemDirectory = __DIR__ . '/../../system';

    /**
     * ---------------------------------------------------------------
     * APPLICATION FOLDER NAME
     * ---------------------------------------------------------------
     */
    public string $appDirectory = __DIR__ . '/..';

    /**
     * ---------------------------------------------------------------
     * WRITABLE DIRECTORY NAME
     * ---------------------------------------------------------------
     *
     * Default lokal tetap memakai folder writable.
     * Saat deploy ke Vercel, path bisa diganti lewat env:
     * WRITABLE_PATH=/tmp/coursehub-writable
     */
    public string $writableDirectory = __DIR__ . '/../../writable';

    /**
     * ---------------------------------------------------------------
     * TESTS DIRECTORY NAME
     * ---------------------------------------------------------------
     */
    public string $testsDirectory = __DIR__ . '/../../tests';

    /**
     * ---------------------------------------------------------------
     * VIEW DIRECTORY NAME
     * ---------------------------------------------------------------
     */
    public string $viewDirectory = __DIR__ . '/../Views';

    /**
     * ---------------------------------------------------------------
     * ENVIRONMENT DIRECTORY NAME
     * ---------------------------------------------------------------
     */
    public string $envDirectory = __DIR__ . '/../../';

    /**
     * Override writable path for serverless environment like Vercel.
     */
    public function __construct()
    {
        $writablePath = getenv('WRITABLE_PATH');

        if (is_string($writablePath) && $writablePath !== '') {
            $this->writableDirectory = rtrim($writablePath, '/\\');
        }
    }
}