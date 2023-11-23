<?php

namespace Model;

use Core\Entity;

class GenreModel extends Entity
{
    function __construct()
    {
        $this->table = 'genre';
        $this->relations = array(
            'manyToMany' => 'movie',
        );
        parent::__construct();
    }
}
