<?php namespace PHPBook\Database;

use Doctrine\Migrations\MigrationRepository;
use Doctrine\Migrations\Migrator;
use Doctrine\Migrations\Tools\Console\Command;
use Doctrine\Migrations\Version\Factory;

abstract class Migration {
    
    public static function execute(String $connection = Null, $version = Null) {

        $database = \PHPBook\Database\Configuration\Database::getConnection($connection);

        if ($database) {

            $databaseConnection = \Doctrine\DBAL\DriverManager::getConnection($database->getDriver());

            $allOrNothing = true;

            $configuration = new \Doctrine\Migrations\Configuration\Configuration($databaseConnection);
    
            $configuration->setMigrationsTableName($database->getMigrationTable());
            
            $configuration->setMigrationsColumnName($database->getMigrationTableColumnVersion());
    
            $configuration->setMigrationsNamespace($database->getMigrationNamespace());
    
            $configuration->setMigrationsDirectory($database->getMigrationPathRoot());
    
            $configuration->registerMigrationsFromDirectory($configuration->getMigrationsDirectory());

            $configuration->setAllOrNothing($allOrNothing);

            $factory = new \Doctrine\Migrations\DependencyFactory($configuration);

            $migrator = new \Doctrine\Migrations\Migrator($configuration, $factory->getMigrationRepository(), $factory->getOutputWriter(), $factory->getStopwatch());

            $migrator->migrate($version);
    
        };

    }
  
}
