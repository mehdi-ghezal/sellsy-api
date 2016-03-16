<?php

namespace Sellsy\Collections;

use Sellsy\Adapters\AdapterInterface;
use Sellsy\Criteria\Paginator;
use Sellsy\Exception\RuntimeException;
use Sellsy\Criteria\CriteriaInterface;

/**
 * Class Collection
 * @package Sellsy\Collections
 */
class Collection implements \Iterator, \ArrayAccess, \SeekableIterator, \Countable
{
    /**
     * The iterator for the results actually loaded in the collection.
     *
     * @var \ArrayIterator
     */
    private $iterator;

    /**
     * @var AdapterInterface
     */
    private $adapter;

    /**
     * @var string
     */
    private $method;

    /**
     * @var string
     */
    private $subject;

    /**
     * @var Paginator
     */
    private $paginator;

    /**
     * @var CriteriaInterface
     */
    private $criteria;

    /**
     * Flag for autoloading
     *
     * @var bool
     */
    private $autoloadEnabled = false;

    /**
     * Collection constructor.
     *
     * @param array $options
     * @throws RuntimeException
     */
    public function __construct(array $options)
    {
        if (! isset($options['adapter']) || ! $options['adapter'] instanceof AdapterInterface) {
            throw new RuntimeException('Option "adapter" is required and must be an instance of Sellsy\Adapters\AdapterInterface');
        }

        if (! isset($options['paginator']) || ! $options['paginator'] instanceof Paginator) {
            throw new RuntimeException('Option "paginator" is required and must be an instance of Sellsy\Criteria\Paginator');
        }

        if (! isset($options['method'])) {
            throw new RuntimeException('Option "method" is required');
        }

        if (! isset($options['items']) || !is_array($options['items'])) {
            throw new RuntimeException('Option "items" is required and must be an array');
        }

        $this->adapter = $options['adapter'];
        $this->paginator = $options['paginator'];
        $this->method = $options['method'];

        $this->subject = isset($options['subject']) ? $options['subject'] : null;
        $this->criteria = isset($options['criteria']) ? $options['criteria'] : null;

        $this->iterator = new \ArrayIterator($options['items']);
    }

    /**
     * @inheritdoc
     */
    public function rewind()
    {
        if ($this->autoloadEnabled && $this->paginator->getPageNumber() > 1) {
            $this->paginator->setPageNumber(1);

            /** @var Collection $newCollection */
            $newCollection = $this->adapter->map($this->subject)->call($this->method, $this->criteria, $this->paginator);
            $this->iterator = new \ArrayIterator($newCollection->asArray(false));
        }

        $this->iterator->rewind();
    }

    /**
     * @inheritdoc
     */
    public function next()
    {
        $this->iterator->next();

        if ($this->autoloadEnabled  && ! $this->iterator->valid() && $this->paginator->hasMorePage()) {
            $this->paginator->incrPageNumber();

            /** @var Collection $newCollection */
            $newCollection = $this->adapter->map($this->subject)->call($this->method, $this->criteria, $this->paginator);
            $this->iterator = new \ArrayIterator($newCollection->asArray(false));

            $this->iterator->rewind();
        }
    }

    /**
     * @inheritdoc
     */
    public function key()
    {
        return ($this->paginator->getPageNumber() - 1) * $this->paginator->getNumberPerPage() + $this->iterator->key();
    }

    /**
     * @inheritdoc
     */
    public function current()
    {
        return $this->iterator->current();
    }

    /**
     * @inheritdoc
     */
    public function valid()
    {
        if (! $this->iterator->valid()) {
            $this->autoloadEnabled = false;

            return false;
        }

        return true;
    }

    /**
     * @return $this
     */
    public function autoload()
    {
        $this->autoloadEnabled = true;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function offsetExists($offset)
    {
        return $this->iterator->offsetExists($offset);
    }

    /**
     * @inheritdoc
     */
    public function offsetGet($offset)
    {
        return $this->iterator->offsetGet($offset);
    }

    /**
     * @inheritdoc
     */
    public function offsetSet($offset, $value)
    {
        $this->iterator->offsetSet($offset, $value);
    }

    /**
     * @inheritdoc
     */
    public function offsetUnset($offset)
    {
        $this->iterator->offsetUnset($offset);
    }

    /**
     * @inheritdoc
     */
    public function seek($position)
    {
        $this->iterator->seek($position);
    }

    /**
     * @inheritdoc
     */
    public function count()
    {
        return $this->paginator->getNumberOfResults();
    }

    /**
     * @param bool|true $withAutoload
     * @return array
     */
    public function asArray($withAutoload = true)
    {
        $this->autoloadEnabled = !! $withAutoload;

        $copy = array();

        foreach($this as $item) {
            $copy[] = $item;
        }

        return $copy;
    }
}