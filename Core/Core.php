<?php

namespace Core;

require_once('./src/View/Error/404.php');

class Core
{
    // public function run()
    // {
    //     require_once './src/routes.php';
    //     $BASE_URL = "/PiePHP";
    //     $requested_url = substr($_SERVER["REQUEST_URI"], strlen($BASE_URL));
    //     $route = Router::get($requested_url);
    //     if ($route != null) {
    //         $controllerName = "Controller\\" . $route["controller"] . "Controller";
    //         $actionName = $route['action'] . "Action";

    //         if (method_exists($controllerName, $actionName)) {
    //             $reflectionMethod = new \ReflectionMethod($controllerName, $actionName);
    //             if ($reflectionMethod->isStatic()) {
    //                 call_user_func("$controllerName::$actionName");
    //             } else {
    //                 $controllerInstance = new $controllerName();
    //                 call_user_func([$controllerInstance, $actionName]);
    //             }
    //         } else {
    //             echo "La méthode '$actionName' n'existe pas dans le contrôleur '$controllerName'.";
    //         }
    //     }
    // }


    public function run()
    {
        $BASE_URL = "/PiePHP";
        $requested_url = substr($_SERVER["REQUEST_URI"], strlen($BASE_URL));
        $segments = explode('/', trim($requested_url, '/'));

        $controllerName = isset($segments[0]) && !empty($segments[0]) ? ucfirst($segments[0]) : 'App';
        $actionName = isset($segments[1]) && !empty($segments[1]) ? $segments[1] : 'index';

        $controllerName = "Controller\\" . $controllerName . "Controller";
        $actionName .= "Action";

        $args = count($segments) <= 2 ? [] : array_slice($segments, 2);

        if (class_exists($controllerName)) {
            if (method_exists($controllerName, $actionName)) {
                $controllerInstance = new $controllerName();
                call_user_func([$controllerInstance, $actionName], $args);
            } else {
                $err = new \Error404();
                $err->error404();
            }
        } else {
            $err = new \Error404();
            $err->error404();
        }
    }
}
