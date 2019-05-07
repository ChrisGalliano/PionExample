<?php

  use Doctrine\ORM\EntityManager;
  use Doctrine\ORM\Tools\Setup;

  require __DIR__ . '/vendor/autoload.php';

  define('ENV_IS_DEV_MODE', true);
  define('ROOT_DIR', __DIR__);
  define('SRC_DIR', __DIR__ . '/src');

  /** @noinspection PhpUnhandledExceptionInspection */
  $entityManager = EntityManager::create([
    'driver' => 'pdo_mysql',
    'user' => 'root',
    'password' => 'example_pwd',
    'dbname' => 'pion_example',
    'host' => 'mariadb',
    'db_port' => null,
    'charset' => 'utf8',
  ], Setup::createAnnotationMetadataConfiguration([SRC_DIR], ENV_IS_DEV_MODE));