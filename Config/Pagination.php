<?php

namespace Config;

class Pagination
{
    public $cur_page;
    public $total;
    public $per_page;

    function __construct($cur_page, $total, $per_page)
    {
        $this->cur_page = $cur_page;
        $this->total = $total;
        $this->per_page = $per_page;
    }

    function getTotalPages()
    {
        return ceil($this->total / $this->per_page);
    }

    function hasPrevPage()
    {
        if ($this->cur_page > 1) {
            return true;
        } else {
            return false;
        }
    }

    function hasNextPage()
    {
        if ($this->cur_page < $this->getTotalPages()) {
            return true;
        } else {
            return false;
        }
    }

    function offSet()
    {
        return ($this->cur_page - 1) * $this->per_page;
    }
}

$total = 12;
$per_page = 5;
$cur_page = 1;

$pagination = new Pagination($cur_page, $total, $per_page);
$offSet = $pagination->offSet();
$query = "SELECT * FROM users ORDER BY id ASC LIMIT {$offSet}, {$per_page}";
