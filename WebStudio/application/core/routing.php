<?php
    class Routing{
        static function execute(){
            $controllerName = 'main';
            $actionName = 'index';
            $piecesOfUrl = explode('/', $_SERVER['REQUEST_URI']);

            if (!empty($piecesOfUrl[2])){
                $controllerName = $piecesOfUrl[2];
            }
            if (!empty($piecesOfUrl[3])){
                $actionName = $piecesOfUrl[3];
            }
            $modelName = 'Model_' . $controllerName;
            $controllerName = 'Controller_' .$controllerName;
            $actionName = 'action_' . $actionName;

            $modelFile = strtolower($modelName) . '.php';
            $modelFilePath = "application/models/" . $modelFile;
            if (file_exists($modelFilePath)){
                include $modelFilePath;
            }

            $controllerFile = strtolower($controllerName) . '.php';

            $controllerFilePath = 'application/controllers/' . $controllerFile;

            include $controllerFilePath;

            if ($controllerName != "Controller_photo" and $controllerName != "Controller_css") {
                $controller = new $controllerName;
                $action = $actionName;
                if (method_exists($controller, $action)) {
                    call_user_func(array($controller, $actionName), $piecesOfUrl);
                }
            }
        }
    }