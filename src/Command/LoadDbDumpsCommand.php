<?php

namespace App\Command;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpKernel\KernelInterface;

#[AsCommand(name: 'oneshot:load-dumps')]
class LoadDbDumpsCommand extends Command
{
    private EntityManagerInterface $em;
    private KernelInterface $kernel;

    protected static $defaultDescription = 'Load my DB dumps (/migration/DB/dev/*).';

    public function __construct(EntityManagerInterface $em, KernelInterface $kernel)
    {
        $this->em = $em;
        $this->kernel = $kernel;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $files = glob($this->kernel->getProjectDir() . '/migrations/DB/dev/*.sql');

        foreach ($files as $file) {
            $handle = fopen($file, 'r');

            while (($line = fgets($handle)) !== false) {
                $this->em->getConnection()->executeStatement($line);
            }

            fclose($handle);
        }

        return Command::SUCCESS;
    }
}
