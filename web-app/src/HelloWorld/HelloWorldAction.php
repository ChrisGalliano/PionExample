<?


  namespace Src\HelloWorld;


  use GuzzleHttp\Psr7\Uri;
  use Pion\Actions\ActionInterface;
  use Pion\Http\Response\ResponseInterface;
  use Pion\Routing\Route\MatchPathRoute;
  use Pion\Routing\Route\RouteInterface;
  use Pion\Templating\Engine\EngineInterface;
  use Pion\Templating\Renderable\RenderableInterface;
  use Pion\Templating\Response\TemplatedResponse;
  use Psr\Http\Message\UriInterface;
  use Src\Layout\Layout;

  class HelloWorldAction implements ActionInterface
  {

    public function render(EngineInterface $engine) : ResponseInterface
    {
      return new TemplatedResponse(
        new Layout(
          new class() implements RenderableInterface
          {

            public function render(EngineInterface $engine) : string
            {
              return $engine->render(__DIR__ . '/HelloWorldView.html', []);
            }
          },
          'Hello world!'
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
      return new MatchPathRoute('/hello-world/', self::class);
    }
  }