<?php declare(strict_types=1);

namespace AboAdel\VHost\Cmd;

use AboAdel\VHost\FileHandler;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class Interactive extends Command
{

    use OutputTrait;

    protected static $defaultName = 'xamp-vh:addHostInteractive';

    protected function configure() : void
    {
        $this
            ->setDescription('Play Interactive Mode')
            ->setHelp('this command for adding new virtual host interactivly');
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
        // $output->writeln($input->getOption('interactive'));
    }
}

