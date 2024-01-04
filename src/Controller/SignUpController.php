<?php

namespace App\Controller;

use App\Model\Entity\UserEntity;
use App\Model\EntityManagerFactory;
use App\View\SimpleView;
use Doctrine\ORM\EntityManager;
use MorenoGeneralProbeFrameWork\http\Response;

class SignUpController extends AbstractController
{


    public function view()
    {
        $response=new Response("hello From SignUp");
        $view=$this->view;
        $view->renderFromResponse($response,$view::PATH_TO_SIGN_UP_LAYOUT);
    }

    public function register(string $firstName, string $lastName, string $email, string $password)
    {
        ob_start();
        $hashedPassword=hash('sha256',$password);
        $user=new UserEntity($firstName,$lastName,$email,$hashedPassword);

        $this->saveEntity($user);

        //signUp
        ob_get_clean();
        header("Location: /?msg='registered'");
    }
}