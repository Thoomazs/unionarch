<?php


    function controller() {
        $controller = explode('\\', substr(Route::currentRouteAction(), 0, (strpos(Route::currentRouteAction(), '@') -0) ) );
        $controller = $controller[ count($controller) -1 ];
        return substr($controller, 0, (strpos($controller, 'Controller') -0));
    }


