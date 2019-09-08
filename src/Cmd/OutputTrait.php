<?php declare(strict_types = 1);

namespace AboAdel\VHost\Cmd;

trait OutputTrait{
    public function write(
        string $text,
        string $color = self::TEXT_COLOR,
        string $bg = self::TEXT_BG
    ) : string {
        return "<fg={$color};bg={$bg}>{$text}</>";
    }

    public function sep(int $num = 60, string $char = '-') : string
    {
        return $this->write(str_repeat($char, $num), self::SEP_COLOR);
    }

    public function tab(int $num = 2) : string
    {
        return $this->write(str_repeat("\t", $num));
    }

    public function printAllValues(object $val) : array
    {
        return [
            $this->write('Creating Virutal Host From this data', 'yellow'),
            $this->sep(40, '='),
            '<bg=' . self::TEXT_BG . ';fg=' . self::TEXT_COLOR . '>',
            $this->sep(),
            'ServerName '. $this->tab() . $val->server,
            $this->sep(),
            'DocumentRoot ' . $this->tab() . $val->dir,
            $this->sep(),
            'ServerAdmin ' . $this->tab() . $val->admin,
            $this->sep(),
            'ServerAlias ' . $this->tab() . $val->alias,
            $this->sep(),
            'ErrorLog ' . $this->tab() . $val->errorLog,
            $this->sep(),
            'CustomLog ' . $this->tab() . $val->customLog,
            $this->sep(),
            '</>',
        ];
    }

    protected function setObjValues(
        string $server,
        string $dir,
        string $admin,
        string $alias,
        string $errLog,
        string $cusErr
    )  : object
    {
        $val = (object)[];
        
        // server name
        $val->server = $server;
        // server directory
        $val->dir =  '"'.($dir). '"';
        // server admin
        $val->admin = $admin;
        // server alias
        $val->alias = $alias;
        // error log file location
        $val->errorLog = '"'.($errLog). '"';
        // custom error log
        $val->customLog = '"'.($cusErr). '"';

        return $val;
    }
}