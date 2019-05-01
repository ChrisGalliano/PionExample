<?
  declare(strict_types=1);

  require __DIR__ . '/../vendor/autoload.php';

  use Pion\Actions\Resolver\ActionResolver;
  use Pion\Actions\Resolver\Argument\Value\RequestValueResolver;
  use Pion\Application\Application;
  use Pion\Http\Request\Request;
  use Pion\Http\Response\NotFoundResponse;
  use Pion\Http\Response\Sender\ResponseAlreadySentException;
  use Pion\Http\Response\Sender\Sender;
  use Pion\Routing\Routing;
  use Pion\Templating\Assets\Manager\AssetsManager;
  use Pion\Templating\Engine\Engine;
  use Src\HelloWorld\HelloWorldAction;
  use Src\Homepage\HomepageAction;
  use Whoops\Handler\PrettyPageHandler;
  use Whoops\Run;

  $whoops = new Run;
  $whoops->pushHandler(new PrettyPageHandler);
  $whoops->register();

  define('WEB_APP_DIR', dirname(__DIR__ . '../'));

  $isProduction = false;
  $request = new Request();
  try {
    $response = (new Application(
      new Routing(
        HomepageAction::route(),
        HelloWorldAction::route()
      ),
      new ActionResolver(
        new RequestValueResolver($request)
      ),
      new Engine(new AssetsManager())
    ))->dispatch($request);
  } catch (Exception $e) {
    if ($isProduction) {
      $response = new NotFoundResponse();
    } else {
      /** @noinspection PhpUnhandledExceptionInspection */
      throw $e;
    }
  }

  try {
    (new Sender())->send($response);
  } catch (ResponseAlreadySentException $e) {
    if ($isProduction) {
      echo '404 page not found';
    } else {
      /** @noinspection PhpUnhandledExceptionInspection */
      throw $e;
    }
  }