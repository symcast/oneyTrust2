<?php

// src/Command/CreateUserCommand.php
namespace App\Command;

use App\Service\AddressService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DraftCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:draft';


    /** @var AddressService */
    private $addressService;


    public function __construct(AddressService $addressService)
    {
        parent::__construct();

        $this->addressService = $addressService;
    }


    protected function configure()
    {
        // ...
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $adresse = "20 Rue des Jardins, 92600 Asnières-sur-Seine";

        $array = $this->addressService->distance(
            '48.620400',
            '2.426950',
            '48.912010',
            '2.291900',
            "K"
        );

        dd(
            $array
        );

        echo  PHP_EOL;

        return 0;
    }
}
