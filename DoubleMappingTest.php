<?php
use Doctrine\Common\Annotations\AnnotationReader,
    Doctrine\ODM\MongoDB\DocumentManager,
    Doctrine\MongoDB\Connection,
    Doctrine\ODM\MongoDB\Configuration,
    Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver;
use Documents\Car;

class DoubleMappingTest extends PHPUnit_Framework_TestCase
{
    private $dm;

    public function setUp()
    {
        $this->dm = $this->getADm();
        $this->em = $GLOBALS['entityManager'];
    }

    private function getADm()
    {
        $config = new Configuration();
        $config->setProxyDir(__DIR__ . '/mongocache');
        $config->setProxyNamespace('MongoProxies');

        $config->setDefaultDB('test');
        $config->setHydratorDir(__DIR__ . '/mongocache');
        $config->setHydratorNamespace('MongoHydrators');

        $reader = new AnnotationReader();
        $config->setMetadataDriverImpl(new AnnotationDriver($reader, __DIR__ . '/Documents'));

        return DocumentManager::create(new Connection(), $config);
    }


    public function testADocumentCanBeStoredInBothDatabases()
    {
        $this->assertTrue($this->dm instanceof DocumentManager);
        $car = new Car('Ford');
        $this->em->persist($car);
        $this->em->flush();
        $this->dm->persist($car);
        $this->dm->flush();
        var_dump($car->__toString());
        $this->assertTrue(strlen($car->__toString()) > 20);
    }
}
