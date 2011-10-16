<?php

namespace Icone\Sysd\Soap\Client\Cli\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console;

use Icone\Sysd\Soap\Client\Cli\Client;

class Search extends Console\Command\Command
{
    protected function configure()
    {
        $this->setName('search')
             ->setDescription('Looks for a XML file hosted by the WebService by keyword(s)')
             ->addOption('keywords', null, InputOption::VALUE_REQUIRED, 'Keywords (comma separated)');
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $keywords = $input->getOption('keywords');
        
        /*
            TODO 
        */
        //$ws = Client::getWebService();
        
        $output->writeln('Submitted kws: ' . $keywords);
    }
}
?>