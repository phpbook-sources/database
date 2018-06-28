    
+ [About Database](#about-database)
+ [Composer Install](#composer-install)
+ [Declare Configurations](#declare-configurations)
+ [Use Database](#use-database)

### About Database

- A lightweight DATABASE PHP extension for DOCTRINE.

### Composer Install

	composer require phpbook/database

### Declare Configurations

```php

/********************************************
 * 
 *  Declare Configurations
 * 
 * ******************************************/

//Connections

\PHPBook\Database\Configuration\Database::setConnection('main',
	(new \PHPBook\Database\Configuration\Connection)
		->setName('Main')
		->setExceptionCatcher(function(String $message) {
			//the PHPBook Database does not throw exceptions, but you can take it here
			//you can store $message in database or something else
        })
        ->setDriver([
            'driver' => 'pdo_sqlite',
            'path' => __DIR__ . '/db.sqlite'
        ])
        ->setEntitiesPathRoot('entities/root/path')
        ->setMigrationPathRoot('migration/root/path')
        ->setMigrationTable('migrations')
        ->setMigrationNamespace('\App\Migration')
);

\PHPBook\Database\Configuration\Database::setConnection('other',
	(new \PHPBook\Database\Configuration\Connection)
		->setName('Other')
		->setExceptionCatcher(function(String $message) {
			//the PHPBook Database does not throw exceptions, but you can take it here
			//you can store $message in database or something else
        })
		->setDriver([
            'driver' => 'pdo_sqlite',
            'path' => __DIR__ . '/db.sqlite'
        ])
        ->setEntitiesPathRoot('entities/root/path')
        ->setMigrationPathRoot('migration/root/path')
        ->setMigrationTable('migrations')
        ->setMigrationNamespace('\App\Migration')
);

//Set default connection by connection code

\PHPBook\Database\Configuration\Database::setDefault('main');

//Getting connections

$connections = \PHPBook\Database\Configuration\Database::getConnections();

foreach($connections as $code => $connection) {

	$connection->getName(); 

	$connection->getMeta();

};

?>
```

### Use Database

```php
		
	//Get Doctrine Entity Manager of a Connection or Null
    \PHPBook\Database\EntityManager::get('main');

    //Get Default Doctrine Entity Manager or Null 
    \PHPBook\Database\EntityManager::get();

    //Execute Doctrine Migration of a Connection. Updates to the better version available.
    \PHPBook\Database\Migration::execute('main');

    //Execute Doctrine Migration in Default Connection. Updates to the better version available.
    \PHPBook\Database\Migration::execute();

    //Execute Doctrine Migration of a Connection. Updates or Downgrades to the version 201010101010.
    \PHPBook\Database\Migration::execute('main', '201010101010');

    //Execute Doctrine Migration in Default Connection. Updates or Downgrades to the version 201010101010.
    \PHPBook\Database\Migration::execute(Null, '201010101010');
		
```

You can check the doctrine documentation to use the entity manager, migrations and other resources.