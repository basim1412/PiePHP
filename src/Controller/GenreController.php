<?php

namespace Controller;

use Core\Controller;
use Model\GenreModel;

class GenreController extends Controller
{
    function showAction()
    {
        $model = new GenreModel();

        $result = $model->findAll();

        $this->render('genre', array('genres' => $result));
    }

    function showDetailAction($args = [])
    {
        $movieId = $args[0] ?? null;

        if ($movieId == null) {
            echo "Faut fournir un id";
            return;
        }

        $model = new GenreModel();

        $result = $model->findAll(
            array(
                "id" => $movieId
            )
        );

        $result = $result[0] ?? null;

        if ($result == null) {
            echo "Film pas trouvé";
            return;
        }

        $this->render('glist', array('genres' => $result));
    }
}
