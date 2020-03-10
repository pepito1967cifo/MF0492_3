<?php

namespace Core;

abstract class Controller{
    // método que se llama desde el FrontController y comprueba si existe el metodo del controlador de la APP (ya que hereda de éste)
    public function callAction($action, $params = []){
        // Concateno el string 'Action' en la acción para nombrarlo en los controladores de la App
        $method = $action . 'Action';
        // En $this tengo el objeto del controlador ($controller) que llama a este método en 'FrontController'
        if(method_exists($this, $method)){

            $array_params = [$params];
            // llamada al método de una clase enviando parámetros a dicho método
            // analogía: $controller->$method([$params]);
            // $controller = new HomeController;
            // $controller->indexAction($array_params);
            call_user_func_array([$this, $method], $array_params);

        } else { echo 'Acción (método): "' . $method . '" no encontrada en el controlador'; }
    }
    // El controlador del Core es el que se encarga de renderizar la vista
    public function renderView($view, $params, $render){
        // Si recibe un FALSE en el 3er parámetro, renderiza la vista con el primer render de la clase View, sino con el Twig
        if($render){ View::renderTwig($view, $params); }
        else{ View::render($view); }
    }
}
