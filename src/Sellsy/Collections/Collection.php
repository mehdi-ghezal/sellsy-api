<?php

namespace Sellsy\Collections;

use Sellsy\Adapters\MapperAdapter;
use Sellsy\Criteria\Order;
use Sellsy\Criteria\Paginator;
use Sellsy\Exception\RuntimeException;
use Sellsy\Criteria\CriteriaInterface;

/**
 * Class Collection
 * @package Sellsy\Collections
 */
class Collection implements \Iterator
{
    /**
     * The iterator for the results actually loaded in the collection.
     *
     * @var \ArrayIterator
     */
    private $iterator;

    /**
     * @var MapperAdapter
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
     * @var Order
     */
    private $order;

    /**
     * Flag for autoloading
     *
     * @var bool
     */
    private $autoloadEnabled = false;

    /**
     * Collection constructor.
     */
    public function __construct()
    {
        $this->iterator = new \ArrayIterator();
    }

    /**
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind()
    {
        if ($this->autoloadEnabled && $this->paginator->getPageNumber() > 1) {
            $this->paginator->setPageNumber(1);
            $this->adapter->map($this->subject)->call($this->method, $this->criteria, $this->order, $this->paginator);
        }

        $this->iterator->rewind();
    }

    /**
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next()
    {
        $this->iterator->next();

        if ($this->autoloadEnabled  && ! $this->iterator->valid() && $this->paginator->hasMorePage()) {
            $this->paginator->incrPageNumber();
            $this->adapter->map($this->subject)->call($this->method, $this->criteria, $this->order, $this->paginator);

            $this->iterator->rewind();
        }
    }

    /**
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key()
    {
        return ($this->paginator->getPageNumber() - 1) * $this->paginator->getNumberPerPage() + $this->iterator->key();
    }

    /**
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    public function current()
    {
        return $this->iterator->current();
    }

    /**
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0.0
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
     * @param array $options
     * @throws RuntimeException
     */
    public function bind(array $options)
    {
        if (! isset($options['adapter']) || ! $options['adapter'] instanceof MapperAdapter) {
            throw new RuntimeException('Option "adapter" is required and must be an instance of Sellsy\Adapters\MapperAdapter');
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

        if (! isset($options['subject'])) {
            throw new RuntimeException('Option "subject" is required and must be an Interface ClassName');
        }

        $this->adapter = $options['adapter'];
        $this->paginator = $options['paginator'];
        $this->method = $options['method'];
        $this->subject = $options['subject'];

        $this->criteria = isset($options['criteria']) ? $options['criteria'] : null;
        $this->order = isset($options['order']) ? $options['order'] : null;

        $this->iterator = new \ArrayIterator($options['items']);
    }

    /**
     * @return $this
     */
    public function autoload()
    {
        $this->autoloadEnabled = true;

        return $this;
    }
 }