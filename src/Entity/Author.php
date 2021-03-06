<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AuthorRepository")
 * @Vich\Uploadable
 */
class Author
{
    use TimestampableEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\Column(type="boolean", options={"default":false})
     */
    private $enabled;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $biography;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\NotBlank()
     */
    private $biographyEn;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Url
     */
    private $websiteLink;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Url
     */
    private $instagramLink;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="artworks")
     * @Assert\Valid()
     */
    private $contributor;

    /**
     * @Vich\UploadableField(mapping="author_avatar", fileNameProperty="avatarName")
     * @Assert\File(
     *     maxSize = "2M",
     *     mimeTypes = {"image/jpeg"},
     *     mimeTypesMessage = "Please upload a valid JPG"
     * )
     *
     * @var File
     */
    private $avatarFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $avatarName;

    /**
     * @ORM\ManyToMany(targetEntity="Artwork", mappedBy="author")
     */
    private $artworks;

    /**
     * Author constructor.
     */
    public function __construct()
    {
        $this->artworks = new ArrayCollection();
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->enabled = false;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
     *
     * @return Author
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function getBiography(): ?string
    {
        return $this->biography;
    }

    public function setBiography(?string $biography): self
    {
        $this->biography = $biography;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBiographyEn()
    {
        return $this->biographyEn;
    }

    /**
     * @param mixed $biographyEn
     *
     * @return Author
     */
    public function setBiographyEn($biographyEn)
    {
        $this->biographyEn = $biographyEn;

        return $this;
    }

    /**
     * @return User
     */
    public function getContributor(): ?User
    {
        return $this->contributor;
    }

    /**
     * @param User $contributor
     *
     * @return Author
     */
    public function setContributor(?User $contributor): self
    {
        $this->contributor = $contributor;

        return $this;
    }

    /**
     * @return File
     */
    public function getAvatarFile(): ?File
    {
        return $this->avatarFile;
    }

    /**
     * @param File $avatarFile
     *
     * @return Author
     */
    public function setAvatarFile(File $avatarFile): self
    {
        $this->avatarFile = $avatarFile;

        if (null !== $avatarFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime();
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getAvatarName(): ?string
    {
        return $this->avatarName;
    }

    /**
     * @param string $avatarName
     *
     * @return Author
     */
    public function setAvatarName(string $avatarName): self
    {
        $this->avatarName = $avatarName;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getWebsiteLink()
    {
        return $this->websiteLink;
    }

    /**
     * @param mixed $websiteLink
     *
     * @return Author
     */
    public function setWebsiteLink($websiteLink)
    {
        $this->websiteLink = $websiteLink;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getInstagramLink()
    {
        return $this->instagramLink;
    }

    /**
     * @param mixed $instagramLink
     *
     * @return Author
     */
    public function setInstagramLink($instagramLink)
    {
        $this->instagramLink = $instagramLink;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getArtworks()
    {
        return $this->artworks;
    }

    /**
     * @param mixed $artworks
     *
     * @return Author
     */
    public function setArtworks($artworks)
    {
        $this->artworks = $artworks;

        return $this;
    }
}
