<?php

namespace common\components;
/**
 * @Author night
 * Class ResultModel
 * api返回结果集
 * @package app\common\components
 */
class ResultModel
{
    private $errcode = 0;
    private $errmsg = "ok";
    private $data;
    private $total_count;
    private $per_page = 20;
    private $current_page = 1;
    private $total_page = 1;
    protected $sensitive = array('password');
    /**
     * @var yii分页对象
     */
    private $pagination;

    public function result($removeSensitive = false, $ignorePage = false)
    {
        # 过滤掉敏感信息
        if (is_array($removeSensitive)) {
            $this->removeSensitive($removeSensitive, $this->data);
        }
        $retArr = array(
            'errcode' => $this->errcode,
            'errmsg' => $this->errmsg,
            'data' => $this->data
        );
        if (!is_null($this->pagination)) {
            if ($ignorePage) {
                $retArr['per_page'] = $this->per_page = $this->pagination->pageSize;
                $retArr['total_count'] = $this->total_count = $this->pagination->totalCount;
                $retArr['current_page'] = $this->current_page = $this->pagination->page;
                $retArr['total_page'] = $this->total_page = $this->pagination->pageCount;
            } else {
                $retArr['page']['per_page'] = $this->per_page = $this->pagination->pageSize;
                $retArr['page']['total_count'] = $this->total_count = $this->pagination->totalCount;
                $retArr['page']['current_page'] = $this->current_page = $this->pagination->page;
                $retArr['page']['total_page'] = $this->total_page = $this->pagination->pageCount;
            }
        }
        return $retArr;
    }

    /**
     * @return 过滤掉敏感信息
     */
    public function removeSensitive($sensitive = array(), &$arr)
    {
        foreach ($sensitive as $sensitiveVal) {
            if (isset($arr[$sensitiveVal])) {
                unset($arr[$sensitiveVal]);
            }
        }
        foreach ($arr as $key => $val) {
            foreach ($sensitive as $sensitiveVal) {
                if (isset($val[$sensitiveVal])) {
                    unset($val[$sensitiveVal]);
                }
            }
            if (is_array($val)) {
                $this->removeSensitive($sensitive, $arr[$key]);
            }
        }
    }

    /**
     * @return int
     */
    public function getCurrentPage()
    {
        return $this->current_page;
    }

    /**
     * @param int $current_page
     */
    public function setCurrentPage($current_page)
    {
        $this->current_page = $current_page;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return int
     */
    public function getErrcode()
    {
        return $this->errcode;
    }

    /**
     * @param int $errcode
     */
    public function setErrcode($errcode)
    {
        $this->errcode = $errcode;
    }

    /**
     * @return mixed
     */
    public function getErrmsg()
    {
        return $this->errmsg;
    }

    /**
     * @param mixed $errmsg
     */
    public function setErrmsg($errmsg)
    {
        $this->errmsg = $errmsg;
    }

    /**
     * @return yii分页对象
     */
    public function getPagination()
    {
        return $this->pagination;
    }

    /**
     * @param yii分页对象 $pagination
     */
    public function setPagination($pagination)
    {
        $this->pagination = $pagination;
    }

    /**
     * @return int
     */
    public function getPerPage()
    {
        return $this->per_page;
    }

    /**
     * @param int $per_page
     */
    public function setPerPage($per_page)
    {
        $this->per_page = $per_page;
    }

    /**
     * @return mixed
     */
    public function getTotalCount()
    {
        return $this->total_count;
    }

    /**
     * @param mixed $total_count
     */
    public function setTotalCount($total_count)
    {
        $this->total_count = $total_count;
    }

    /**
     * @return int
     */
    public function getTotalPage()
    {
        return $this->total_page;
    }

    /**
     * @param int $total_page
     */
    public function setTotalPage($total_page)
    {
        $this->total_page = $total_page;
    }

}

?>
