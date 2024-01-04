<?php


use App\Model\EntityManagerFactory;
use Doctrine\ORM\EntityManager;

function GetEntityManager ($pathToConfig): EntityManager
{
  return EntityManagerFactory::getEntityManager($pathToConfig);
}
