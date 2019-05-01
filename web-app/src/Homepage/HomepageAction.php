<?
  declare(strict_types=1);

  namespace Src\Homepage;

  use GuzzleHttp\Psr7\Uri;
  use Pion\Actions\ActionInterface;
  use Pion\Http\Response\ResponseInterface;
  use Pion\Routing\Route\RegexRoute;
  use Pion\Routing\Route\RouteInterface;
  use Pion\Templating\Assets\Resource\CssResource;
  use Pion\Templating\Assets\Resource\JsResource;
  use Pion\Templating\Engine\EngineInterface;
  use Pion\Templating\Renderable\RenderableInterface;
  use Pion\Templating\Response\TemplatedResponse;
  use Psr\Http\Message\UriInterface;
  use Src\Assets\Scss\ScssResourcePath;
  use Src\Assets\Section\SectionIds;
  use Src\Assets\Ts\TsResourcePath;
  use Src\Layout\Layout;

  class HomepageAction implements ActionInterface
  {

    public function render(EngineInterface $engine) : ResponseInterface
    {
      return new TemplatedResponse(
        new Layout(
          new class() implements RenderableInterface
          {

            public function render(EngineInterface $engine) : string
            {
              $engine->assetsManager()
                ->add(
                  new JsResource(new TsResourcePath(__DIR__ . '/Homepage.ts')),
                  SectionIds::SECTION_FOOTER
                )
                ->add(
                  new CssResource(new ScssResourcePath(__DIR__ . '/Homepage.scss')),
                  SectionIds::SECTION_HEAD
                );

              return $engine->render(__DIR__ . '/HomepageView.html', []);
            }
          },
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