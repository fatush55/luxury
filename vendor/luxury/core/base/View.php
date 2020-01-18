<?php


namespace luxury\base;


class View
{
    public $route;
    public $controller;
    public $view;
    public $layout;
    public $prefix;
    public $data = [];
    public $meta = [];
    protected $script;
    protected $style;


    public function __construct($route, $layout = '', $view = '', $meta)
    {
        $this->route = $route;
        $this->controller = $route['controller'];
        $this->view = $view;
        $this->layout = $layout;
        $this->prefix = $route['prefix'];
        $this->meta = $meta;
        if ($layout === false) {
            $this->layout = false;
        } else {
            $this->layout = $layout ?: LAYOUT;
        }
    }

    public function render($data)
    {
        if (is_array($data)) extract($data);
        $this->prefix =  str_replace('\\', '/', $this->prefix);
        $viewFile = APP . "/views/{$this->prefix}{$this->controller}/{$this->view}.php";
        if (is_file($viewFile)) {
            ob_start();
            require_once $viewFile;
            $content = ob_get_clean();
        } else {
            throw new \Exception("View | {$viewFile} | dot fount", 500);
        }
        if ($this->layout !== false) {
            $layoutFile = APP . "/views/layouts/{$this->layout}.php";
            if (is_file($layoutFile)) {

                $content = $this->getScript($content);
                $scripts = [];
                if ($this->script[0]){
                    $scripts = $this->script[0];
                }

                $content = $this->getStyle($content);
                $styles = [];
                if ($this->style[0]){
                    $styles = $this->style[0];
                }

                require_once $layoutFile;
            } else {
                throw new \Exception("View | {$layoutFile} | dot fount", 500);
            }
        }
    }

    public function getMeta()
    {
        $output = "<title>{$this->meta['title']}</title>" . PHP_EOL;
        $output .= "    <meta name='keywords' content='{$this->meta['keywords']}'>" . PHP_EOL;
        $output .= "    <meta name='description' content='{$this->meta['desc']}'>" . PHP_EOL;

        return $output;
    }

    public function getScript($content)
    {
        $pattern = "#<script.*?>.*?</script>#si";
        preg_match_all($pattern, $content, $this->script);
        if ($this->script){
            $content = preg_replace($pattern, '', $content);
        }
        return $content;
    }

    public function getStyle($content)
    {
        $pattern = "#<link.*?>#si";
        preg_match_all($pattern, $content, $this->style);
        if ($this->style){
            $content = preg_replace($pattern, '', $content);
        }
        return $content;

    }
}