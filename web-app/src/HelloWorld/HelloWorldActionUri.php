<?php
  declare(strict_types=1);


  namespace Src\HelloWorld;


  use Pion\Http\Uri\PionUri;

  class HelloWorldActionUri extends PionUri
  {
    public function __construct()
    {
      parent::__construct(DisplayHelloWorldAction::route()->path());
    }
  }