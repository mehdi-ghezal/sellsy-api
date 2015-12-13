<?php

namespace Sellsy\Clients;

use Sellsy\Adapters\BaseAdapter;
use Sellsy\Criteria\Documents\DocumentsSearchCriteria;
use Sellsy\Collections\Documents\DocumentCollection;

/**
 * Class Documents
 * @package Sellsy\Clients
 */
class Documents
{
    /**
     * @var BaseAdapter
     */
    protected $adapter;

    /**
     * @param BaseAdapter $adapter
     */
    public function __construct(BaseAdapter $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @param DocumentsSearchCriteria $criteria
     * @return DocumentCollection
     */
    public function searchDocuments(DocumentsSearchCriteria $criteria)
    {
        return $this->adapter->map(new DocumentCollection())->call(array(
            'method' => 'Document.getList',
            'params' => $criteria->getParameters()
        ));
    }
} 