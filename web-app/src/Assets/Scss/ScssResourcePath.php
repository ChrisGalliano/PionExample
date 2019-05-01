<?
  declare(strict_types=1);

  namespace Src\Assets\Scss;

  use function filemtime;
  use Pion\Templating\Assets\Resource\Path\ResourcePathInterface;

  class ScssResourcePath implements ResourcePathInterface
  {

    /**
     * @var string
     */
    private $scss;


    public function __construct(string $scss)
    {
      $this->scss = $scss;
    }


    public function get() : string
    {
      return '/assets/compiled' . preg_replace(
          '!^' . preg_quote(WEB_APP_DIR . '/src', '!') . '!',
          '',
          preg_replace('!\.scss!', '.css', $this->scss)
        ) . '?t=' . filemtime($this->scss);
    }
  }