<?php
  declare(strict_types=1);


  namespace Src\Console\Command\NameResolver;


  use Src\Console\Command\Base\BaseCommand;
  use Symfony\Component\Finder\SplFileInfo;

  class CommandNameResolver
  {
    public function getNameFromClass(string $class) : string
    {
      return preg_replace(
        '!^([a-zA-Z:]+)ConsoleCommand$!',
        '$1',
        implode(':',
          array_map(
            'lcfirst',
            explode(
              '\\',
              trim($class, '\\')
            )
          )
        )
      );
    }


    /**
     * @throws InvalidFilePathException
     * @throws InvalidClassNameException
     * @throws \ReflectionException
     * @throws InvalidResolvedCommandClassException
     */
    public function getClassNameFromFile(SplFileInfo $file) : string
    {
      if (strpos($file->getPathname(), SRC_DIR) !== 0) {
        throw new InvalidFilePathException($file->getPathname());
      }

      $commandClassName = str_replace(['/', '.php'], ['\\', ''], '\Src' . substr($file->getPathname(), strlen(SRC_DIR)));

      if (!class_exists($commandClassName)) {
        throw new InvalidClassNameException($commandClassName);
      }

      $commandClassReflection = new \ReflectionClass($commandClassName);
      if (!$commandClassReflection->isInstantiable() || !$commandClassReflection->isSubclassOf(BaseCommand::class)) {
        throw new InvalidResolvedCommandClassException($commandClassName);
      }

      return $commandClassName;
    }
  }