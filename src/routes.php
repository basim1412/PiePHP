<?php

use Core\Router;

Router::connect('/', ['controller' => 'App', 'action' => 'index']);
Router::connect('/register', ['controller' => 'User', 'action' => 'add']);
Router::connect('/login', ['controller' => 'User', 'action' => 'login']);
Router::connect('/show', ['controller' => 'User', 'action' => 'show']);
