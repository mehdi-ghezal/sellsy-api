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
use Sellsy\Models\Documents\DeliveryInterface;
use Sellsy\Models\Documents\DocumentInterface;
use Sellsy\Models\Documents\EstimateInterface;
use Sellsy\Models\Documents\InvoiceInterface;
use Sellsy\Models\Documents\OrderInterface;
use Sellsy\Models\Documents\ProformaInterface;
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
     * @return EstimateInterface
     * @depends testDocumentClient
     */
    public function testSearchEstimates(Documents $documents)
    {
        $estimates = $documents->searchEstimates(new SearchEstimatesCriteria());
        $estimate = $estimates->current();

        $this->assertInstanceOf('Sellsy\Collections\Collection', $estimates);
        $this->assertInstanceOf('Sellsy\Models\Documents\EstimateInterface', $estimate);

        return $estimate;
    }

    /**
     * @param DocumentInterface $document
     * @depends testSearchEstimates
     */
    public function testDocumentMapping(DocumentInterface $document)
    {
        ///TODO Implement
    }

    /**
     * @param EstimateInterface $estimate
     * @depends testSearchEstimates
     */
    public function testEstimateMapping(EstimateInterface $estimate)
    {
        ///TODO Implement
    }

    /**
     * @param Documents $documents
     * @return InvoiceInterface
     * @depends testDocumentClient
     */
    public function testSearchInvoices(Documents $documents)
    {
        $invoices = $documents->searchInvoices(new SearchInvoicesCriteria());
        $invoice = $invoices->current();

        $this->assertInstanceOf('Sellsy\Collections\Collection', $invoices);
        $this->assertInstanceOf('Sellsy\Models\Documents\InvoiceInterface', $invoice);

        return $invoice;
    }

    /**
     * @param InvoiceInterface $invoice
     * @depends testSearchInvoices
     */
    public function testInvoiceMapping(InvoiceInterface $invoice)
    {
        ///TODO Implement
    }

    /**
     * @param Documents $documents
     * @return DeliveryInterface
     * @depends testDocumentClient
     */
    public function testSearchDeliveries(Documents $documents)
    {
        $deliveries = $documents->searchDelivery(new SearchDeliveriesCriteria());
        $delivery = $deliveries->current();

        $this->assertInstanceOf('Sellsy\Collections\Collection', $deliveries);
        $this->assertInstanceOf('Sellsy\Models\Documents\DeliveryInterface', $delivery);

        return $delivery;
    }

    /**
     * @param DeliveryInterface $delivery
     * @depends testSearchDeliveries
     */
    public function testDeliveryMapping(DeliveryInterface $delivery)
    {
        ///TODO Implement
    }

    /**
     * @param Documents $documents
     * @return OrderInterface
     * @depends testDocumentClient
     */
    public function testSearchOrders(Documents $documents)
    {
        $criteria = new SearchOrdersCriteria();

        $orders = $documents->searchOrders($criteria);
        $order = $orders->current();

        $this->assertInstanceOf('Sellsy\Collections\Collection', $orders);
        $this->assertInstanceOf('Sellsy\Models\Documents\OrderInterface', $order);

        return $order;
    }

    /**
     * @param OrderInterface $order
     * @depends testSearchOrders
     */
    public function testOrderMapping(OrderInterface $order)
    {
        ///TODO Implement
    }

    /**
     * @param Documents $documents
     * @return ProformaInterface
     * @depends testDocumentClient
     */
    public function testSearchProforma(Documents $documents)
    {
        $proformas = $documents->searchProforma(new SearchProformaCriteria());
        $proforma = $proformas->current();

        $this->assertInstanceOf('Sellsy\Collections\Collection', $proformas);
        $this->assertInstanceOf('Sellsy\Models\Documents\ProformaInterface', $proforma);

        return $proforma;
    }

    /**
     * @param ProformaInterface $proforma
     * @depends testSearchProforma
     */
    public function testProformaMapping(ProformaInterface $proforma)
    {
        ///TODO Implement
    }

    /**
     * @param Documents $documents
     * @return Collection
     * @depends testDocumentClient
     */
    public function testCollectionAutoloadOff(Documents $documents)
    {
        $createPeriodStart = new \DateTime();
        $createPeriodStart->setTime(0, 0, 0);

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

        /** @var EstimateInterface $estimates */
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

        /** @var EstimateInterface $estimate */
        foreach($estimates->autoload() as $estimate) {
            $estimatesCount++;
        }

        $this->assertGreaterThan(10, $estimatesCount);
    }
}
