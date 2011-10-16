<?php

namespace Icone\Sysd\Soap\Client\Cli\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console;

use Icone\Sysd\Soap\Client\Cli\Client;

class Get extends Console\Command\Command
{
    protected function configure()
    {
        $this->setName('get')
             ->setDescription('Gets a XML file to the WebService.')
             ->addOption('id', null, InputOption::VALUE_REQUIRED, 'XML file ID')
             ->addOption('out', null, InputOption::VALUE_REQUIRED, 'XML output filename');
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $id = $input->getOption('id');
        $out = $input->getOption('out');
        
        if (!is_numeric($id) || 1 > $id) {
            $output->writeln(sprintf('%s<error>Given XML ID argument is not valid!</error>%s', PHP_EOL, PHP_EOL));
            exit(1);
        }
        
        if (!is_dir(dirname($out))) {
            $output->writeln(sprintf('%s<error>The path "%s" does not exist!</error>%s', PHP_EOL, dirname($out), PHP_EOL));
            exit(1);
        }
        
        /*
            TODO 
        */
        //$ws = Client::getWebService();
        
        if (false) {
            //$output->writeln(sprintf('<error>No XML file is matching %d on the server.</error>', $id));
        }
        
        $output->writeln(sprintf('"%d" matching XML file ID will be saved: %s', $id, $out));
    }
}
?>