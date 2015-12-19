<?php

namespace Sellsy\Tests\Documents;

use Sellsy\Clients\Documents;
use Sellsy\Collections\Documents\DocumentCollection;
use Sellsy\Criteria\Documents\SearchCriteria\DeliverySearchCriteria;
use Sellsy\Criteria\Documents\SearchCriteria\EstimateSearchCriteria;
use Sellsy\Criteria\Documents\SearchCriteria\InvoiceSearchCriteria;
use Sellsy\Criteria\Documents\SearchCriteria\OrderSearchCriteria;
use Sellsy\Criteria\Documents\SearchCriteria\ProformaSearchCriteria;
use Sellsy\Criteria\Paginator;
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
        $documents = $documents->searchDocuments(new EstimateSearchCriteria());

        $this->assertInstanceOf('Sellsy\Collections\Documents\DocumentCollection', $documents);
    }

    /**
     * @param Documents $documents
     * @depends testDocumentClient
     */
    public function testSearchInvoices(Documents $documents)
    {
        $documents = $documents->searchDocuments(new InvoiceSearchCriteria());

        $this->assertInstanceOf('Sellsy\Collections\Documents\DocumentCollection', $documents);
    }

    /**
     * @param Documents $documents
     * @depends testDocumentClient
     */
    public function testSearchDeliveries(Documents $documents)
    {
        $documents = $documents->searchDocuments(new DeliverySearchCriteria());

        $this->assertInstanceOf('Sellsy\Collections\Documents\DocumentCollection', $documents);
    }

    /**
     * @param Documents $documents
     * @depends testDocumentClient
     */
    public function testSearchOrders(Documents $documents)
    {
        $documents = $documents->searchDocuments(new OrderSearchCriteria());

        $this->assertInstanceOf('Sellsy\Collections\Documents\DocumentCollection', $documents);
    }

    /**
     * @param Documents $documents
     * @depends testDocumentClient
     */
    public function testSearchProforma(Documents $documents)
    {
        $documents = $documents->searchDocuments(new ProformaSearchCriteria());

        $this->assertInstanceOf('Sellsy\Collections\Documents\DocumentCollection', $documents);
    }

    /**
     * @param Documents $documents
     * @return Documents|DocumentCollection
     * @depends testDocumentClient
     */
    public function testCollectionAutoloadOff(Documents $documents)
    {
        $createPeriodStart = new \DateTime();
        $createPeriodStart->setTime(0, 0, 0);
        $createPeriodStart->sub(new \DateInterval('P3D'));

        $createPeriodEnd = new \DateTime();
        $createPeriodEnd->setTime(23, 59, 59);

        $criteria = new EstimateSearchCriteria();
        $criteria->setCreatePeriodStart($createPeriodStart);
        $criteria->setCreatePeriodEnd($createPeriodEnd);

        $paginator = new Paginator();
        $paginator->setNumberPerPage(10);
        $paginator->setPageNumber(1);

        $documents = $documents->searchDocuments($criteria, null, $paginator);
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
