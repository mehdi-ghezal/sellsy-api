<?php

namespace Sellsy\Collections;

/**
 * Class Collection
 * @package Sellsy\Collections
 */
abstract class Collection implements \ArrayAccess, \Countable, \IteratorAggregate
{
    /**
     * The items contained in the collection.
     *
     * @var array
     */
    protected $items = array();

    /**
     * Create a new item related to the collection type
     */
    abstract public function createCollectionItem();

    /**
     * Create a new collection.
     *
     * @param mixed $items
     * @return void
     */
    public function __construct($items = array())
    {
        $items = is_null($items) ? array() : $this->getArrayableItems($items);

        $this->items = (array) $items;
    }

    /**
     * Get all of the items in the collection.
     *
     * @return array
     */
    public function all()
    {
        return $this->items;
    }

    /**
     * Get and remove the last item from the collection.
     *
     * @return mixed|null
     */
    public function pop()
    {
        return array_pop($this->items);
    }

    /**
     * Push an item onto the beginning of the collection.
     *
     * @param  mixed  $value
     * @return void
     */
    public function prepend($value)
    {
        array_unshift($this->items, $value);
    }

    /**
     * Push an item onto the end of the collection.
     *
     * @param  mixed  $value
     * @return void
     */
    public function push($value)
    {
        $this->offsetSet(null, $value);
    }

    /**
     * Pulls an item from the collection.
     *
     * @param  mixed  $key
     * @param  mixed  $default
     * @return mixed
     */
    public function pull($key, $default = null)
    {
        return array_pull($this->items, $key, $default);
    }

    /**
     * Put an item in the collection by key.
     *
     * @param  mixed  $key
     * @param  mixed  $value
     * @return void
     */
    public function put($key, $value)
    {
        $this->offsetSet($key, $value);
    }

    /**
     * Get and remove the first item from the collection.
     *
     * @return mixed|null
     */
    public function shift()
    {
        return array_shift($this->items);
    }

    /**
     * Shuffle the items in the collection.
     *
     * @return $this
     */
    public function shuffle()
    {
        shuffle($this->items);

        return $this;
    }

    /**
     * Get an iterator for the items.
     *
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->items);
    }

    /**
     * Count the number of items in the collection.
     *
     * @return int
     */
    public function count()
    {
        return count($this->items);
    }

    /**
     * Determine if an item exists at an offset.
     *
     * @param  mixed  $key
     * @return bool
     */
    public function offsetExists($key)
    {
        return array_key_exists($key, $this->items);
    }

    /**
     * Get an item at a given offset.
     *
     * @param  mixed  $key
     * @return mixed
     */
    public function offsetGet($key)
    {
        return $this->items[$key];
    }

    /**
     * Set the item at a given offset.
     *
     * @param  mixed  $key
     * @param  mixed  $value
     * @return void
     */
    public function offsetSet($key, $value)
    {
        if (is_null($key)) {
            $this->items[] = $value;
        }
        else {
            $this->items[$key] = $value;
        }
    }

    /**
     * Unset the item at a given offset.
     *
     * @param  string  $key
     * @return void
     */
    public function offsetUnset($key)
    {
        unset($this->items[$key]);
    }

    /**
     * Run a filter over each of the items.
     *
     * @param  \Closure  $callback
     * @return Collection
     */
    public function filter(\Closure $callback)
    {
        return new static(array_filter($this->items, $callback));
    }

    /**
     * Return item that match the callback, if no item match or more than one match
     * a LogicException is thrown
     *
     * @param callable $callback
     *
     * @return mixed
     * @throws \LogicException
     */
    public function findOne(\Closure $callback)
    {
        $items = array_filter($this->items, $callback);

        if (count($items) == 0) {
            throw new \LogicException("The closure use for find one item in the collection doesn't match any item of the collection");
        }

        if (count($items) > 1) {
            throw new \LogicException('The closure use for find one item in the collection match more than one item of the collection');
        }

        return current($items);
    }

    /**
     * Sort through each item with a callback.
     *
     * @param  \Closure  $callback
     * @return $this
     */
    public function sort(\Closure $callback)
    {
        uasort($this->items, $callback);

        return $this;
    }

    /**
     * Results array of items from Collection.
     *
     * @param  Collection|array $items
     * @return array
     */
    protected function getArrayableItems($items)
    {
        if ($items instanceof Collection) {
            $items = $items->all();
        }

        return $items;
    }
}