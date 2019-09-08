<?php declare(strict_types = 1);

namespace AboAdel\VHost\Cmd;

use AboAdel\VHost\FileHandler;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;

abstract class AbstractCmd extends Command{
    const TEXT_COLOR = 'cyan';
    const TEXT_BG = 'black';
    const SEP_COLOR = 'yellow';

    use OutputTrait;

    protected function updateFile(
        object $val,
        OutputInterface $output
    ) : void
    {
        // print all values
        $output->writeln($this->printAllValues($val));

        
        try {

            // iniate host file handle
            $fh = new FileHandler;

            // include vhosts file in xampp module loader
            $fh->includeVHosts();

            // append new vhost to file
            $fh->addNewHost($val);

            // append new host to hosts file
            $fh->appendHostToHostsFile($val->server);
        } catch (Exception $e) {
            $output->writeln(
                $this->write('Error: ' . $e->getMessage(), 'white', 'red'),
            );
        } finally {
            $output->writeln($this->write('Existing Application, GoodBuy.', 'green', 'black'));
        }
    }
}