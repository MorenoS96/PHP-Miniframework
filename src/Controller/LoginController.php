<?php

namespace App\Controller;

use App\Model\Entity\UserEntity;
use MorenoGeneralProbeFrameWork\http\Response;

class LoginController extends AbstractController
{
    public function view(?string $message=null)
    {
        $this->view->renderFromResponse(new Response($message), $this->view::PATH_TO_LOGIN_UP_LAYOUT);
    }

    public function login($email,$password) //model
    {
     $results =   $this->em->getRepository(UserEntity::class)->findBy(array('email'=>$email,
            'password'=> hash('sha256',$password)
            ));
     if(count($results)>0){
         $_SESSION['user-name']=$results[0]->getEmail();
         header("Location: /?msg=logged in");
         die();
     }
        header("Location: /?msg=not logged in");
        die();
    }
    public function logout()
    {
        session_unset(); // Unset all session variables
        session_destroy();
        header("Location: /");
        die();
    }
}