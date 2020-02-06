<?
  declare(strict_types=1);


  namespace Src\Console\Command\NameResolver;


  final class InvalidFilePathException extends \Exception
  {

    public function __construct(string $pathname)
    {
      parent::__construct("The file [$pathname] is not part of the project");
    }

  }