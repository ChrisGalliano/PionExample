<?
  declare(strict_types=1);


  namespace Src\Console\Output;


  use Symfony\Component\Console\Output\ConsoleOutput;

  class DatePrefixedConsoleOutput extends ConsoleOutput
  {

    public function doWrite(string $message, bool $newline) : void
    {
      parent::doWrite((new \DateTime())->format('Y-m-d H:i:s') . ': ' . $message, $newline);
    }

  }