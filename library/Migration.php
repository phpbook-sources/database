<?php namespace PHPBook\Database;

use Doctrine\Migrations\MigrationRepository;
use Doctrine\Migrations\Migrator;
use Doctrine\Migrations\Tools\Console\Command;
use Doctrine\Migrations\Version\Factory;

abstract class Migration {

    public static function execute(String $connection = Null, $version = Null) {

        $database = \PHPBook\Database\Configuration\Database::getConnection($connection);

        if ($database) {

            if ($database->getMigratorVersion() === \PHPBook\Database\Configuration\MigratorVersion::$V2) {

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

            } else {

                $databaseConnection = \Doctrine\DBAL\DriverManager::getConnection($database->getDriver());

                $allOrNothing = true;

                $metadataStorageConfiguration = new \Doctrine\Migrations\Metadata\Storage\TableMetadataStorageConfiguration();

                $metadataStorageConfiguration->setTableName($database->getMigrationTable());

                $metadataStorageConfiguration->setVersionColumnName($database->getMigrationTableColumnVersion());

                $configuration = new \Doctrine\Migrations\Configuration\Configuration($databaseConnection);

                $configuration->setMetadataStorageConfiguration($metadataStorageConfiguration);

                $configuration->addMigrationsDirectory($database->getMigrationNamespace(), $database->getMigrationPathRoot());

                $configuration->setAllOrNothing($allOrNothing);

                $factory = \Doctrine\Migrations\DependencyFactory::fromConnection(
                    new \Doctrine\Migrations\Configuration\Migration\ExistingConfiguration($configuration),
                    new \Doctrine\Migrations\Configuration\Connection\ExistingConnection($databaseConnection)
                );

                if ($version) {

                    $planUntilVersion = $factory->getMigrationPlanCalculator()->getPlanUntilVersion(new \Doctrine\Migrations\Version\Version($version));


                } else {

                    $planUntilVersion = $factory->getMigrationPlanCalculator()->getPlanUntilVersion($factory->getVersionAliasResolver()->resolveVersionAlias('latest'));

                }

                $factory->getMetadataStorage()->ensureInitialized();

                $factory->getMigrator()->migrate($planUntilVersion, (new \Doctrine\Migrations\MigratorConfiguration())->setAllOrNothing(false));

            }

        };

    }

}
