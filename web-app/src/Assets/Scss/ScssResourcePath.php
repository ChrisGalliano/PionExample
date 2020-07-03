<?php
  declare(strict_types=1);

  namespace Src\Assets\Scss;


  use Peony\Assets\Resource\Path\ResourcePathInterface;

  class ScssResourcePath implements ResourcePathInterface
  {
    private string $scss;


    public function __construct(string $scss)
    {
      $this->scss = $scss;
    }


    public function get() : string
    {
      return '/assets/compiled' . preg_replace(
          '!^' . preg_quote(ROOT_DIR . '/src', '!') . '!',
          '',
          preg_replace('!\.scss!', '.css', $this->scss)
        ) . '?t=' . filemtime($this->scss);
    }
  }