<?php

namespace Controller;

use Core\Controller;
use Model\UserModel;
use \Core\Database;
use Core\Request;

class AppController extends Controller
{
    protected $request;

    public function __construct()
    {
        $this->request = new Request();
    }

    public function indexAction()
    {
        $this->render('index');
    }
}
