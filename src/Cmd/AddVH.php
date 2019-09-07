<?php declare(strict_types=1);

namespace AboAdel\VHost\Cmd;

use AboAdel\VHost\FileHandler;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class AddVH extends Command
{
    const TEXT_COLOR = 'cyan';
    const TEXT_BG = 'black';
    const SEP_COLOR = 'yellow';

    use OutputTrait;

    protected static $defaultName = 'xamp-vh:addHost';

    protected function configure() : void
    {
        $this
            ->setDescription('Add new Virtual Host')
            ->setHelp('this command for adding new virtual host')
            ->addOption('server', '-s', InputOption::VALUE_REQUIRED, 'Host name')
            ->addOption('dir', '-d', InputOption::VALUE_OPTIONAL, 'Host Directory')
            ->addOption('admin', '-a', InputOption::VALUE_OPTIONAL, 'Server Admin Email')
            ->addOption('alias', '-l', InputOption::VALUE_OPTIONAL, 'Server Alias')
            ->addOption('error-log', '-e', InputOption::VALUE_OPTIONAL, 'Error Log file Location')
            ->addOption('custom-log', '-c', InputOption::VALUE_OPTIONAL, 'Custom log file Location');
    }

    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ) : void {

        $val = (object)[];
        // server name
        $val->server = $input->getOption('server');
        // server directory
        $val->dir =  '"'.($input->getOption('dir') ?? getcwd()). '"';
        // server admin
        $val->admin = $input->getOption('admin') ?? '';
        // server alias
        $val->alias = $input->getOption('alias') ?? '';
        // error log file location
        $val->errorLog = $input->getOption('error-log') ?? '';
        // custom error log
        $val->customLog = $input->getOption('custom-log') ?? '';
        

        $output->writeln($this->printAllValues($val));

        try {
            // iniate host file handle
            $fh = new FileHandler;

            // include vhosts file in xampp module loader
            $fh->includeVHosts();

            // append new vhost to file
            $fh->addNewHost((array)$val);
        } catch (Exception $e) {
            $output->writeln(
                $this->write('Error: ' . $e->getMessage(), 'white', 'red'),
            );
        } finally {
            $output->writeln($this->write('Existing Application, GoodBuy.', 'green', 'black'));
        }
    }
}

