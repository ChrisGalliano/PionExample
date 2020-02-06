<?
  declare(strict_types=1);


  namespace Src\Console\Command\Base;


  use Doctrine\ORM\EntityManager;
  use Symfony\Component\Console\Command\Command;
  use Symfony\Component\Console\Command\LockableTrait;
  use Symfony\Component\Console\Input\InputInterface;
  use Symfony\Component\Console\Input\InputOption;
  use Symfony\Component\Console\Output\OutputInterface;

  class BaseCommand extends Command
  {

    use LockableTrait;

    /**
     * @var EntityManager
     */
    private $em;


    public function __construct(string $name, EntityManager $em)
    {
      parent::__construct($name);
      $this->em = $em;
    }


    public function configure() : void
    {
      $this->addOption('run-from-cron', null, InputOption::VALUE_NONE);
      parent::configure();
    }


    public function entityManager() : EntityManager
    {
      return $this->em;
    }


    public function initialize(InputInterface $input, OutputInterface $output) : void
    {
      parent::initialize($input, $output);

      if ($input->getOption('run-from-cron')) {
        $message = '[run-from-cron] [' . (new \DateTime())->format('Y-m-d H:i:s') . ']';
        $output->writeln($message);
      }
    }


    public function callLock() : bool
    {
      return $this->lock();
    }



    public function callRelease() : void
    {
      $this->release();
    }


    public function isSingleInstance() : bool
    {
      return false;
    }

  }