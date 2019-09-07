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
            'Creating Virtual Host',
            $this->sep(60, '*'),
            '<bg=' . self::TEXT_BG . ';fg=' . self::TEXT_COLOR . '>',
            $this->sep(),
            'Server Name: '. $this->tab() . $val->server,
            $this->sep(),
            'Server Directory: ' . $this->tab(1) . $val->dir,
            $this->sep(),
            'Admin Email: ' . $this->tab() . $val->admin,
            $this->sep(),
            'Server Alias: ' . $this->tab() . $val->alias,
            $this->sep(),
            'Error log: ' . $this->tab() . $val->errorLog,
            $this->sep(),
            'Custom log: ' . $this->tab() . $val->customLog,
            $this->sep(),
            '</>',
        ];
    }
}