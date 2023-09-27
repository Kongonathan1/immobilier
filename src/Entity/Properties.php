<?php

namespace App\Entity;

use App\Repository\PropertiesRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: PropertiesRepository::class)]
#[Vich\Uploadable]
#[HasLifecycleCallbacks()]
class Properties
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Ce champ ne peut être vide")]
    #[Assert\Length(
        min: 5,
        max: 80,
        minMessage: "Ce champ doit contenir au moins {{ limit }} caractères",
        maxMessage: "Ce champ doit contenir au plus {{ limit }} caractères"
    )]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: "Ce champ ne peut être vide")]
    #[Assert\Length(
        min: 5,
        max: 65000,
        minMessage: "Ce champ doit contenir au moins {{ limit }} caractères",
        maxMessage: "Ce champ doit contenir au plus {{ limit }} caractères"
    )]
    private ?string $description = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: "Ce champ ne peut être vide")]
    #[Assert\GreaterThan( 
       value: 0,
        message: "La surface doit être positif"
    )]
    private ?int $surface = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: "Ce champ ne peut être vide")]
    #[Assert\GreaterThan(
        value: 0,
        message: "Le nombre de pièces doit être positif"
    )]
    private ?int $rooms = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: "Ce champ ne peut être vide")]
    #[Assert\GreaterThan( 
       value: 0,
        message: "Le nombre de chambres prix doit être positif"
    )]
    private ?int $bedrooms = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: "Ce champ ne peut être vide")]
    #[Assert\GreaterThan( 
       value: 0,
        message: "Le numéro de l'étage doit être positif"
    )]
    private ?int $ceil = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: "Ce champ ne peut être vide")]
    #[Assert\GreaterThan( 
       value: 0,
        message: "Le prix doit être positif"
    )]
    private ?int $price = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Ce champ ne peut être vide")]
    #[Assert\Length(
        min: 5,
        max: 80,
        minMessage: "Ce champ doit contenir au moins {{ limit }} caractères",
        maxMessage: "Ce champ doit contenir au plus {{ limit }} caractères"
    )]
    private ?string $city = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Ce champ ne peut être vide")]
    #[Assert\Length(
        min: 5,
        max: 80,
        minMessage: "Ce champ doit contenir au moins {{ limit }} caractères",
        maxMessage: "Ce champ doit contenir au plus {{ limit }} caractères"
    )]
    private ?string $address = null;

    #[ORM\Column(length: 20)]
    #[Assert\NotBlank(message: "Ce champ ne peut être vide")]
    #[Assert\Length(
        min: 5,
        max: 20,
        minMessage: "Ce champ doit contenir au moins {{ limit }} caractères",
        maxMessage: "Ce champ doit contenir au plus {{ limit }} caractères"
    )]
    private ?string $postal_code = null;

    #[ORM\Column]
    private ?bool $sold = null;

    #[ORM\Column]
    private ?DateTime $created_at = null;

    #[ORM\Column]
    private ?DateTime $updated_at = null;

    #[ORM\ManyToMany(targetEntity: Options::class, inversedBy: 'properties')]
    private Collection $options;

    #[ORM\OneToMany(mappedBy: 'property', targetEntity: Message::class)]
    private Collection $message;

    #[Vich\UploadableField(mapping: 'properties', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageName = null;

    public function __construct()
    {
        $this->options = new ArrayCollection();
        $this->message = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getSurface(): ?int
    {
        return $this->surface;
    }

    public function setSurface(int $surface): static
    {
        $this->surface = $surface;

        return $this;
    }

    public function getRooms(): ?int
    {
        return $this->rooms;
    }

    public function setRooms(int $rooms): static
    {
        $this->rooms = $rooms;

        return $this;
    }

    public function getBedrooms(): ?int
    {
        return $this->bedrooms;
    }

    public function setBedrooms(int $bedrooms): static
    {
        $this->bedrooms = $bedrooms;

        return $this;
    }

    public function getCeil(): ?int
    {
        return $this->ceil;
    }

    public function setCeil(int $ceil): static
    {
        $this->ceil = $ceil;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postal_code;
    }

    public function setPostalCode(string $postal_code): static
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    public function isSold(): ?bool
    {
        return $this->sold;
    }

    public function setSold(bool $sold): static
    {
        $this->sold = $sold;

        return $this;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->created_at;
    }

    public function setCreatedAt(DateTime $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(DateTime $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * @return Collection<int, Options>
     */
    public function getOptions(): Collection
    {
        return $this->options;
    }

    public function addOption(Options $option): static
    {
        if (!$this->options->contains($option)) {
            $this->options->add($option);
        }

        return $this;
    }

    public function removeOption(Options $option): static
    {
        $this->options->removeElement($option);

        return $this;
    }

    #[ORM\PrePersist]
    public function onPropertyPersist()
    {
        $this->created_at = new DateTime();
        $this->updated_at = new DateTime();
    }
    #[ORM\PreUpdate]
    public function onPropertyUpdate()
    {
        $this->updated_at = new DateTime();
    }

    /**
     * @return Collection<int, Message>
     */
    public function getMessage(): Collection
    {
        return $this->message;
    }

    public function addMessage(Message $message): static
    {
        if (!$this->message->contains($message)) {
            $this->message->add($message);
            $message->setProperty($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): static
    {
        if ($this->message->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getProperty() === $this) {
                $message->setProperty(null);
            }
        }

        return $this;
    } 
    
    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            $this->updated_at = new DateTime();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

}
