<?php declare(strict_types = 1);

namespace AboAdel\VHost;

use Error;
use Exception;
use League\Flysystem\Adapter\Local;
use League\Flysystem\FileNotFoundException;
use League\Flysystem\Filesystem;

class FileHandler{
    const HostDir = 'C:\xampp\apache\conf\\';
    const HostFile = 'httpd.conf';
    const VhostDir = 'extra\\';
    const VhostFile = 'httpd-vhosts.conf';
    const SYSTEM_ETC = 'C:\Windows\System32\drivers\etc\\';
    const ETC_FILE = 'hosts';
    const DEFAULT_IP_ADDRESS = '127.0.0.1';

    /**
     * filesystem instance
     *
     * @var League\Flysystem\Filesystem
     */
    private $fs;

    public function __construct()
    {
        // switch to hosts folder
        chdir(self::HostDir);
    }

    public function includeVHosts() : void
    {
        // check if host file exists
        if (!file_exists(self::HostFile)) {
            throw new Exception(self::HostFile . 'Not Found at: ' . self::HostDir);
        }

        // check if permission is granted to edit sys files
        // before adding any content
        if (!is_writable(self::SYSTEM_ETC.self::ETC_FILE)) {
            throw new Exception('File ' . self::SYSTEM_ETC.self::ETC_FILE . ' is not writeable, try running this application as adminstrator');
        }

        // write contents to host file
        file_put_contents(
            self::HostFile,
            $this->UnCommentIncludeVHosts(),
            LOCK_EX
        );
    }

    public function addNewHost(object $val) : void
    {
        // check if vhosts dir exists
        if (!is_dir(self::VhostDir)) {
            throw new Exception(self::VhostDir . ' Directory not Exists at ' . self::HostDir);
        }

        chdir(self::VhostDir);

        // // check if vhosts file not exists
        // if (!file_exists(self::VhostFile)) {
        //     throw new Error('File: ('. self::VhostFile . ') Not Found, Creating One for you.');

        //     /*! file_put_contents Will Create the File if not exists */ 
        // }

        $arr =$this->handleVhostsData($val);

        // write to file
        file_put_contents(self::VhostFile, implode("\n", $arr), FILE_APPEND);
    }

    public function appendHostToHostsFile(
        string $hostName,
        string $ip = self::DEFAULT_IP_ADDRESS
    ) : void
    {
        chdir(self::SYSTEM_ETC);

        file_put_contents(
            self::ETC_FILE,
            $ip . ' ' . $hostName . "\n",
            FILE_APPEND
        );
    }

    private function UnCommentIncludeVHosts() : array
    {
        $arr = [];

        // get the file contents
        $file = file(self::HostFile);

        foreach ($file as $lineNum => $line) {
            // remove any sapaces
            $line = trim($line);

            // check if our line is commented
            if ($line === '# Include conf/extra/httpd-vhosts.conf'
            || $line === '#Include conf/extra/httpd-vhosts.conf') {
                $line = 'Include conf/extra/httpd-vhosts.conf';
            }

            $arr[] = $line . PHP_EOL;
        }

        return $arr;
    }
    
    private function handleVhostsData(object $val) : array
    {
        $output = [];

        // add vhost tag and all values
        $output[] = '<VirtualHost *:80>';

        if (!empty($val->admin)) {
            $output[] = 'ServerAdmin '. $val->admin;
        }

        $output[] = 'DocumentRoot '. $val->dir;

        $output[] = 'ServerName ' . $val->server;

        if (!empty($val->alias)) {
            $output[] = 'ServerAlias ' . $val->alias;
        }

        if (strlen($val->errorLog) > 4) {
            $output[] = 'ErrorLog ' . $val->errorLog;
        }

        if (strlen($val->customLog) > 4) {
            $output[] = 'CustomLog ' . $val->customLog;
        }

        $output[] = "</VirtualHost>\n";

        return $output;
    }


}