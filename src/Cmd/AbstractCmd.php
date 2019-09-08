<?php declare(strict_types = 1);

namespace AboAdel\VHost\Cmd;

use Symfony\Component\Console\Command\Command;

abstract class AbstractCmd extends Command{
    const TEXT_COLOR = 'cyan';
    const TEXT_BG = 'black';
    const SEP_COLOR = 'yellow';

    use OutputTrait;
}