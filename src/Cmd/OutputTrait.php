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
}