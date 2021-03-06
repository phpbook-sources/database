<?php namespace PHPBook\Database;

abstract class Proxy {
    
    private static function clearPathRecursive($dir, $initial = true) { 

        $files = array_diff(scandir($dir), array('.','..')); 

        foreach ($files as $file) { 
            (is_dir("$dir/$file")) ? Static::clearPathRecursive("$dir/$file", false) : unlink("$dir/$file"); 
        };

        if (!$initial) {
            return rmdir($dir); 
        };

    }

    public static function generate(String $connection = Null) {

        $entityManager = \PHPBook\Database\EntityManager::get($connection);

        if ($entityManager) {

        	$database = \PHPBook\Database\Configuration\Database::getConnection($connection);
            
            Static::clearPathRecursive($database->getProxiesPathRoot());

            $proxyFactory = $entityManager->getProxyFactory();

            $metadatas = $entityManager->getMetadataFactory()->getAllMetadata();

            $proxyFactory->generateProxyClasses($metadatas, null);
    
        };

    }
  
}