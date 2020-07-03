<?php
  declare(strict_types=1);

  namespace Src\Layout;

  use Peony\Assets\Resource\CssResource;
  use Peony\Assets\Resource\JsResource;
  use Peony\Engine\EngineInterface;
  use Peony\Renderable\RenderableInterface;
  use Src\Assets\Scss\ScssResourcePath;
  use Src\Assets\Section\SectionIds;
  use Src\Assets\Web\WebAppResourcePath;

  final class Layout implements RenderableInterface
  {
    private RenderableInterface $renderable;

    private string $title;


    public function __construct(RenderableInterface $renderable, string $title)
    {
      $this->renderable = $renderable;
      $this->title = $title;
    }


    public function render(EngineInterface $engine) : string
    {
      $engine->assetsManager()
        ->add(
          new JsResource(new WebAppResourcePath(__DIR__ . '../../web/assets/compiled/libs/jquery.min.js')),
          SectionIds::SECTION_FOOTER
        )
        ->add(
          new CssResource(new ScssResourcePath(__DIR__ . '/Layout.scss')),
          SectionIds::SECTION_HEAD
        );

      return $engine->render(
        __DIR__ . '/LayoutView.html',
        [
          'content' => $this->renderable->render($engine),
          'title' => $this->title,
          'assetsManager' => $engine->assetsManager(),
        ]
      );
    }
  }