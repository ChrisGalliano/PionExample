<?

  namespace Src\Assets\Ts;

  use function filemtime;
  use Pion\Templating\Assets\Resource\Path\ResourcePathInterface;

  class TsResourcePath implements ResourcePathInterface
  {

    /**
     * @var string
     */
    private $ts;


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