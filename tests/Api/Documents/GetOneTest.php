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
