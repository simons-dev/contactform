<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use App\Repository\ContactRepository;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;


#[AsCommand(
    name: 'app:export-requests',
    description: 'Exports all contact requests.',
    help: 'This Command exports all your contact requests from your database to a csv file',
)]
class ExportRequestsCommand extends Command
{
    private $contactRepository;
    private $serializer;

    public function __construct(ContactRepository $contactRepository, NormalizerInterface $serializer)
    {
        parent::__construct();
        $this->contactRepository = $contactRepository;
        $this->serializer = $serializer;
    }

    public function __invoke(OutputInterface $output): int
    {
        $contactRequests = $this->contactRepository->findAll();

        $contactFile = fopen('requests.csv', 'w');
        foreach($contactRequests as $request){
            $requestArray = $this->serializer->normalize($request, 'json');
            fputcsv($contactFile, $requestArray);
        }
        fclose($contactFile);

        $output->writeln([
            'Writing Requests to CSV',  
        ]);
        
        return Command::SUCCESS;
    }
}
