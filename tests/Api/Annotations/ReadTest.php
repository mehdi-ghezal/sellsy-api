<?php

namespace Sellsy\Tests\Api\Annotations;

use Sellsy\Criteria\Annotations\SearchAnnotationsCriteria;
use Sellsy\Models\Annotations\AnnotationInterface;
use Sellsy\Tests\Fixtures\Components;
use Sellsy\Api\Annotations;

class ReadTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return Annotations
     */
    public function testAnnotationsApi()
    {
        $api = Components::getApi()->annotations();

        $this->assertInstanceOf('Sellsy\Api\Annotations', $api);

        return $api;
    }

    /**
     * @param Annotations $api
     * @return AnnotationInterface
     * @depends testAnnotationsApi
     */
    public function testSearchAnnotations(Annotations $api)
    {
        /** @noinspection PhpUndefinedConstantInspection */
        $annotations = $api->searchAnnotations(new SearchAnnotationsCriteria(ANNOTATIONS_SEARCH_TYPE, ANNOTATIONS_SEARCH_ID));

        $this->assertInstanceOf('Sellsy\Collections\Collection', $annotations);
        $this->assertInstanceOf('Sellsy\Models\Annotations\AnnotationInterface', $annotations->current());

        return $annotations->current();
    }

    /**
     * @param AnnotationInterface $annotation
     * @depends testSearchAnnotations
     */
    public function testAnnotationMappings(AnnotationInterface $annotation)
    {
        $this->assertInternalType('integer', $annotation->getId());
        $this->assertInternalType('integer', $annotation->getOwnerId());
        $this->assertInternalType('integer', $annotation->getRelatedId());

        $this->assertInstanceOf('\DateTime', $annotation->getCreateAt());
        $this->assertInstanceOf('\DateTime', $annotation->getUpdateAt());

        $this->assertEquals('title_value', $annotation->getTitle());
        $this->assertEquals('annotation_value', $annotation->getContent());
        $this->assertEquals('relatedtype_value', $annotation->getRelatedType());
    }
}
