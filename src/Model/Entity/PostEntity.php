<?php

namespace App\Model\Entity;

use App\Model\Repository\PostEntityRepository;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity(repositoryClass: PostEntityRepository::class)]
#[Table('posts_table')]
class PostEntity
{
    #[Id, Column(), GeneratedValue]
    private int $id;
    #[Column(name: "created_at")]
    private \DateTime $createdAt;
    #[Column]
    private string $author;
    #[Column]
    private string $message;

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param string $author
     * @param string $message
     */
    public function __construct(string $author, string $message)
    {
        $this->author = $author;
        $this->message = $message;
        $this->createdAt = new \DateTime();
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }


}