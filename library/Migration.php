<?php namespace PHPBook\Database;

abstract class Migration {
    
    public static function execute(String $connection = Null, $version = Null) {

        if (!$connection) {
            $connection = \PHPBook\Database\Configuration\Database::getDefault();
        };

        $database = \PHPBook\Database\Configuration\Database::getConnection($connection);

        if ($database) {

            $connection = \Doctrine\DBAL\DriverManager::getConnection($database->getDriver());

            $configuration = new \Doctrine\DBAL\Migrations\Configuration\Configuration($connection);
    
            $configuration->setMigrationsTableName($database->getMigrationTable());
    
            $configuration->setMigrationsNamespace($database->getMigrationNamespace());
    
            $configuration->setMigrationsDirectory($database->getMigrationPathRoot());
    
            $configuration->registerMigrationsFromDirectory($configuration->getMigrationsDirectory());
    
            $migration = new \Doctrine\DBAL\Migrations\Migration($configuration);
            
            $migration->migrate($version);
    
        };

    }
  
}
