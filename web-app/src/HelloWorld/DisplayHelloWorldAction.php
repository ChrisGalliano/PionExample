<?php
  declare(strict_types=1);


  namespace Src\HelloWorld;


  use Peony\Engine\EngineInterface;
  use Peony\Renderable\PredefinedRenderable;
  use Peony\Response\TemplatedResponse;
  use Pion\Actions\ActionInterface;
  use Pion\Http\Response\ResponseInterface;
  use Pion\Routing\Route\MatchPathRoute;
  use Pion\Routing\Route\RouteInterface;
  use Src\Layout\Layout;

  class DisplayHelloWorldAction implements ActionInterface
  {
    public function __invoke(EngineInterface $engine, string $param) : ResponseInterface
    {
      return new TemplatedResponse(
        new Layout(
          new PredefinedRenderable(__DIR__ . '/HelloWorldView.html', ['param' => $param]),
          'Hello world!'
        ),
        $engine
      );
    }


    public static function route() : RouteInterface
    {
      return new MatchPathRoute('/hello-world/', new self());
    }
  }