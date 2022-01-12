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

                $metadataCache = $database->getMetadataCache();
                $queryCache = $database->getQueryCache();
                $configuration = new \Doctrine\ORM\Configuration;
                if ($metadataCache) {
                    $configuration->setMetadataCache($metadataCache);
                }
                if ($queryCache) {
                    $configuration->setQueryCache($queryCache);
                }
                $driverImpl = $configuration->newDefaultAnnotationDriver($database->getEntitiesPathRoot());
                $configuration->setMetadataDriverImpl($driverImpl);
                $configuration->setProxyDir($database->getProxiesPathRoot());
                $configuration->setProxyNamespace($database->getProxiesNamespace());
                $configuration->setAutoGenerateProxyClasses(false);

                Static::$connections[$connection] = \Doctrine\ORM\EntityManager::create($database->getDriver(), $configuration, $database->getEventManager());
    
            } else {

                return Null;

            };

        }

        return Static::$connections[$connection];
        
    }
  
}
