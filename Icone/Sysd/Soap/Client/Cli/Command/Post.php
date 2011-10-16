<?php

namespace Icone\Sysd\Soap\Client\Cli\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console;

use Icone\Sysd\Soap\Client\Cli\Client;

class Post extends Console\Command\Command
{
    protected function configure()
    {
        $this->setName('post')
             ->setDescription('Submits a XML file to the WebService.')
             ->addOption('xml', null, InputOption::VALUE_REQUIRED, 'XML filename');
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $file = $input->getArgument('xml');
        if (!is_file($file)) {
            $output->writeln(sprintf('%s<error>Given argument is not a file!</error>%s', PHP_EOL, PHP_EOL));
            exit(1);
        }
        
        if ('.xml' != strtolower(substr($file, strrpos($file, '.')))) {
            $output->writeln(sprintf('%s<error>Given file argument is not a XML file!</error>%s', PHP_EOL, PHP_EOL));
            exit(1);
        }
        
        /*
            TODO 
        */
        //$ws = Client::getWebService();
        //$ws->depot(file_get_contents($file));
        
        
        $output->writeln('<green>Operation succeed!</green>');
    }
}
?>