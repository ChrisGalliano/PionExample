<?php
  declare(strict_types=1);


  namespace Src\HelloWorld;


  use Pion\Http\Uri\PionUri;

  class HelloWorldActionUri extends PionUri
  {
    public function __construct(string $param)
    {
      $uri = (new PionUri(DisplayHelloWorldAction::route()->path()))
        ->withQueryKey('param', $param);
      parent::__construct($uri->__toString());
    }
  }