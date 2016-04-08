<?php

namespace Sellsy\Mappers;

use Psr\Log\LoggerAwareTrait;
use Psr\Log\NullLogger;
use Sellsy\Exception\RuntimeException;
use Doctrine\Instantiator\Instantiator;

use Sellsy\Models\Accounting\Currency;
use Sellsy\Models\Accounting\CurrencyInterface;
use Sellsy\Models\Annotations\Annotation;
use Sellsy\Models\Annotations\AnnotationInterface;
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
use Sellsy\Models\Addresses\AddressInterface;
use Sellsy\Models\Addresses\Address;

/**
 * Class AbstractMapper
 *
 * @package Sellsy\Mappers
 */
abstract class AbstractMapper implements MapperInterface
{
    use LoggerAwareTrait;

    /**
     * @var array
     */
    protected $interfacesMappings;

    /**
     * @var array
     */
    protected $instantiator;

    /**
     * AbstractMapper constructor.
     */
    public function __construct()
    {
        $this->logger = new NullLogger();
    }

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

        $this->logger->debug(sprintf('Register interface mappings %s ==> %s', $interface, $class));

        $this->interfacesMappings[$interface] = $class;
    }

    /**
     * @param string|null $interface
     * @return bool
     */
    public function resetInterfaceMapping($interface = null)
    {
        if (is_null($interface)) {
            $this->logger->debug('Reset all interfaces mappings');
            $this->interfacesMappings = $this->getDefaultInterfacesMappings();

            return true;
        }

        $defaultMappings = $this->getDefaultInterfacesMappings();

        if (isset($this->interfacesMappings[$interface]) && isset($defaultMappings[$interface])) {
            $this->logger->debug(sprintf('Reset interface mappings for interface %s', $interface), array(
                'before' => array($interface => $this->interfacesMappings[$interface]),
                'after' => array($interface => $this->$defaultMappings[$interface]),
            ));

            $this->interfacesMappings[$interface] = $defaultMappings[$interface];

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
            AddressInterface::class => Address::class,
            AnnotationInterface::class => Annotation::class,
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
