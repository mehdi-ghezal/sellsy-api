<?php

namespace Sellsy\Tests\Documents;

use Sellsy\Clients\Documents;
use Sellsy\Collections\Collection;
use Sellsy\Criteria\Documents\SearchCriteria\SearchDeliveriesCriteria;
use Sellsy\Criteria\Documents\SearchCriteria\SearchEstimatesCriteria;
use Sellsy\Criteria\Documents\SearchCriteria\SearchInvoicesCriteria;
use Sellsy\Criteria\Documents\SearchCriteria\SearchOrdersCriteria;
use Sellsy\Criteria\Documents\SearchCriteria\SearchProformaCriteria;
use Sellsy\Criteria\Paginator;
use Sellsy\Models\Documents\Delivery;
use Sellsy\Models\Documents\Document;
use Sellsy\Models\Documents\Estimate;
use Sellsy\Models\Documents\Invoice;
use Sellsy\Models\Documents\Order;
use Sellsy\Models\Documents\Proforma;
use Sellsy\Tests\Fixtures\Components;
use Sellsy\Tests\Generic\ClientTest;

/**
 * Class ReadTest
 *
 * @package Sellsy\Tests\Documents
 */
class ReadTest extends ClientTest
{
    /**
     * @return Documents
     */
    public function testDocumentClient()
    {
        $documents = Components::getClient()->documents();

        $this->assertInstanceOf('Sellsy\Clients\Documents', $documents);

        return $documents;
    }

    /**
     * @param Documents $documents
     * @return Estimate
     * @depends testDocumentClient
     */
    public function testSearchEstimates(Documents $documents)
    {
        $estimates = $documents->searchEstimates(new SearchEstimatesCriteria());

        $this->assertInstanceOf('Sellsy\Collections\Collection', $estimates);
        $this->assertInstanceOf('Sellsy\Models\Documents\EstimateInterface', $estimates->current());

        return $estimates->current();
    }

    /**
     * @param Estimate $estimate
     * @depends testSearchEstimates
     */
    public function testEstimateMapping(Estimate $estimate)
    {
        ///TODO Implement
    }

    /**
     * @param Documents $documents
     * @return Invoice
     * @depends testDocumentClient
     */
    public function testSearchInvoices(Documents $documents)
    {
        $invoices = $documents->searchInvoices(new SearchInvoicesCriteria());

        $this->assertInstanceOf('Sellsy\Collections\Collection', $invoices);
        $this->assertInstanceOf('Sellsy\Models\Documents\InvoiceInterface', $invoices->current());

        return $invoices->current();
    }

    /**
     * @param Invoice $invoice
     * @depends testSearchInvoices
     */
    public function testInvoiceMapping(Invoice $invoice)
    {
        ///TODO Implement
    }

    /**
     * @param Documents $documents
     * @return Delivery
     * @depends testDocumentClient
     */
    public function testSearchDeliveries(Documents $documents)
    {
        $deliveries = $documents->searchDelivery(new SearchDeliveriesCriteria());

        $this->assertInstanceOf('Sellsy\Collections\Collection', $deliveries);
        $this->assertInstanceOf('Sellsy\Models\Documents\DeliveryInterface', $deliveries->current());

        return $deliveries->current();
    }

    /**
     * @param Delivery $delivery
     * @depends testSearchDeliveries
     */
    public function testDeliveryMapping(Delivery $delivery)
    {
        ///TODO Implement
    }

    /**
     * @param Documents $documents
     * @return Order
     * @depends testDocumentClient
     */
    public function testSearchOrders(Documents $documents)
    {
        $criteria = new SearchOrdersCriteria();

        $orders = $documents->searchOrders($criteria);

        $this->assertInstanceOf('Sellsy\Collections\Collection', $orders);
        $this->assertInstanceOf('Sellsy\Models\Documents\OrderInterface', $orders->current());

        return $orders->current();
    }

    /**
     * @param Order $order
     * @depends testSearchOrders
     */
    public function testOrderMapping(Order $order)
    {
        ///TODO Implement
    }

    /**
     * @param Documents $documents
     * @return Proforma
     * @depends testDocumentClient
     */
    public function testSearchProforma(Documents $documents)
    {
        $proforma = $documents->searchProforma(new SearchProformaCriteria());

        $this->assertInstanceOf('Sellsy\Collections\Collection', $proforma);
        $this->assertInstanceOf('Sellsy\Models\Documents\ProformaInterface', $proforma->current());

        return $proforma->current();
    }

    /**
     * @param Proforma $proforma
     * @depends testSearchProforma
     */
    public function testProformaMapping(Proforma $proforma)
    {
        ///TODO Implement
    }

    /**
     * @depends testDocumentClient
     */
    public function testCollectionAutoloadOff(Documents $documents)
    {
        $createPeriodStart = new \DateTime();
        $createPeriodStart->setTime(0, 0, 0);
        $createPeriodStart->sub(new \DateInterval('P1D'));

        $createPeriodEnd = new \DateTime();
        $createPeriodEnd->setTime(23, 59, 59);

        $criteria = new SearchEstimatesCriteria();
        $criteria->setCreatePeriodStart($createPeriodStart);
        $criteria->setCreatePeriodEnd($createPeriodEnd);

        $paginator = new Paginator();
        $paginator->setNumberPerPage(10);
        $paginator->setPageNumber(1);

        $estimates = $documents->searchEstimates($criteria, $paginator);
        $estimatesCount = 0;

        /** @var Estimate $estimates */
        foreach($estimates as $estimate) {
            $estimatesCount++;
        }

        $this->assertEquals(10, $estimatesCount);

        return $estimates;
    }

    /**
     * @param Collection $estimates
     * @depends testCollectionAutoloadOff
     */
    public function testCollectionAutoloadOn(Collection $estimates)
    {
        $estimatesCount = 0;

        /** @var Document $document */
        foreach($estimates->autoload() as $estimate) {
            $estimatesCount++;
        }

        $this->assertGreaterThan(10, $estimatesCount);
    }
}
