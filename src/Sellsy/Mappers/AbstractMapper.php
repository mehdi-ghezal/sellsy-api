<?php

namespace Sellsy\Mappers;

use Sellsy\Exception\RuntimeException;
use Doctrine\Instantiator\Instantiator;

use Sellsy\Models\Accounting\Currency;
use Sellsy\Models\Accounting\CurrencyInterface;
use Sellsy\Models\ApiInfos;
use Sellsy\Models\ApiInfosInterface;
use Sellsy\Models\Catalogue\Item;
use Sellsy\Models\Catalogue\ItemInterface;
use Sellsy\Models\Client\Contact;
use Sellsy\Models\Client\ContactInterface;
use Sellsy\Models\Client\Customer;
use Sellsy\Models\Client\CustomerInterface;
use Sellsy\Models\CustomFields\CustomField;
use Sellsy\Models\CustomFields\CustomFieldInterface;
use Sellsy\Models\Documents\Delivery;
use Sellsy\Models\Documents\DeliveryInterface;
use Sellsy\Models\Documents\Document\Step;
use Sellsy\Models\Documents\Document\StepInterface;
use Sellsy\Models\Documents\Estimate;
use Sellsy\Models\Documents\EstimateInterface;
use Sellsy\Models\Documents\Invoice;
use Sellsy\Models\Documents\InvoiceInterface;
use Sellsy\Models\Documents\Order;
use Sellsy\Models\Documents\OrderInterface;
use Sellsy\Models\Documents\Proforma;
use Sellsy\Models\Documents\ProformaInterface;
use Sellsy\Models\SmartTags\Tag;
use Sellsy\Models\SmartTags\TagInterface;
use Sellsy\Models\Staff\People;
use Sellsy\Models\Staff\PeopleInterface;
use Sellsy\Models\Catalogue\Item\Packaging;
use Sellsy\Models\Catalogue\Item\PackagingInterface;

/**
 * Class AbstractMapper
 *
 * @package Sellsy\Mappers
 */
abstract class AbstractMapper implements MapperInterface
{
    /**
     * @var array
     */
    protected $interfacesMappings = array(
        ApiInfosInterface::class => ApiInfos::class,
        CurrencyInterface::class => Currency::class,
        ItemInterface::class => Item::class,
        ContactInterface::class => Contact::class,
        CustomerInterface::class => Customer::class,
        CustomFieldInterface::class => CustomField::class,
        DeliveryInterface::class => Delivery::class,
        EstimateInterface::class => Estimate::class,
        InvoiceInterface::class => Invoice::class,
        OrderInterface::class => Order::class,
        ProformaInterface::class => Proforma::class,
        StepInterface::class => Step::class,
        TagInterface::class => Tag::class,
        PeopleInterface::class => People::class,
        PackagingInterface::class => Packaging::class,
    );

    /**
     * @var array
     */
    protected $instantiator;

    /**
     * @param string $interface
     * @param string $class
     * @throws RuntimeException
     */
    public function setInterfaceMapping($interface, $class)
    {
        if (! isset($this->interfacesMappings[$interface])) {
            throw new RuntimeException(sprintf("Unable to set a mapping for unknown interface %s", $interface));
        }

        $this->interfacesMappings[$interface] = $class;
    }

    /**
     * @param string|null $interface
     * @return bool
     */
    public function resetInterfaceMapping($interface = null)
    {
        if (isset($this->interfacesMappings[$interface])) {
            $this->interfacesMappings[$interface] = $this->getDefaultInterfacesMappings()[$interface];

            return true;
        }

        return false;
    }

    /**
     * @return array
     */
    protected function getDefaultInterfacesMappings()
    {
        return array(
            ApiInfosInterface::class => ApiInfos::class,
            CurrencyInterface::class => Currency::class,
            ItemInterface::class => Item::class,
            ContactInterface::class => Contact::class,
            CustomerInterface::class => Customer::class,
            CustomFieldInterface::class => CustomField::class,
            DeliveryInterface::class => Delivery::class,
            EstimateInterface::class => Estimate::class,
            InvoiceInterface::class => Invoice::class,
            OrderInterface::class => Order::class,
            ProformaInterface::class => Proforma::class,
            StepInterface::class => Step::class,
            TagInterface::class => Tag::class,
            PeopleInterface::class => People::class,
            PackagingInterface::class => Packaging::class,
        );
    }

    /**
     * @param $interface
     * @return mixed
     * @throws RuntimeException
     */
    protected function getObjectInstance($interface)
    {
        if (! isset($this->interfacesMappings[$interface])) {
            throw new RuntimeException("Unable to find a mapping class for interface " . $interface);
        }

        if (! $this->instantiator) {
            $this->instantiator = new Instantiator();
        }

        return $this->instantiator->instantiate($this->interfacesMappings[$interface]);
    }
}
