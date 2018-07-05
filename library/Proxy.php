<?php namespace PHPBook\Database;

abstract class Proxy {
    
    public static function generate(String $connection = Null) {

        $entityManager = \PHPBook\Database\EntityManager::get($connection);

        if ($entityManager) {

            $proxyFactory = $entityManager->getProxyFactory();

            $metadatas = $entityManager->getMetadataFactory()->getAllMetadata();

            $proxyFactory->generateProxyClasses($metadatas, null);
    
        };

    }
  
}