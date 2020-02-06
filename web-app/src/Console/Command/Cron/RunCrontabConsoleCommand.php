<?
  declare(strict_types=1);


  namespace Src\Console\Command\Cron;


  use Cron\CronExpression;
  use DocBlockReader\Reader;
  use Src\Console\Command\Base\BaseCommand;
  use Symfony\Component\Console\Application;
  use Symfony\Component\Console\Input\InputInterface;
  use Symfony\Component\Console\Output\OutputInterface;

  class RunCrontabConsoleCommand extends BaseCommand
  {

    /**
     * @throws \Exception
     */
    public function execute(InputInterface $input, OutputInterface $output) : int
    {
      $application = $this->getApplication();
      assert($application instanceof Application);
      foreach ($application->all() as $consoleCommand) {
        $reader = new Reader(get_class($consoleCommand));
        $crontabAnnotations = (array) $reader->getParameter('crontab');
        foreach ($crontabAnnotations as $crontabAnnotation) {
          $commandArguments = preg_split('!\s+!', $crontabAnnotation, 0, PREG_SPLIT_NO_EMPTY);
          array_splice($commandArguments, 0, 5);

          $timeExpression = trim(str_replace([' /', implode(' ', $commandArguments)], [' */', ''], ' ' . $crontabAnnotation));
          $cronExpression = CronExpression::factory($timeExpression);

          if ($cronExpression->isDue()) {
            if (!in_array('-vvv', $commandArguments, true)) {
              $commandArguments[] = '-vvv';
            }
            $logFile =
              '/www/tmp/logs/'
              . $consoleCommand->getName()
              . '---' . preg_replace('!\s!', '_', implode('_', $commandArguments))
              . '---' . (new \DateTime())->format('Y-m-d')
              . '.log';

            exec(trim(
              sprintf(
                '%s %s --run-from-cron %s >> %s 2>&1 &',
                realpath(__DIR__ . '/../../../../console'),
                $consoleCommand->getName(),
                implode(' ', $commandArguments),
                $logFile
              )
            ));
          }
        }
      }

      return 0;
    }

  }