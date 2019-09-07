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
        // server name
        $server = $input->getOption('server');
        // server directory
        $dir = $input->getOption('dir') ?? getcwd();
        // server admin
        $admin = $input->getOption('admin') ?? '';
        // server alias
        $alias = $input->getOption('alias') ?? '';
        // error log file location
        $errorLog = $input->getOption('error-log') ?? '';
        // custom error log
        $customLog= $input->getOption('custom-log') ?? '';

        $output->writeln([
            'Creating Virtual Host',
            $this->sep(60, '*'),
            '<bg=' . self::TEXT_BG . ';fg=' . self::TEXT_COLOR . '>',
            $this->sep(),
            'Server Name: '. $this->tab() . $server,
            $this->sep(),
            'Server Directory: ' . $this->tab(1) . $dir,
            $this->sep(),
            'Admin Email: ' . $this->tab() . $admin,
            $this->sep(),
            'Server Alias: ' . $this->tab() . $alias,
            $this->sep(),
            'Error log: ' . $this->tab() . $errorLog,
            $this->sep(),
            'Custom log: ' . $this->tab() . $customLog,
            $this->sep(),
            '</>',
        ]);
    }
}

