<?php declare(strict_types = 1);

namespace App;

use League\Flysystem\Adapter\Local;
use League\Flysystem\FileNotFoundException;
use League\Flysystem\Filesystem;

class FileHandler{
    const HostDir = 'C:\chromedriver_win32\\';
    const HostFile = 'httpd.conf';
    const VhostDir = 'extra\\';
    const VhostFile = 'httpd-vhosts.conf';

    /**
     * filesystem instance
     *
     * @var League\Flysystem\Filesystem
     */
    private $fs;

    /**
     * lines that will be writen to vhosts file
     *
     * @var Array
     */
    private $lines = [];

    public function __construct() {}

    public function unCommentVHosts() : void
    {
        $this->changeDir(self::HostDir);

        // check if host file exists
        if (!$this->fs->has(self::HostFile)) {
            throw new FileNotFoundException(self::HostDir . self::HostFile);
        }
    }

    /**
     * iniate filesystem at hosts directory
     *
     * @param string $dir
     * @return void
     */
    private function changeDir(string $dir) : void
    {
        $this->fs = new Filesystem(new Local($dir, LOCK_UN));
    }


}