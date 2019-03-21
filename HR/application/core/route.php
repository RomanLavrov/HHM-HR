<?php
class Route
{
    public static function start()
    {
        $controller_name = 'Main';
        $action_name = 'index';

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        if (!empty($routes[2])) {
            //echo ("<br>First level: ");
            //echo ($routes[2]);
            $controller_name = $routes[2];
        }

        if (!empty($routes[3])) {
            //echo ("<br>Second level: ");
            //echo ($routes[3]);
            $action_name = $routes[3];
        }

        $model_name = 'Model_' . $controller_name;
        $controller_name = 'Controller_' . $controller_name;
        $action_name = 'action_' . $action_name;

        //echo "<br>Model: $model_name ";
        //echo "<br>Controller: $controller_name ";
        //echo "<br>Action: $action_name ";

        $model_file = strtolower($model_name) . '.php';
        $model_path = "application/models/" . $model_file;
        if (file_exists($model_path)) {
            include "application/models/" . $model_file;
        }

        $controller_file = strtolower($controller_name) . '.php';
        $controller_path = "application/controllers/" . $controller_file;

        if (file_exists($controller_path)) {
            //echo ("<br>Controller exists");
            include "application/controllers/" . $controller_file;
        } else {
            //TODO Exception
            echo("Controller not found");
            Route::ErrorPage404();
        }

        $controller = new $controller_name;
        $action = $action_name;

        if (method_exists($controller, $action)) {
            $controller->$action();
        } else {
            // TODO Exception
            Route::ErrorPage404();
        }

    }

    public function ErrorPage404()
    {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/HR/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:' . $host . '404');
    }

}
