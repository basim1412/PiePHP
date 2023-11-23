<?php

namespace Model;

use Core\Entity;

class MovieModel extends Entity
{

    function __construct()
    {
        $this->table = 'movie';
        $this->relations = array(
            'manyToMany' => 'genre',
        );
        parent::__construct();
    }
}
