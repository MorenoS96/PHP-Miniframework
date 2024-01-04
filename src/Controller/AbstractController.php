<?php

namespace App\Controller;

use App\Model\EntityManagerFactory;
use App\View\SimpleView;
use Doctrine\ORM\EntityManager;

abstract class AbstractController
{
    protected EntityManager $em;
    protected SimpleView $view;
    public function __construct()
    {
        $this->em=EntityManagerFactory::getEntityManager(BASE_PATH.'/config.json');
        $this->view=new SimpleView();
    }
    protected function saveEntity($obj)
    {
        $this->em->persist($obj);
        $this->em->flush();
    }

    protected  function checkLogin() :bool
    {
        return false;
    }
}