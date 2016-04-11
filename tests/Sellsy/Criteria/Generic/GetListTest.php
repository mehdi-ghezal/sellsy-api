<?php

namespace Sellsy\Tests\Sellsy\Criteria\Generic;

use Sellsy\Criteria\CriteriaInterface;
use Sellsy\Criteria\Generic\GetListCriteria;
use Sellsy\Models\SmartTags\Tag;

/**
 * Class GetListTest
 *
 * @package Sellsy\Tests\Sellsy\Criteria\Generic
 */
class GetListTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return void
     */
    public function testImplementCriteriaInterface()
    {
        $criteria = $this->getMockForAbstractClass(GetListCriteria::class);
        $this->assertInstanceOf(CriteriaInterface::class, $criteria);
    }

    /**
     * @return void
     */
    public function testAddStringTag()
    {
        $criteria = $this->getMockForAbstractClass(GetListCriteria::class);
        $criteria->addTag('woot');

        $tags = $criteria->getTags();

        $this->assertInternalType('array', $tags);
        $this->assertEquals(1, count($tags));
        $this->assertInternalType('string', current($tags));
        $this->assertEquals('woot', current($tags));
    }

    /**
     * @return void
     */
    public function testAddObjectTag()
    {
        $tag = new Tag();
        $tag->setId(1);
        $tag->setName('yeah');

        $criteria = $this->getMockForAbstractClass(GetListCriteria::class);
        $criteria->addTag($tag);

        $tags = $criteria->getTags();

        $this->assertInternalType('array', $tags);
        $this->assertEquals(1, count($tags));
        $this->assertInternalType('string', current($tags));
        $this->assertEquals('yeah', current($tags));
    }

    /**
     * @return void
     */
    public function testAddMultipleTags()
    {
        $criteria = $this->getMockForAbstractClass(GetListCriteria::class);
        $criteria->addTag('woot1');
        $criteria->addTag('woot2');

        $tags = $criteria->getTags();

        $this->assertInternalType('array', $tags);
        $this->assertEquals(2, count($tags));
    }
}
