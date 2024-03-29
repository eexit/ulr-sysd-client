<?php

namespace Icone\Sysd\Soap\Client\Cli;

use Icone\Sysd\Soap\Client\Cli\Command;
use Symfony\Component\Console\Application;
use Zend\Soap\Client as ZClient;

/**
 * Icone\Sysd\Soap\Client\Cli\Client
 *
 * @category Icone
 * @package Icone\Sysd
 * @subpackage Soap\Client\Cli
 * @copyright Copyright (c) 2011, Joris Berthelot
 */
class Client extends Application
{
    /**
     * Class constructor
     */
    public function __construct()
    {
        parent::__construct('PHP-CLI SOAP Client application developped by Joris Berthelot (c) 2011', '1.00');
        $this->setCatchExceptions(false);

        // Declares application commands
        $this->addCommands(array(
            new Command\Get(),
            new Command\Post(),
            new Command\Search(),
            new Command\MakePdf()
        ));
    }

    /**
     * WebService provider
     */
    public static function getWebService($wsdl = 'http://localhost:8080/DocumentManager?wsdl')
    {
        return new ZClient($wsdl, $options = array(
            'soap_version'  => SOAP_1_1,
            'encoding'      => 'UTF-8'
        ));
    }
}
