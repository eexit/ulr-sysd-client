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
 */
class MakePdf extends Console\Command\Command
{
    /**
     * Command declaration
     */
    protected function configure()
    {
        $this->setName('makepdf')
             ->setDescription('Generates a PDF file from given XML ID returned by the Webservice.')
             ->addOption('id', null, InputOption::VALUE_REQUIRED, 'XML file ID')
             ->addOption('xsl', null, InputOption::VALUE_REQUIRED, 'XSL filename')
             ->addOption('out', null, InputOption::VALUE_REQUIRED, 'PDF output filename');
    }

    /**
     * Command business code
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $id = $input->getOption('id');
        $xsl = $input->getOption('xsl');
        $out = $input->getOption('out');

        if (!is_numeric($id) || 0 > $id) {
            $output->writeln(sprintf('%s<error>Given XML ID argument is not valid!</error>%s', PHP_EOL, PHP_EOL));
            exit(1);
        }

        if (!is_file($xsl)) {
            $output->writeln(sprintf('%s<error>Given XSL argument is not a file!</error>%s', PHP_EOL, PHP_EOL));
            exit(1);
        }

        if ('.xsl' != strtolower(substr($xsl, strrpos($xsl, '.')))) {
            $output->writeln(sprintf('%s<error>Given file argument is not a XSL file!</error>%s', PHP_EOL, PHP_EOL));
            exit(1);
        }

        if (!is_dir(dirname($out))) {
            $output->writeln(sprintf('%s<error>The path "%s" does not exist!</error>%s', PHP_EOL, dirname($out), PHP_EOL));
            exit(1);
        }

        try {
            $client = Client::getWebService();

            $obj = new \stdClass();
            $obj->id = $id;
            $obj->XSLfo = file_get_contents($xsl);

            $response = $client->generePDF($obj);

            if (is_null($response->return)) {
                $output->writeln(sprintf('%s<error>No XML file is matching ID "%d" on the server.</error>%s', PHP_EOL, $id, PHP_EOL));
            }

            file_put_contents($out, $response->return);
            $output->writeln(sprintf('%s<info>%s was successfully created!</info>%s', PHP_EOL, $out, PHP_EOL));
        } catch (\SoapFault $e) {
            $output->writeln(sprintf('%s<error>An error occured!</error>%s', PHP_EOL, PHP_EOL));
            $output->writeln(sprintf('Error message: %s%s', $e->getMessage(), PHP_EOL));
            exit(1);
        }
    }
}
