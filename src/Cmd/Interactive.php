<?php declare(strict_types=1);

namespace AboAdel\VHost\Cmd;

use AboAdel\VHost\FileHandler;
use RuntimeException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class Interactive extends AbstractCmd
{
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
        $dir = getcwd();
        chdir('../');
        $server = str_replace(getcwd().'\\', '', $dir) . '.com';

        $io = new SymfonyStyle($input, $output);

        $io->title('Creating Virutal Host From this data');

        $server = $io->ask('Server Name', $server);

        $dir = $io->ask('Server Directory', $dir, function (string $dir) {
            if (!is_dir($dir)) {
                throw new RuntimeException('Please enter a valid directory');
            }

            return $dir;
        });

        $admin = $io->ask('Server Admin Email', '', function(string $email) {
            if (!empty($email)
            && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new RuntimeException(ucfirst('please enter a valid email'));
            }

            return $email;
        });

        $alias = $io->ask('Server Alias', '');
        $errLog = $io->ask('Error Log File', '');
        $cusLog = $io->ask('Custom Log File', '');
    
        $val = $this->setObjValues(
            $server,
            $dir,
            $admin,
            $alias,
            $errLog,
            $cusLog
        );

        // print all entered values
        $this->printAllValues($val);
    }
}

