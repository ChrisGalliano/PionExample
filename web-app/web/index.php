<?php
  declare(strict_types=1);

  require __DIR__ . '/../vendor/autoload.php';

  use Peony\Assets\Manager\AssetsManager;
  use Peony\Engine\Engine;
  use Pion\Actions\Resolver\ActionArgumentsResolver;
  use Pion\Actions\Resolver\Argument\Value\ObjectValueResolver;
  use Pion\Actions\Resolver\Argument\Value\RequestValueResolver;
  use Pion\Application\Application;
  use Pion\Http\Request\Request;
  use Pion\Http\Response\NotFoundResponse;
  use Pion\Http\Response\Sender\ResponseAlreadySentException;
  use Pion\Http\Response\Sender\Sender;
  use Pion\Routing\Routing;
  use Src\HelloWorld\DisplayHelloWorldAction;
  use Src\Homepage\DisplayHomepageAction;
  use Whoops\Handler\PrettyPageHandler;
  use Whoops\Run;


  $whoops = new Run;
  $whoops->pushHandler(new PrettyPageHandler);
  $whoops->register();

  $request = new Request();
  try {
    require_once '../bootstrap.php';

    $response = (new Application(
      new Routing(
        DisplayHomepageAction::route(),
        DisplayHelloWorldAction::route()
      ),
      new ActionArgumentsResolver(
        new RequestValueResolver($request),
        new ObjectValueResolver($entityManager),
        new ObjectValueResolver(new Engine(new AssetsManager()))
      )
    ))->dispatch($request);
  } catch (Exception $e) {
    if (!ENV_IS_DEV_MODE) {
      $response = new NotFoundResponse();
    } else {
      /** @noinspection PhpUnhandledExceptionInspection */
      throw $e;
    }
  }

  try {
    (new Sender())->send($response);
  } catch (ResponseAlreadySentException $e) {
    if (!ENV_IS_DEV_MODE) {
      echo '404 page not found';
    } else {
      /** @noinspection PhpUnhandledExceptionInspection */
      throw $e;
    }
  }