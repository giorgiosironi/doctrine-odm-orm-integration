<?php
use Doctrine\Common\ClassLoader,
    Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Tools\Setup;

require_once 'Doctrine/Common/ClassLoader.php';

$classLoader = new ClassLoader('Doctrine');
$classLoader->register();

$classLoader = new ClassLoader('Symfony', 'Doctrine');
$classLoader->register();

$classLoader = new ClassLoader('Documents');
$classLoader->register();

AnnotationDriver::registerAnnotationClasses();

$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/Documents"), $isDevMode);

// database configuration parameters
$conn = array(
    'driver' => 'pdo_sqlite',
    'path' => __DIR__ . '/db.sqlite',
);

$entityManager = \Doctrine\ORM\EntityManager::create($conn, $config);

