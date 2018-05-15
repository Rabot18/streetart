<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArtworkRepository")
 */
class Artwork
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="boolean")
     */
    private $enabled;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $endedAt;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $tags;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="Poi", inversedBy="artworks")
     */
    private $poi;

    /**
     * @ORM\OneToMany(targetEntity="Document", mappedBy="artwork")
     */
    private $documents;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Author", inversedBy="artwork")
     */
    private $author;

    /**
     * Artwork constructor.
     */
    public function __construct()
    {
        $this->documents = new ArrayCollection();
        $this->createdAt = new \DateTime();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Artwork
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return mixed
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param mixed $enabled
     * @return Artwork
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeInterface $createdAt
     * @return Artwork
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }


    /**
     * @return \DateTimeInterface|null
     */
    public function getEndedAt(): ?\DateTimeInterface
    {
        return $this->endedAt;
    }

    /**
     * @param \DateTimeInterface $endedAt
     * @return Artwork
     */
    public function setEndedAt(\DateTimeInterface $endedAt): self
    {
        $this->endedAt = $endedAt;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getTags(): ?array
    {
        return $this->tags;
    }

    /**
     * @param array|null $tags
     * @return Artwork
     */
    public function setTags(?array $tags): self
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Artwork
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPoi()
    {
        return $this->poi;
    }

    /**
     * @param mixed $poi
     *
     * @return Artwork
     */
    public function setPoi($poi)
    {
        $this->poi = $poi;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDocuments()
    {
        return $this->documents;
    }

    /**
     * @param Document $document
     */
    public function addDocument(Document $document)
    {
        if (!$this->documents->contains($document)) {
            $this->documents->add($document);
        }
    }

    /**
     * @param Document $document
     */
    public function removeDocument(Document $document)
    {
        $this->documents->removeElement($document);
    }

    /**
     * @param mixed $documents
     *
     * @return Artwork
     */
    public function setDocuments($documents)
    {
        $this->documents = $documents;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     *
     * @return Artwork
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->id.' - '.$this->title.' - '.$this->type;
    }
}
