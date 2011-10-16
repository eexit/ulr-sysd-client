<?php

namespace Icone\Sysd\Soap\Client\Cli;

use Icone\Sysd\Soap\Client\Cli\Command;
use Symfony\Component\Console\Application;
use Zend\Soap\Client as ZClient;

class Client extends Application
{
    public function __construct()
    {
        parent::__construct('SOAP Client application developped by Joris Berthelot (c) 2011', '1.00-DEV');
        
        $this->addCommands(array(
            new Command\Get(),
            new Command\Post(),
            new Command\Search(),
            new Command\MakePdf()
        ));
    }
    
    public static function getWebService($wsdl = 'http://localhost:8080/ulr-sysd/NewWebService?wsdl')
    {
        return new ZClient($wsdl, $options = array(
            'soap_version'  => SOAP_1_2,
            'encoding'      => 'UTF-8'
        ));
    }
}

?>