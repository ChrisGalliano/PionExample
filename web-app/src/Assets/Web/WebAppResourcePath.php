<?

  namespace Src\Assets\Web;

  use Pion\Templating\Assets\Resource\Path\ResourcePathInterface;

  class WebAppResourcePath implements ResourcePathInterface
  {

    /**
     * @var string
     */
    private $path;


    public function __construct(string $path)
    {
      $this->path = realpath($path);
    }


    public function get() : string
    {
      return preg_replace(
        '!^' . preg_quote(WEB_APP_DIR . '/web', '!') . '!',
        '',
        $this->path
      );
    }
  }