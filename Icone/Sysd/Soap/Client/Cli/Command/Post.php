<?php

namespace Icone\Sysd\Soap\Client\Cli\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console;

use Icone\Sysd\Soap\Client\Cli\Client;

/**
 * Icone\Sysd\Soap\Client\Cli\Command\Get
 * 
 * @category Icone
 * @package Icone\Sysd
 * @subpackage Soap\Client\Cli\Command
 * @copyright Copyright (c) 2011, Joris Berthelot
 * @author Joris Berthelot <joris.berthelot@gmail.com>
 */
class Post extends Console\Command\Command
{
    /**
     * Command declaration
     */
    protected function configure()
    {
        $this->setName('post')
             ->setDescription('Submits a XML file to the WebService.')
             ->addOption('xml', null, InputOption::VALUE_REQUIRED, 'XML filename');
    }
    
    /**
     * Command business code
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $file = $input->getOption('xml');
        
        if (!is_file($file)) {
            $output->writeln(sprintf('%s<error>Given argument is not a file!</error>%s', PHP_EOL, PHP_EOL));
            exit(1);
        }
        
        if ('.xml' != strtolower(substr($file, strrpos($file, '.')))) {
            $output->writeln(sprintf('%s<error>Given file argument is not a XML file!</error>%s', PHP_EOL, PHP_EOL));
            exit(1);
        }
        
        try {
            $client = Client::getWebService();
            
            $obj = new \stdClass();
            $obj->name = basename($file);
            $obj->data = file_get_contents($file);
            
            $response = $client->depotDocument($obj);
            $output->writeln($response->return);
            $output->writeln('<info>Operation succeed!</info>');
        } catch (\SoapFault $e) {
            $output->writeln(sprintf('%s<error>An error occured!</error>%s', PHP_EOL, PHP_EOL));
            $output->writeln(sprintf('Error message: %s%s', $e->getMessage(), PHP_EOL));
            exit(1);
        }
    }
}
?>