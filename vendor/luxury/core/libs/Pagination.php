<?php


namespace luxury\libs;


class Pagination
{

    public $currentPage;
    public $perpage;
    public $total;
    public $countPages;
    public $uri;

    public function __construct($page, $perpage, $total)
    {
        $this->perpage = $perpage;
        $this->total = $total;
        $this->countPages = $this->getCountPage();
        $this->currentPage = $this->getCurrentPage($page);
        $this->uri = $this->getParams();
    }

    public function __toString()
    {
        return $this->getHtml();
    }

    public function getCountPage()
    {
        return ceil($this->total / $this->perpage) ?: 1;
    }

    public function getCurrentPage($page)
    {
        if (!$page || $page < 1) $page = 1;
        if ($page > $this->countPages) $page = $this->countPages;
        return $page;
    }

    public function getStart()
    {
        return ($this->currentPage - 1) * $this->perpage;
    }

    public function getParams()
    {
        $url = $_SERVER['REQUEST_URI'];
        /*filter_ajax_request-start*/
        preg_match_all("#filter=[\d,&]#", $url, $matches);
        if (count($matches[0]) > 1) {
            $url = preg_replace("#filter=[\d,&]+#", '', $url, 1);
        }
        /*filter_ajax_request-end*/

        $url = explode('?', $url);
        $uri = $url[0] . '?';
        if (isset($url[1]) && $url[1] != '') {
            $params = explode('&', $url[1]);
            foreach ($params as $param) {
                if (!preg_match('#page=#', $param)) $uri .= "{$param}&";
            }
        }
        return urldecode($uri);
    }

    public function getHtml()
    {
        $back = null;
        $forvard = null;
        $srartpage = null;
        $endpage = null;
        $page2left = null;
        $page1left = null;
        $page1right = null;
        $page2right = null;

        if ($this->currentPage > 1) {
            $back = "<li class='page-item'><a class='page-link' href='" . $this->uri . 'page=' . ($this->currentPage - 1) . "'>&#8249;</a> </li>";
        }

        if ($this->currentPage < $this->countPages) {
            $forvard = "<li class='page-item'><a class='page-link' href='" . $this->uri . 'page=' . ($this->currentPage + 1) . "'>&#8250;</a> </li>";
        }

        if ($this->currentPage > 3) {
            $srartpage = "<li class='page-item'><a class='page-link' href='" . $this->uri . 'page=' . 1 . "'>&laquo;</a> </li>";
        }

        if ($this->currentPage <= ($this->countPages - 3)) {
            $endpage = "<li class='page-item'><a class='page-link' href='" . $this->uri . 'page=' . $this->countPages . "'>&raquo;</a> </li>";
        }

        if ($this->currentPage >= 3) {
            $page2left = "<li class='page-item'>
<a class='page-link' href='" . $this->uri . 'page=' . ($this->currentPage - 2) . "'>" . ($this->currentPage - 2) . "</a> </li>";
        }

        if ($this->currentPage >= 2) {
            $page1left = "<li class='page-item'>
<a class='page-link' href='" . $this->uri . 'page=' . ($this->currentPage - 1) . "'>" . ($this->currentPage - 1) . "</a> </li>";
        }

        if ($this->currentPage <= ($this->countPages - 1)) {
            $page1right = "<li class='page-item'>
<a class='page-link' href='" . $this->uri . 'page=' . ($this->currentPage + 1) . "'>" . ($this->currentPage + 1) . "</a> </li>";
        }

        if ($this->currentPage <= ($this->countPages - 2)) {
            $page2right = "<li class='page-item'>
<a   class='page-link' href='" . $this->uri . 'page=' . ($this->currentPage + 2) . "'>" . ($this->currentPage + 2) . "</a> </li>";
        }

        return "<ul class='pagination'>" . $srartpage . $back . $page2left . $page1left . "
        <li class='page-item active'><a class='page-link' href='" . $this->uri . 'page=' . $this->currentPage . "'>" . $this->currentPage . "</a></li>
        " . $page1right . $page2right . $forvard . $endpage . "</ul>";
    }
}