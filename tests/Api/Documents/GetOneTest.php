<?php

namespace Sellsy\Tests\Api\Documents;

use Sellsy\Api\Documents;
use Sellsy\Criteria\Documents\GetDocumentCriteria\GetDeliveryCriteria;
use Sellsy\Criteria\Documents\GetDocumentCriteria\GetEstimateCriteria;
use Sellsy\Criteria\Documents\GetDocumentCriteria\GetInvoiceCriteria;
use Sellsy\Criteria\Documents\GetDocumentCriteria\GetOrderCriteria;
use Sellsy\Criteria\Documents\GetDocumentCriteria\GetProformaCriteria;
use Sellsy\Models\Documents\DeliveryInterface;
use Sellsy\Models\Documents\EstimateInterface;
use Sellsy\Models\Documents\InvoiceInterface;
use Sellsy\Models\Documents\OrderInterface;
use Sellsy\Models\Documents\ProformaInterface;
use Sellsy\Tests\Fixtures\Components;

class GetOneTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Documents
     */
    protected $documents;

    public function setUp()
    {
        $this->documents = Components::getApi()->documents();
    }

    /**
     * @return EstimateInterface
     */
    public function testGetEstimate()
    {
        $estimate = $this->documents->getEstimate(new GetEstimateCriteria(DOCUMENT_ESTIMATE_ID));
        $this->assertInstanceOf('Sellsy\Models\Documents\EstimateInterface', $estimate);

        return $estimate;
    }

    /**
     * @return InvoiceInterface
     */
    public function testGetInvoice()
    {
        $invoice = $this->documents->getInvoice(new GetInvoiceCriteria(DOCUMENT_INVOICE_ID));
        $this->assertInstanceOf('Sellsy\Models\Documents\InvoiceInterface', $invoice);

        return $invoice;
    }


    /**
     * @param InvoiceInterface $invoice
     * @depends testGetInvoice
     */
    public function testInvoiceMappings(InvoiceInterface $invoice)
    {
        $this->assertInstanceOf('\DateTime', $invoice->getCreateAt());
        $this->assertInstanceOf('\DateTime', $invoice->getDisplayDate());
        $this->assertInstanceOf('Sellsy\Models\Client\ContactInterface', $invoice->getContact());
        $this->assertInstanceOf('Sellsy\Models\Accounting\CurrencyInterface', $invoice->getCurrency());
        $this->assertInstanceOf('Sellsy\Models\Client\CustomerInterface', $invoice->getCustomer());
        $this->assertInstanceOf('Sellsy\Models\Staff\PeopleInterface', $invoice->getOwner());
        $this->assertInstanceOf('Sellsy\Models\Documents\Document\StepInterface', $invoice->getStep());

        $this->assertInternalType('integer', $invoice->getId());
        $this->assertInternalType('float', $invoice->getAmountWithoutTax());
        $this->assertInternalType('float', $invoice->getDiscountAmount());
        $this->assertInternalType('float', $invoice->getDiscountPercent());
        $this->assertInternalType('float', $invoice->getPackagingsAmount());
        $this->assertInternalType('float', $invoice->getShippingsAmount());
        $this->assertInternalType('float', $invoice->getTaxAmount());

        $this->assertEquals('analyticsCode_value', $invoice->getAnalyticsCode());
        $this->assertEquals('notes_value', $invoice->getNote());
        $this->assertEquals('ident_value', $invoice->getReference());

        $this->assertInternalType('array', $invoice->getTags());
        $this->assertInstanceOf('Sellsy\Models\SmartTags\TagInterface', $invoice->getTag(function() { return true; }));
        $this->assertGreaterThan(0, count($invoice->getTags()));

        $this->assertInternalType('array', $invoice->getCustomFields());
        $this->assertInstanceOf('Sellsy\Models\CustomFields\CustomFieldInterface', $invoice->getCustomField(function() { return true; }));
        $this->assertGreaterThan(0, count($invoice->getCustomFields()));

        $this->assertInternalType('array', $invoice->getRows());
        $this->assertInstanceOf('Sellsy\Models\Documents\Document\RowInterface', $invoice->getRow(function() { return true; }));
        $this->assertGreaterThan(0, count($invoice->getRows()));
    }

    /**
     * @return OrderInterface
     */
    public function testGetOrder()
    {
        $order = $this->documents->getOrder(new GetOrderCriteria(DOCUMENT_ORDER_ID));
        $this->assertInstanceOf('Sellsy\Models\Documents\OrderInterface', $order);

        return $order;
    }

    /**
     * @return DeliveryInterface
     */
    public function testGetDelivery()
    {
        $delivery = $this->documents->getDelivery(new GetDeliveryCriteria(DOCUMENT_DELIVERY_ID));
        $this->assertInstanceOf('Sellsy\Models\Documents\DeliveryInterface', $delivery);

        return $delivery;
    }

    /**
     * @return ProformaInterface
     */
    public function testGetProforma()
    {
        $proforma = $this->documents->getProforma(new GetProformaCriteria(DOCUMENT_PROFORMA_ID));
        $this->assertInstanceOf('Sellsy\Models\Documents\ProformaInterface', $proforma);

        return $proforma;
    }
}
