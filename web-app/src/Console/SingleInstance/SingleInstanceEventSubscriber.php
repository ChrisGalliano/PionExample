<?php
  declare(strict_types=1);


  namespace Src\Console\SingleInstance;


  use Src\Console\Command\Base\BaseCommand;
  use Symfony\Component\Console\ConsoleEvents;
  use Symfony\Component\Console\Event\ConsoleCommandEvent;
  use Symfony\Component\Console\Event\ConsoleTerminateEvent;
  use Symfony\Component\EventDispatcher\EventSubscriberInterface;

  class SingleInstanceEventSubscriber implements EventSubscriberInterface
  {
    /**
     * @return string[][]
     */
    public static function getSubscribedEvents() : array
    {
      return [
        ConsoleEvents::COMMAND => ['onCommand'],
        ConsoleEvents::TERMINATE => ['onTerminate'],
      ];
    }


    public function onCommand(ConsoleCommandEvent $event) : void
    {
      $command = $event->getCommand();
      assert($command instanceof BaseCommand);
      if ($command->isSingleInstance() && !$command->callLock()) {
        $event->getOutput()->writeln(
          sprintf('The command [%s] is already running in another process.', $command->getName())
        );
        $event->disableCommand();
      }
    }


    public function onTerminate(ConsoleTerminateEvent $event) : void
    {
      $command = $event->getCommand();
      assert($command instanceof BaseCommand);
      if ($command->isSingleInstance()) {
        $command->callRelease();
      }
    }
  }