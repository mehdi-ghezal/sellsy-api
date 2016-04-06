<?php

namespace Sellsy\Models\Documents\Document;

use Sellsy\Exception\BadArgumentException;

/**
 * Class Step
 *
 * @package Sellsy\Models\Documents\Document
 */
class Step implements StepInterface
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $label;

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @inheritdoc
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @inheritdoc
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @param string $step
     * @param StepInterface|null $object
     * @return StepInterface
     * @throws BadArgumentException
     */
    public static function factory($step, StepInterface $object = null)
    {
        $object = $object ?: new Step();

        switch($step) {
            case StepInterface::STEP_DRAFT:
                $label = 'Brouillon';
                break;
            case StepInterface::STEP_SENT:
                $label = 'Envoyé';
                break;
            case StepInterface::STEP_READ:
                $label = 'Lu';
                break;
            case StepInterface::STEP_INVOICED_PARTIALLY:
                $label = 'Partiellement facturé';
                break;
            case StepInterface::STEP_INVOICED:
                $label = 'Facturé';
                break;
            case StepInterface::STEP_ACCEPTED:
                $label = 'Accepté';
                break;
            case StepInterface::STEP_REFUSED:
                $label = 'Refusé';
                break;
            case StepInterface::STEP_EXPIRED:
                $label = 'Expiré';
                break;
            case StepInterface::STEP_DEPOSIT:
                $label = 'Acompte';
                break;
            case StepInterface::STEP_CANCELLED:
                $label = 'Annulé';
                break;
            case StepInterface::STEP_PAYMENT_DUE:
                $label = 'A régler';
                break;
            case StepInterface::STEP_PAYMENT_PARTIAL:
                $label = 'Paiement partiel';
                break;
            case StepInterface::STEP_PAYMENT_DONE:
                $label = 'Payée';
                break;
            case StepInterface::STEP_PAYMENT_LATE:
                $label = 'Retard';
                break;
            default:
                throw new BadArgumentException(sprintf('Unknown step "%s" provide to factory'), $step);
        }

        $object->setId($step);
        $object->setName($step);
        $object->setLabel($label);

        return $object;
    }
} 