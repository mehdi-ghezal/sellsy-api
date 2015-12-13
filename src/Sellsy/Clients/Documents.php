<?php

namespace Sellsy\Clients;

use Sellsy\Criteria\Documents\DocumentsSearchCriteria;
use Sellsy\Collections\Documents\DocumentCollection;
use Sellsy\Interfaces\AdapterInterface;

/**
 * Class Documents
 * @package Sellsy\Clients
 */
class Documents
{
    /**
     * @var AdapterInterface
     */
    protected $adapter;

    /**
     * @param AdapterInterface $adapter
     */
    public function __construct(AdapterInterface $adapter)
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