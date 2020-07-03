<?php
  declare(strict_types=1);

  namespace Src\Assets\Web;


  use Peony\Assets\Resource\Path\ResourcePathInterface;

  class WebAppResourcePath implements ResourcePathInterface
  {
    private string $path;


    public function __construct(string $path)
    {
      $this->path = realpath($path);
    }


    public function get() : string
    {
      return preg_replace(
        '!^' . preg_quote(ROOT_DIR . '/web', '!') . '!',
        '',
        $this->path
      );
    }
  }