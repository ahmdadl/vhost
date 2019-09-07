<?php declare(strict_types=1);

namespace AboAdel\VHost\Cmd;

use AboAdel\VHost\FileHandler;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class AddVH extends Command
{
    protected static $defaultName = 'xamp-vh:addHost';

    protected function configure() : void
    {
        $this
            ->setDescription('Add new Virtual Host')
            ->setHelp('this command for adding new virtual host')
            ->addOption('server', '-s', InputOption::VALUE_REQUIRED, 'Host name')
            ->addOption('dir', '-d', InputOption::VALUE_OPTIONAL, 'Host Directory')
            ->addOption('admin', '-a', InputOption::VALUE_OPTIONAL)
            ->addOption('alias', '-as', InputOption::VALUE_OPTIONAL)
            ->addOption('error-log', '-e', InputOption::VALUE_OPTIONAL)
            ->addOption('custom-log', 'cl', InputOption::VALUE_OPTIONAL);
    }

    

    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ) : void {
        $output->writeln([
            'User Creator',
            '============',
            '',
        ]);
        $output->writeln($input->getOption('server'));
    }
}

