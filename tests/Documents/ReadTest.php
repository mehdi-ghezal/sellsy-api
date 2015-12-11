<?php

namespace Sellsy\Tests\Documents;

use Sellsy\Clients\Documents;
use Sellsy\Clients\Documents\DocumentsSearchCriteria;
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
     * @depends testDocumentClient
     */
    public function testSearchEstimates(Documents $documents)
    {
        $criteria = new DocumentsSearchCriteria(DocumentsSearchCriteria::TYPE_ESTIMATE);
        $criteria->setCreatePeriodStart(new \DateTime());
        $criteria->setCreatePeriodEnd(new \DateTime());
        $criteria->setExpirePeriodStart(new \DateTime());
        $criteria->setExpirePeriodEnd(new \DateTime());

        $documents = $documents->searchDocuments($criteria);

        $this->assertInstanceOf('Sellsy\Collections\Documents\DocumentCollection', $documents);
    }
}
