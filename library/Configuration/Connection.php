<?php namespace PHPBook\Database\Configuration;

class Connection {

    private $name;

    private $exceptionCatcher;

    private $driver;

    private $entitiesPathRoot;

    private $proxiesPathRoot;

    private $proxiesNamespace;

    private $metadataCache;

    private $queryCache;

    private $migratorVersion = 'V3';

    private $migrationPathRoot;

    private $migrationTable;

    private $migrationTableColumnVersion;

    private $migrationNamespace;

    private $eventManager = null;

    public function getName(): String {
        return $this->name;
    }

    public function setName(String $name): Connection {
        $this->name = $name;
        return $this;
    }

    public function getExceptionCatcher(): ?\Closure {
        return $this->exceptionCatcher;
    }

    public function setExceptionCatcher(\Closure $exceptionCatcher): Connection {
        $this->exceptionCatcher = $exceptionCatcher;
        return $this;
    }

    public function getDriver(): ?Array {
        return $this->driver;
    }

    public function setDriver(Array $driver): Connection {
        $this->driver = $driver;
        return $this;
    }

    public function getEntitiesPathRoot(): ?String {
        return $this->entitiesPathRoot;
    }

    public function setEntitiesPathRoot(String $entitiesPathRoot): Connection {
        $this->entitiesPathRoot = $entitiesPathRoot;
        return $this;
    }

    public function getProxiesPathRoot(): ?String {
        return $this->proxiesPathRoot;
    }

    public function setProxiesPathRoot(String $proxiesPathRoot): Connection {
        $this->proxiesPathRoot = $proxiesPathRoot;
        return $this;
    }

    public function getProxiesNamespace(): ?String {
        return $this->proxiesNamespace;
    }

    public function setProxiesNamespace(String $proxiesNamespace): Connection {
        $this->proxiesNamespace = $proxiesNamespace;
        return $this;
    }

    public function getMetadataCache(): ?\Symfony\Contracts\Cache\CacheInterface {
        return $this->metadataCache;
    }

    public function setMetadataCache(\Symfony\Contracts\Cache\CacheInterface $metadataCache): Connection {
        $this->metadataCache = $metadataCache;
        return $this;
    }

    public function getQueryCache(): ?\Symfony\Contracts\Cache\CacheInterface {
        return $this->queryCache;
    }

    public function setQueryCache(\Symfony\Contracts\Cache\CacheInterface $queryCache): Connection {
        $this->queryCache = $queryCache;
        return $this;
    }

    public function getMigratorVersion(): ?String {
        return $this->migratorVersion;
    }

    public function setMigratorVersion(String $migratorVersion): Connection {
        $this->migratorVersion = $migratorVersion;
        return $this;
    }

    public function getMigrationPathRoot(): ?String {
        return $this->migrationPathRoot;
    }

    public function setMigrationPathRoot(String $migrationPathRoot): Connection {
        $this->migrationPathRoot = $migrationPathRoot;
        return $this;
    }

    public function getMigrationTable(): ?String {
        return $this->migrationTable;
    }

    public function setMigrationTable(String $migrationTable): Connection {
        $this->migrationTable = $migrationTable;
        return $this;
    }

    public function getMigrationTableColumnVersion(): ?String {
        return $this->migrationTableColumnVersion;
    }

    public function setMigrationTableColumnVersion(String $migrationTableColumnVersion): Connection {
        $this->migrationTableColumnVersion = $migrationTableColumnVersion;
        return $this;
    }

    public function getMigrationNamespace(): ?String {
        return $this->migrationNamespace;
    }

    public function setMigrationNamespace(String $migrationNamespace): Connection {
        $this->migrationNamespace = $migrationNamespace;
        return $this;
    }

    public function getEventManager(): ?\Doctrine\Common\EventManager {
        return $this->eventManager;
    }

    public function setEventManager($eventManager): Connection {
        $this->eventManager = $eventManager;
        return $this;
    }

}