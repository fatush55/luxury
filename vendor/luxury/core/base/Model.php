<?php


namespace luxury\base;


use luxury\Db;
use Valitron\Validator;

abstract class Model
{
    public $attrebutes = [];
    public $errors = [];
    public $routs = [];

    public function __construct()
    {
        Db::instance();
    }

    public function load($data)
    {
        foreach ($this->attrebutes as $name => $v) {
            if (isset($data[$name])) {
                $this->attrebutes[$name] = $data[$name];
            }
        }
    }

    public function validate($data)
    {
        $v = new Validator($data);
        $v->rules($this->routs);

        if ($v->validate()) {
            return true;
        }

        $this->errors = $v->errors();
        return false;
    }

    public function getError()
    {
        $errors = "<ul>";
        foreach ($this->errors as $error) {
            foreach ($error as $item) {
                $errors .= "<li>" . $item . "</li>";
            }
        }
        $errors .= "</ul>";
        $_SESSION['error'] = $errors;
    }

    public function save($table, $valid = true)
    {
        if ($valid){
            $tbl = \R::dispense($table);
        } else {
            $tbl = \R::xdispense($table);
        }

        foreach ($this->attrebutes as $name => $value) {
            $tbl->$name = $value;
        }
        return \R::store($tbl);
    }

    public function update($table, $id)
    {
        $bean = \R::load($table, $id);	
        foreach ($this->attrebutes as $name => $value) {
            $bean->$name = $value;
        }
        return \R::store($bean);
    }
}