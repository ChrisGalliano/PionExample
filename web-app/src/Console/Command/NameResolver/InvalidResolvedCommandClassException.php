<?php
  declare(strict_types=1);


  namespace Src\Console\Command\NameResolver;


  final class InvalidResolvedCommandClassException extends \Exception
  {
    public function __construct(string $resolvedClassName)
    {
      parent::__construct("Resolved class [$resolvedClassName] in not a command!");
    }
  }