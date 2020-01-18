<?php


namespace app\models\admin;


use app\models\AppModel;

class User extends AppModel
{

    public $attrebutes = [
        'id' => '',
        'login' => '',
        'password' => '',
        'email' => '',
        'name' => '',
        'address' => '',
        'role' => '',
    ];

    public $routs = [
        'required' => [
            ['login'],
            ['name'],
            ['email'],
            ['address'],
        ],
        'email' => [
            ['email']
        ],
    ];

    public function checkUnique()
    {
        $users = \R::findOne('user', "(login = ? OR email = ?) AND id <> ?",
            [$this->attrebutes['login'], $this->attrebutes['email'], $this->attrebutes['id']]);
        if ($users) {
            if ($users->login == $this->attrebutes['login']) {
                $this->errors['unique'][] = 'This login already exists';
            }
            if ($users->email == $this->attrebutes['email']) {
                $this->errors['unique'][] = 'This email already exists';
            }
            return false;
        }
        return true;
    }

    public function login($isAdmin = false)
    {
        $login = !empty(trim($_POST['login'])) ? trim($_POST['login']) : null;
        $password = !empty(trim($_POST['password'])) ? trim($_POST['password']) : null;

        if ($login && $password) {
            if ($isAdmin) {
                $user = \R::findOne('user', "login = ? AND role = 'admin'", [$login]);
            } else {
                $user = \R::findOne('user', "login = ?", [$login]);
            }
            if ($user) {
                if (password_verify($password, $user->password)) {
                    foreach ($user as $k => $v) {
                        if ($k !== 'password') $_SESSION['user'][$k] = $v;
                    }
                    return true;
                }
            }
        }
        return false;
    }

    public static function checkAuth()
    {
        return isset($_SESSION['user']);
    }
}