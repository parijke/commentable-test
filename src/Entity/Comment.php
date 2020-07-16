<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Entity(repositoryClass=CommentRepository::class)
 */
class Comment
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="string")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $body;

    /**
     * @return mixed
     */
    public function getParentId()
    {
        return $this->parent_id;
    }

    /**
     * @param mixed $parent_id
     */
    public function setParentId($parent_id): void
    {
        $this->parent_id = $parent_id;
    }

    /**
     * @return mixed
     */
    public function getParentType()
    {
        return $this->parent_type;
    }

    /**
     * @param mixed $parent_type
     */
    public function setParentType($parent_type): void
    {
        $this->parent_type = $parent_type;
    }

    /**
     * @ORM\Column(type="string")
     */
    private $parent_id;

    /**
     * @ORM\Column(type="string")
     */
    private $parent_type;

    public function __construct(object $object)
    {
        $this->id = Uuid::v4();
        $this->parent_id = $object->getId();
        $this->parent_type = get_class($object);
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }
}
