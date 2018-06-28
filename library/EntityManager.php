<?php namespace PHPBook\Database;

abstract class EntityManager {

    private static $connections = [];

    public static function get(String $connection = Null): ?\Doctrine\ORM\EntityManager {

        if (!$connection) {

            $connection = \PHPBook\Database\Configuration\Database::getDefault();

        };

        if (!isset(Static::$connections[$connection])) {

            $database = \PHPBook\Database\Configuration\Database::getConnection($connection);

            if ($database) {
                
                $configuration = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(array($database->getEntitiesPathRoot()), false);
    
                Static::$connections[$connection] = \Doctrine\ORM\EntityManager::create($database->getDriver(), $configuration);
    
            };
    
            return Null;

        }

        return Static::$connections[$connection];
        
    }
  
}
