<?php

namespace App\Model;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

class EntityManagerFactory
{
    public static function getEntityManager($pathToConfig): EntityManager
    {

        $file_contents = file_get_contents($pathToConfig);
        $json_data = json_decode($file_contents, true);

        $doctrine_config = ORMSetup::createAttributeMetadataConfiguration(
            ['./src/Model/Entity'],
            $json_data['is_dev']
        );
        $dbParams=$json_data['db'];
        $conn = array(
            'driver'   => $dbParams['driver'],
            'host'     => $dbParams['host'],
            'port'     => $dbParams['port'],
            'user'     => $dbParams['user'],
            'password' => $dbParams['password'],
            'charset'  => 'utf8',
            'dbname' => $dbParams['dbname']
        );
        $connection = DriverManager::getConnection(
            $conn,$doctrine_config
        );
        return new EntityManager($connection,$doctrine_config);
    }
}