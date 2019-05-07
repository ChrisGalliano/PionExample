<?


  namespace Src\Homepage;


  use Pion\Templating\Assets\Resource\CssResource;
  use Pion\Templating\Assets\Resource\JsResource;
  use Pion\Templating\Engine\EngineInterface;
  use Pion\Templating\Renderable\RenderableInterface;
  use Src\Assets\Scss\ScssResourcePath;
  use Src\Assets\Section\SectionIds;
  use Src\Assets\Ts\TsResourcePath;
  use Src\Products\ProductEntity;

  class HomepageWidget implements RenderableInterface
  {

    /**
     * @var ProductEntity[]
     */
    private $products;


    public function __construct(ProductEntity...$products)
    {
      $this->products = $products;
    }


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
      return $engine->render(__DIR__ . '/HomepageWidgetView.html', [
        'products' => $this->products,
      ]);
    }
  }