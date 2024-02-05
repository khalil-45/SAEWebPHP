<?php

namespace app;

class Autoloader{
    /**
     * Enregistre notre autoloader
     */
    public static function register(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    public static function autoload($className){
        // Vérifie si la classe commence par "app"
        $namespace = 'app\\';
        $namespaceLength = strlen($namespace);
        if (strncmp($namespace, $className, $namespaceLength) !== 0) { // Comparaison binaire des $namespaceLength premiers caractères de $className et $namespace
            return;
        }

        // Remplace le namespace par le chemin vers le dossier
        $filePath = __DIR__ . '/' . str_replace('\\', '/', substr($className, $namespaceLength)) . '.php';

        // Vérifie si le fichier existe
        if (file_exists($filePath)) {
            require_once $filePath;
        }
        
    }

    
}

Autoloader::register(); // Enregistre l'autoload