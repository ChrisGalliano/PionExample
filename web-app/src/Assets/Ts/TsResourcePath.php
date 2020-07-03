<?php
  declare(strict_types=1);

  namespace Src\Assets\Ts;


  use Peony\Assets\Resource\Path\ResourcePathInterface;

  class TsResourcePath implements ResourcePathInterface
  {
    private string $ts;


    public function __construct(string $ts)
    {
      $this->ts = realpath($ts);
    }


    public function get() : string
    {
      return '/assets/compiled' . preg_replace(
          '!^' . preg_quote(ROOT_DIR . '/src', '!') . '!',
          '',
          preg_replace('!\.ts!', '.js', $this->ts)
        ) . '?t=' . filemtime($this->ts);
    }
  }