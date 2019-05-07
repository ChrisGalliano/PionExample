<?
  declare(strict_types=1);

  namespace Src\Homepage;

  use Doctrine\ORM\EntityManager;
  use GuzzleHttp\Psr7\Uri;
  use Pion\Actions\ActionInterface;
  use Pion\Http\Response\ResponseInterface;
  use Pion\Routing\Route\RegexRoute;
  use Pion\Routing\Route\RouteInterface;
  use Pion\Templating\Engine\EngineInterface;
  use Pion\Templating\Response\TemplatedResponse;
  use Psr\Http\Message\UriInterface;
  use Src\Layout\Layout;
  use Src\Products\ProductEntity;

  class DisplayHomepageAction implements ActionInterface
  {

    /**
     * @var EntityManager
     */
    private $em;


    public function __construct(EntityManager $em)
    {
      $this->em = $em;
    }


    public function render(EngineInterface $engine) : ResponseInterface
    {
      return new TemplatedResponse(
        new Layout(
          new HomepageWidget(...$this->em->getRepository(ProductEntity::class)->findAll()),
          'Pion example'
        ),
        $engine
      );
    }


    public function uri() : UriInterface
    {
      return new Uri(self::route()->path());
    }


    public static function route() : RouteInterface
    {
      return new RegexRoute('', self::class, '!^/?$!');
    }
  }