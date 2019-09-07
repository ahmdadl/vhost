<?php declare(strict_types = 1);

namespace App;

use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;

class FileHandler{
    const HostDir = 'C:\chromedriver_win32\\';
    const HostFile = 'httpd.conf';
    const VhostDir = 'C:\xampp\apache\conf\extra\\';
    const VhostFile = 'httpd-vhosts.conf';

    /**
     * filesystem instance
     *
     * @var League\Flysystem\Filesystem
     */
    private $fs;

    /**
     * array of lines that will be writen to vhosts file
     *
     * @var Array
     */
    private $lines;

    public function __construct() {}

    



}