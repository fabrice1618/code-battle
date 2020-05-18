<?php

namespace Router;

class Route
{

    /**
     * @var string chemin de redirection
     */
    public $path;

    /**
     * @var string action à effectuer
     */
    public $action;

    /**
     * @var array 
     */
    public $matches;

    public function __construct($path, $action)
    {
        //trim — Supprime les espaces (ou d'autres caractères) en début et fin de chaîne
        $this->path = trim($path, "/");
        $this->action = $action;
    }

    public function matches(string $url)
    {
        //preg_replace — Rechercher et remplacer par expression rationnelle standard
        $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->path);
        $pathToMatch = "#^$path$#";

        if (preg_match($pathToMatch, $url, $matches)) {
            $this->matches = $matches;
            return true;
        } else{
            return false;
        }
    }

    public function execute()
    {
        $params = explode('@', $this->action);
        $controller = new $params[0]();
        $method = $params[1];

        return isset($this->matches[1]) ? $controller->$method($this->matches[1]) : $controller->$method();
    }
}