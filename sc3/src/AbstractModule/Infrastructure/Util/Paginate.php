<?php
/**
 * Created by PhpStorm.
 * User: Borys
 * Date: 2017-11-18
 * Time: 20:59
 */

namespace App\AbstractModule\Infrastructure\Util;

/**
 * Class Paginate
 * @package App\AbstractModule\Infrastructure\Util
 * @author Borys Pawluczuk
 */
class Paginate
{
    /**
     * @var array
     */
    private $select;
    /**
     * @var int
     */
    private $page;
    /**
     * @var int
     */
    private $limit;
    /**
     * @var array
     */
    private $result;

    /**
     * Paginate constructor.
     * @param array $select
     * @param $page
     * @param $limit
     */
    public function __construct(array $select, $page, $limit)
    {
        $this->select = $select;
        $this->page = (int)$page;
        $this->limit = (int)$limit;
        $this->result = array();
    }

    /**
     * @return int
     */
    private function limitCount()
    {
        if (empty($this->limit))
            return $this->totalCount();

        return $this->limit;
    }

    /**
     * @return int
     */
    private function pageNumber()
    {
        if (empty($this->page))
            return 0;

        return $this->page - 1;
    }

    /**
     * @return float
     */
    private function pageCount()
    {
        if ($this->limitCount() <= 0)
            return 1;
        return ceil($this->totalCount() / $this->limitCount());
    }

    /**
     * @return int
     */
    private function pageOffset()
    {
        return $this->pageNumber() * $this->limitCount();
    }

    /**
     * @return int
     */
    public function totalCount()
    {
        return count($this->select);
    }

    /**
     * @return float
     */
    public function getPageCount()
    {
        return $this->pageCount();
    }

    public function test()
    {
        return array_key_exists(0, $this->select);
    }

    /**
     * @return int
     */
    private function pageOffsetEnd()
    {
        if ($this->pageOffset() + $this->limitCount() >= $this->totalCount())
            return $this->totalCount();

        return $this->pageOffset() + $this->limitCount();
    }

    /**
     * @return array
     */
    public function getArrayResult()
    {
        for ($count = $this->pageOffset(); $count < $this->pageOffsetEnd(); $count++) {
            if (array_key_exists($count, $this->select)) {
                array_push($this->result, $this->select[$count]);
            }
        }

        if(empty($this->result)){
            return $this->select;
        }

        return $this->result;
    }

}