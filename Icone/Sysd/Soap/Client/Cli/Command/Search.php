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
class Search extends Console\Command\Command
{
    /**
     * Command declaration
     */
    protected function configure()
    {
        $this->setName('search')
             ->setDescription('Looks for a XML file hosted by the WebService by keyword(s)')
             ->addOption('keywords', null, InputOption::VALUE_REQUIRED, 'Keywords (comma separated)');
    }
    
    /**
     * Command business code
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $keywords = $input->getOption('keywords');
        
        try {
            $client = Client::getWebService();
            
            /*
            $obj = new \stdClass();
            $obj->id = $id;
            $obj->XSLfo = file_get_contents($xsl);
            
            $response = $client->generePDF($obj);
            if (is_null($response->return)) {
                $output->writeln(sprintf('%s<error>No XML file is matching ID "%d" on the server.</error>%s', PHP_EOL, $id, PHP_EOL));
            }
            
            file_put_contents($out, $response->return);
            $output->writeln(sprintf('%s<info>%s was successfully created!</info>%s', PHP_EOL, $out, PHP_EOL));
            */
        } catch (\SoapFault $e) {
            $output->writeln(sprintf('%s<error>An error occured!</error>%s', PHP_EOL, PHP_EOL));
            $output->writeln(sprintf('Error message: %s%s', $e->getMessage(), PHP_EOL));
            exit(1);
        }
    }
}
?>