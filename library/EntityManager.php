<?php namespace PHPBook\Database;

class EntityManager {

    public function get(String $connection = Null): ?\Doctrine\ORM\EntityManager {

        if (!$connection) {
            $connection = \PHPBook\Database\Configuration\Database::getDefault();
        };

        $database = \PHPBook\Database\Configuration\Database::getConnection($connection);

        if ($database) {
            
            $configuration = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(array($database->getEntitiesPathRoot()), false);

            return \Doctrine\ORM\EntityManager::create($database->getDriver(), $configuration);

        };

        return Null;
        
    }
  
}
