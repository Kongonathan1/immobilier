<?php

namespace App\Entity;

use App\Repository\OptionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: OptionsRepository::class)]
class Options
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank(message: "Ce champ ne peut être vide")]
    #[Assert\Length(
        min: 3,
        max: 80,
        minMessage: "Ce champ doit doit contenir {{ limit }} caractères",
        maxMessage: "Ce champ doit doit contenir au max {{ limit }} caractères"
    )]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Properties::class, mappedBy: 'options')]
    private Collection $properties;

    public function __construct()
    {
        $this->properties = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Properties>
     */
    public function getProperties(): Collection
    {
        return $this->properties;
    }

    public function addProperty(Properties $property): static
    {
        if (!$this->properties->contains($property)) {
            $this->properties->add($property);
            $property->addOption($this);
        }

        return $this;
    }

    public function removeProperty(Properties $property): static
    {
        if ($this->properties->removeElement($property)) {
            $property->removeOption($this);
        }

        return $this;
    }
}
