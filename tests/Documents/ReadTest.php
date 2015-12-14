<?php

namespace Sellsy\Tests\Documents;

use Sellsy\Clients\Documents;
use Sellsy\Collections\Documents\DocumentCollection;
use Sellsy\Criteria\Documents\DocumentsSearchCriteria;
use Sellsy\Models\Documents\Document;
use Sellsy\Tests\Fixtures\Clients;
use Sellsy\Tests\Generic\ClientTest;

class ReadTest extends ClientTest
{
    public function testDocumentClient()
    {
        $documents = Clients::getValidClient()->documents();

        $this->assertInstanceOf('Sellsy\Clients\Documents', $documents);

        return $documents;
    }

    /**
     * @param Documents $documents
     * @depends testDocumentClient
     */
    public function testSearchEstimates(Documents $documents)
    {
        $createPeriodStart = new \DateTime();
        $createPeriodStart->setTime(0, 0, 0);

        $createPeriodEnd = new \DateTime();
        $createPeriodEnd->setTime(23, 59, 59);

        $criteria = new DocumentsSearchCriteria(DocumentsSearchCriteria::TYPE_ESTIMATE);
        $criteria->setCreatePeriodStart($createPeriodStart);
        $criteria->setCreatePeriodEnd($createPeriodEnd);

        $documents = $documents->searchDocuments($criteria);

        $this->assertInstanceOf('Sellsy\Collections\Documents\DocumentCollection', $documents);
    }

    /**
     * @param Documents $documents
     * @depends testDocumentClient
     */
    public function testCollectionAutoloadOff(Documents $documents)
    {
        $createPeriodStart = new \DateTime();
        $createPeriodStart->setTime(0, 0, 0);
        $createPeriodStart->sub(new \DateInterval('P3D'));

        $createPeriodEnd = new \DateTime();
        $createPeriodEnd->setTime(23, 59, 59);

        $criteria = new DocumentsSearchCriteria(DocumentsSearchCriteria::TYPE_ESTIMATE);
        $criteria->setCreatePeriodStart($createPeriodStart);
        $criteria->setCreatePeriodEnd($createPeriodEnd);

        $documents = $documents->searchDocuments($criteria);
        $documentsCount = 0;

        /** @var Document $document */
        foreach($documents as $document) {
            $documentsCount++;
        }

        $this->assertEquals(10, $documentsCount);

        return $documents;
    }

    /**
     * @param DocumentCollection $documents
     * @depends testCollectionAutoloadOff
     */
    public function testCollectionAutoloadOn(DocumentCollection $documents)
    {
        $documentsCount = 0;

        /** @var Document $document */
        foreach($documents->autoload() as $document) {
            $documentsCount++;
        }

        $this->assertGreaterThan(10, $documentsCount);
    }
}
