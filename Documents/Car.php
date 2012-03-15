<?php
namespace Documents;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;

/**
 * @ODM\Document
 * @Entity
 */
class Car
{
    /**
     * @ODM\Id(strategy="AUTO")
     */
    private $document_id;

    /**
     * @Id @Column(type="integer") @GeneratedValue
     */
    private $id;

    /**
     * @ODM\Field
     * @Column
     */
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function __toString()
    {
        return "Car #$this->document_id: $this->id, $this->model";
    }
}
