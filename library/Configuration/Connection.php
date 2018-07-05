<?php namespace PHPBook\Database\Configuration;

class Connection {
    
	private $name;

	private $exceptionCatcher;

	private $driver;

	private $entitiesPathRoot;

	private $proxiesPathRoot;

	private $proxiesNamespace;

	private $proxyCacheDriver;
	
	private $migrationPathRoot;

	private $migrationTable;

	private $migrationNamespace;

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

	public function getProxyCacheDriver(): ?\Doctrine\Common\Cache\CacheProvider {
		return $this->proxyCacheDriver;
	}

	public function setProxyCacheDriver(\Doctrine\Common\Cache\CacheProvider $proxyCacheDriver): Connection {
		$this->proxyCacheDriver = $proxyCacheDriver;
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

	public function getMigrationNamespace(): ?String {
		return $this->migrationNamespace;
	}

	public function setMigrationNamespace(String $migrationNamespace): Connection {
		$this->migrationNamespace = $migrationNamespace;
		return $this;
	}

}