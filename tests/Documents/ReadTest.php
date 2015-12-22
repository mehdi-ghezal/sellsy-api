<?php

namespace Sellsy\Tests\Documents;

use Sellsy\Clients\Documents;
use Sellsy\Collections\Documents\EstimateCollection;
use Sellsy\Criteria\Documents\SearchCriteria\DeliverySearchCriteria;
use Sellsy\Criteria\Documents\SearchCriteria\EstimateSearchCriteria;
use Sellsy\Criteria\Documents\SearchCriteria\InvoiceSearchCriteria;
use Sellsy\Criteria\Documents\SearchCriteria\OrderSearchCriteria;
use Sellsy\Criteria\Documents\SearchCriteria\ProformaSearchCriteria;
use Sellsy\Criteria\Paginator;
use Sellsy\Models\Documents\Delivery;
use Sellsy\Models\Documents\Document;
use Sellsy\Models\Documents\Estimate;
use Sellsy\Models\Documents\Invoice;
use Sellsy\Models\Documents\Order;
use Sellsy\Models\Documents\Proforma;
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
     * @return Estimate
     * @depends testDocumentClient
     */
    public function testSearchEstimates(Documents $documents)
    {
        $estimates = $documents->searchEstimates(new EstimateSearchCriteria());

        $this->assertInstanceOf('Sellsy\Collections\Documents\EstimateCollection', $estimates);

        return $estimates->current();
    }

    /**
     * @param Estimate $estimate
     * @depends testSearchEstimates
     */
    public function testEstimateMapping(Estimate $estimate)
    {
        $this->assertGreaterThan(10, $estimate->id);
        $this->assertGreaterThan(10, $estimate->amountWithoutTaxes);
        $this->assertNotEmpty($estimate->currencySymbol);
        $this->assertInstanceOf('\DateTime', $estimate->displayDate);
    }

    /**
     * @param Documents $documents
     * @return Invoice
     * @depends testDocumentClient
     */
    public function testSearchInvoices(Documents $documents)
    {
        $invoices = $documents->searchInvoices(new InvoiceSearchCriteria());

        $this->assertInstanceOf('Sellsy\Collections\Documents\InvoiceCollection', $invoices);

        return $invoices->current();
    }

    /**
     * @param Invoice $invoice
     * @depends testSearchInvoices
     */
    public function testInvoiceMapping(Invoice $invoice)
    {

    }

    /**
     * @param Documents $documents
     * @return Delivery
     * @depends testDocumentClient
     */
    public function testSearchDeliveries(Documents $documents)
    {
        $deliveries = $documents->searchDelivery(new DeliverySearchCriteria());

        $this->assertInstanceOf('Sellsy\Collections\Documents\DeliveryCollection', $deliveries);

        return $deliveries->current();
    }

    /**
     * @param Delivery $delivery
     * @depends testSearchDeliveries
     */
    public function testDeliveryMapping(Delivery $delivery)
    {

    }

    /**
     * @param Documents $documents
     * @return Order
     * @depends testDocumentClient
     */
    public function testSearchOrders(Documents $documents)
    {
        $orders = $documents->searchOrders(new OrderSearchCriteria());

        $this->assertInstanceOf('Sellsy\Collections\Documents\OrderCollection', $orders);

        return $orders->current();
    }

    /**
     * @param Order $order
     * @depends testSearchOrders
     */
    public function testOrderMapping(Order $order)
    {

    }

    /**
     * @param Documents $documents
     * @return Proforma
     * @depends testDocumentClient
     */
    public function testSearchProforma(Documents $documents)
    {
        $proforma = $documents->searchProforma(new ProformaSearchCriteria());

        $this->assertInstanceOf('Sellsy\Collections\Documents\ProformaCollection', $proforma);

        return $proforma->current();
    }

    /**
     * @param Proforma $proforma
     * @depends testSearchProforma
     */
    public function testProformaMapping(Proforma $proforma)
    {

    }

    /**
     * @param Documents $documents
     * @return EstimateCollection
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

        $estimates = $documents->searchEstimates($criteria, null, $paginator);
        $estimatesCount = 0;

        /** @var Estimate $estimates */
        foreach($estimates as $estimate) {
            $estimatesCount++;
        }

        $this->assertEquals(10, $estimatesCount);

        return $estimates;
    }

    /**
     * @param EstimateCollection $estimates
     * @depends testCollectionAutoloadOff
     */
    public function testCollectionAutoloadOn(EstimateCollection $estimates)
    {
        $estimatesCount = 0;

        /** @var Document $document */
        foreach($estimates->autoload() as $estimate) {
            $estimatesCount++;
        }

        $this->assertGreaterThan(10, $estimatesCount);
    }
}
