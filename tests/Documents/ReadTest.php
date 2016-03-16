<?php

namespace Sellsy\Tests\Documents;

use Sellsy\Api\Documents;
use Sellsy\Collections\Collection;
use Sellsy\Criteria\Documents\SearchCriteria\SearchDeliveriesCriteria;
use Sellsy\Criteria\Documents\SearchCriteria\SearchEstimatesCriteria;
use Sellsy\Criteria\Documents\SearchCriteria\SearchInvoicesCriteria;
use Sellsy\Criteria\Documents\SearchCriteria\SearchOrdersCriteria;
use Sellsy\Criteria\Documents\SearchCriteria\SearchProformaCriteria;
use Sellsy\Criteria\Paginator;
use Sellsy\Models\Documents\DeliveryInterface;
use Sellsy\Models\Documents\Document;
use Sellsy\Models\Documents\DocumentInterface;
use Sellsy\Models\Documents\EstimateInterface;
use Sellsy\Models\Documents\InvoiceInterface;
use Sellsy\Models\Documents\OrderInterface;
use Sellsy\Models\Documents\ProformaInterface;
use Sellsy\Tests\Fixtures\Components;

/**
 * Class ReadTest
 *
 * @package Sellsy\Tests\Documents
 */
class ReadTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return Documents
     */
    public function testDocumentsApi()
    {
        $documents = Components::getApi()->documents();

        $this->assertInstanceOf('Sellsy\Api\Documents', $documents);

        return $documents;
    }

    /**
     * @param Documents $documents
     * @return EstimateInterface
     * @depends testDocumentsApi
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
     * @param Document $document
     * @depends testSearchEstimates
     */
    public function testDocumentMapping(Document $document)
    {
        $this->assertInstanceOf('\DateTime', $document->getCreateAt());
        $this->assertInstanceOf('\DateTime', $document->getDisplayDate());
        $this->assertInstanceOf('Sellsy\Models\Client\ContactInterface', $document->getContact());
        $this->assertInstanceOf('Sellsy\Models\Accounting\CurrencyInterface', $document->getCurrency());
        $this->assertInstanceOf('Sellsy\Models\Client\CustomerInterface', $document->getCustomer());
        $this->assertInstanceOf('Sellsy\Models\Staff\PeopleInterface', $document->getOwner());
        $this->assertInstanceOf('Sellsy\Models\Documents\Document\StepInterface', $document->getStep());

        $this->assertInternalType('integer', $document->getId());
        $this->assertInternalType('float', $document->getAmountWithoutTax());
        $this->assertInternalType('float', $document->getDiscountAmount());
        $this->assertInternalType('float', $document->getDiscountPercent());
        $this->assertInternalType('float', $document->getPackagingsAmount());
        $this->assertInternalType('float', $document->getShippingsAmount());
        $this->assertInternalType('float', $document->getTaxAmount());

        $this->assertEquals('analyticsCode_value', $document->getAnalyticsCode());
        $this->assertEquals('note_value', $document->getNote());
        $this->assertEquals('ident_value', $document->getReference());

        $this->assertInstanceOf('Sellsy\Models\SmartTags\TagInterface', $document->getTag(function() { return true; }));
        $this->assertInternalType('array', $document->getTags());
        $this->assertGreaterThan(0, count($document->getTags()));

        $this->assertInstanceOf('Sellsy\Models\CustomFields\CustomFieldInterface', $document->getCustomField(function() { return true; }));
        $this->assertInternalType('array', $document->getCustomFields());
        $this->assertGreaterThan(0, count($document->getCustomFields()));
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
     * @depends testDocumentsApi
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
     * @return InvoiceInterface
     * @depends testDocumentsApi
     */
    public function testSearchInvoicesWithPayments(Documents $documents)
    {
        $search = new SearchInvoicesCriteria();
        $search->setIncludePayments();

        $invoices = $documents->searchInvoices($search);
        $invoice = $invoices->current();

        $this->assertInstanceOf('Sellsy\Collections\Collection', $invoices);
        $this->assertInstanceOf('Sellsy\Models\Documents\InvoiceInterface', $invoice);

        return $invoice;
    }

    /**
     * @param Documents $documents
     * @return DeliveryInterface
     * @depends testDocumentsApi
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
     * @depends testDocumentsApi
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
     * @depends testDocumentsApi
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
     * @depends testDocumentsApi
     */
    public function testCollectionAutoloadOff(Documents $documents)
    {
        $criteria = new SearchEstimatesCriteria();
        $criteria->setCreatePeriodStart(new \DateTime('@1457478000'));
        $criteria->setCreatePeriodEnd(new \DateTime('@1457564400'));

        $paginator = new Paginator();
        $paginator->setNumberPerPage(10);
        $paginator->setPageNumber(1);

        $estimates = $documents->searchEstimates($criteria, $paginator);
        $estimatesCount = 0;

        /** @var EstimateInterface $estimate */
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
