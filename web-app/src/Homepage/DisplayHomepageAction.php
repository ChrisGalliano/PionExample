<?php
  declare(strict_types=1);

  namespace Src\Homepage;

  use Doctrine\ORM\EntityManager;
  use Peony\Assets\Resource\CssResource;
  use Peony\Assets\Resource\JsResource;
  use Peony\Engine\EngineInterface;
  use Peony\Renderable\PredefinedRenderable;
  use Peony\Response\TemplatedResponse;
  use Pion\Actions\ActionInterface;
  use Pion\Http\Response\ResponseInterface;
  use Pion\Routing\Route\RegexRoute;
  use Pion\Routing\Route\RouteInterface;
  use Src\Assets\Scss\ScssResourcePath;
  use Src\Assets\Section\SectionIds;
  use Src\Assets\Ts\TsResourcePath;
  use Src\Layout\Layout;
  use Src\Products\ProductEntity;

  class DisplayHomepageAction implements ActionInterface
  {
    public function __invoke(EngineInterface $engine, EntityManager $em) : ResponseInterface
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

      return new TemplatedResponse(
        new Layout(
          new PredefinedRenderable(__DIR__ . '/HomepageWidgetView.html', [
            'products' => $em->getRepository(ProductEntity::class)->findAll(),
          ]),
          'Pion example'
        ),
        $engine
      );
    }


    public static function route() : RouteInterface
    {
      return new RegexRoute('', self::class, '!^/?$!');
    }
  }