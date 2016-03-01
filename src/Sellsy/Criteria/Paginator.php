<?php

namespace Sellsy\Criteria;

/**
 * Class Paginator
 * @package Sellsy\Criteria
 */
class Paginator implements CriteriaInterface
{
    /**
     * @var int
     */
    protected $pageNumber = 1;

    /**
     * @var int
     */
    protected $numberOfPages = 1;

    /**
     * @var int
     */
    protected $numberPerPage = 10;

    /**
     * @var int
     */
    protected $numberOfResults;

    /**
     * @param int $pageNumber
     */
    public function setPageNumber($pageNumber)
    {
        $this->pageNumber = $pageNumber;
    }

    public function incrPageNumber()
    {
        $this->pageNumber++;
    }

    /**
     * @return int
     */
    public function getPageNumber()
    {
        return $this->pageNumber;
    }

    /**
     * @param int $numberOfPages
     */
    public function setNumberOfPages($numberOfPages)
    {
        $this->numberOfPages = $numberOfPages;
    }

    /**
     * @return int
     */
    public function getNumberOfPages()
    {
        return $this->numberOfPages;
    }

    /**
     * @return bool
     */
    public function hasMorePage()
    {
        return $this->getPageNumber() < $this->getNumberOfPages();
    }

    /**
     * @param int $numberPerPage
     */
    public function setNumberPerPage($numberPerPage)
    {
        $this->numberPerPage = $numberPerPage;
    }

    /**
     * @return int
     */
    public function getNumberPerPage()
    {
        return $this->numberPerPage;
    }

    /**
     * @return int
     */
    public function getNumberOfResults()
    {
        return $this->numberOfResults;
    }

    /**
     * @param int $numberOfResults
     */
    public function setNumberOfResults($numberOfResults)
    {
        $this->numberOfResults = $numberOfResults;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return array(
            'pagination' => array(
                'nbperpage' => $this->numberPerPage,
                'pagenum' => $this->pageNumber
            )
		);
    }
}