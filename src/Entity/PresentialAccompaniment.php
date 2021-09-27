<?php

namespace App\Entity;

use App\Repository\PresentialAccompanimentRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=PresentialAccompanimentRepository::class)
 * @Vich\Uploadable
 */
class PresentialAccompaniment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(type="string", length=128)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $featuredImage;

    /**
     * @Vich\UploadableField(mapping="featured_images", fileNameProperty="featured_image")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $featuredImageAlt;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $totalPlacesNb;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $registeredPeople;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="boolean")
     */
    private $published;

    /**
     * @var \DateTime $createdAt
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime $updatedAt
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $keyWordsString;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getFeaturedImage(): ?string
    {
        return $this->featuredImage;
    }

    public function setFeaturedImage(?string $featuredImage): self
    {
        $this->featuredImage = $featuredImage;

        return $this;
    }

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function getFeaturedImageAlt(): ?string
    {
        return $this->featuredImageAlt;
    }

    public function setFeaturedImageAlt(?string $featuredImageAlt): self
    {
        $this->featuredImageAlt = $featuredImageAlt;

        return $this;
    }

    public function getTotalPlacesNb(): ?int
    {
        return $this->totalPlacesNb;
    }

    public function setTotalPlacesNb(?int $totalPlacesNb): self
    {
        $this->totalPlacesNb = $totalPlacesNb;

        return $this;
    }

    public function getRegisteredPeople(): ?string
    {
        return $this->registeredPeople;
    }

    public function setRegisteredPeople(?string $registeredPeople): self
    {
        $this->registeredPeople = $registeredPeople;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getPublished(): ?bool
    {
        return $this->published;
    }

    public function setPublished(bool $published): self
    {
        $this->published = $published;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getKeyWordsString(): ?string
    {
        return $this->keyWordsString;
    }

    public function setKeyWordsString(?string $keyWordsString): self
    {
        $this->keyWordsString = $keyWordsString;

        return $this;
    }
}
