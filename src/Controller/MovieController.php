<?php

namespace Controller;

use Core\Controller;
use Model\MovieModel;

class MovieController extends Controller
{

    function showAction()
    {
        $model = new MovieModel();

        $result = $model->findAll();

        $this->render('list', array('movies' => $result));
    }

    function showDetailAction($args = [])
    {
        $movieId = $args[0] ?? null;

        if ($movieId == null) {
            echo "Faut fournir un id";
            return;
        }

        $model = new MovieModel();

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

        $this->render('detail', array('movies' => $result));
    }
}
