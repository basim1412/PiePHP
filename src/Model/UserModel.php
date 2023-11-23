<?php

namespace Model;

use Core\Entity;

class UserModel extends Entity
{
    protected $table = 'user';
    public $id;
    public $email;
    public $password;
    public $firstname;
    public $lastname;
    public $birthdate;
    public $address;
    public $zipcode;
    public $city;
    public $country;

    public function isEmailUnique($email)
    {
        $result = $this->findAll($email);
        return count($result) === 0;
    }

    public function login()
    {
        $result = $this->findAll(array('email' => $this->email, 'password' => $this->password));
        return $result[0] ?? null;
    }
}
