<?php
  declare(strict_types=1);


  namespace Src\TestConsoleCommand;


  use Src\Console\Command\Base\BaseCommand;
  use Symfony\Component\Console\Input\InputInterface;
  use Symfony\Component\Console\Output\OutputInterface;

  /**
   * @crontab * * * * *
   */
  class TestConsoleCommand extends BaseCommand
  {

    public function execute(InputInterface $input, OutputInterface $output) : int
    {
      $output->writeln('Hello! ' . time());

      return 0;
    }

  }