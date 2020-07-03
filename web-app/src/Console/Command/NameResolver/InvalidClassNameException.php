<?php
  declare(strict_types=1);


  namespace Src\Console\Command\NameResolver;


  final class InvalidClassNameException extends \Exception
  {
    public function __construct(string $commandClassName)
    {
      parent::__construct("Class name [$commandClassName] does not exists");
    }
  }