<?php

namespace App\Controller;

use App\Model\Entity\PostEntity;
use App\Model\EntityManagerFactory;
use App\View\SimpleView;
use Doctrine\ORM\EntityManager;
use MorenoGeneralProbeFrameWork\http\Response;


class PostsController extends AbstractController
{
    public SimpleView $view;


    public function __construct()
    {
        parent::__construct();
        $this->view = new SimpleView();

    }

    public function view()
    {
        ob_start();
        include $this->view::PATH_TO_LAYOUT_FOLDER . '/FormLayout.html';
        $form = ob_get_clean();
        $results = $this->em->getRepository(PostEntity::class)->findBy(array(),array('createdAt'=>'DESC'));
        $listString = "";

        if (count($results) > 0) {

            $listString = "<div class='container-md'> <ul style='white-space: pre-line'>";
            foreach ($results as $result) {
                $author = $result->getAuthor();
                $message = $result->getMessage();
                $createdAt=$result->getCreatedAt()->format('d-m-Y H:i:s');;

                $listString = $listString . "<li>$author: <br>$message<br>$createdAt </li>";
            }
            $listString = $listString . "</div></ul>";
        }


        $response = new Response($listString . "<br><hr>" . $form);
        $this->view->renderFromResponse($response, $this->view::PATH_TO_BASIC_LAYOUT);
    }

    public function create(string $author, string $message)
    {
        $post = new PostEntity($author, $message);
        $this->em->persist($post);
        $this->em->flush();
        $this->view();
    }

}