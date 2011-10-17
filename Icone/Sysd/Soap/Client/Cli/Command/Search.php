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
            
            $obj = new \stdClass();
            $obj->motsCle = $keywords;
            
            $response = $client->rechercheDocument($obj);            
            $results = trim($response->return, '[]');
            
            if (empty($results)) {
                $output->writeln(sprintf('%s<error>No results found for keywords: "%s"</error>%s', PHP_EOL, $keywords, PHP_EOL));
                exit(1);
            }
            
            $results = explode(',', $results);
            $output->writeln(sprintf('%s%d result(s) found for keywords "%s"%s', PHP_EOL, count($results), $keywords, PHP_EOL));
            
            foreach ($results as $result) {
                $output->writeln(sprintf('%s', trim($result)));
            }
            
            $output->writeln(sprintf('%s<info>To pull a document, use "client get --id=DOC_ID --out=doc.xml".</info>%s', PHP_EOL, PHP_EOL));
            
        } catch (\SoapFault $e) {
            $output->writeln(sprintf('%s<error>An error occured!</error>%s', PHP_EOL, PHP_EOL));
            $output->writeln(sprintf('Error message: %s%s', $e->getMessage(), PHP_EOL));
            exit(1);
        }
    }
}
?>