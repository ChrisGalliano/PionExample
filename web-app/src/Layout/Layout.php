<? /** @noinspection ALL */
  declare(strict_types=1);

  namespace Src\Layout;

  use Pion\Templating\Assets\Resource\CssResource;
  use Pion\Templating\Assets\Resource\JsResource;
  use Pion\Templating\Engine\EngineInterface;
  use Pion\Templating\Renderable\RenderableInterface;
  use Src\Assets\Scss\ScssResourcePath;
  use Src\Assets\Section\SectionIds;
  use Src\Assets\Web\WebAppResourcePath;

  final class Layout implements RenderableInterface
  {

    /**
     * @var \Pion\Templating\Renderable\RenderableInterface
     */
    private $renderable;

    /**
     * @var string
     */
    private $title;


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