<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    #[Assert\NotBlank(message: "Ce champ ne peut pas être vide")]
    #[Assert\Length(
        min: 4,
        max: 100,
        minMessage: "Ce champ doit contenir au moins {{ limit }} caractères.",
        maxMessage: "Ce champ doit contenir au plus {{ limit }} caractères.", 
    )]
    private ?string $firstname = null;

    #[ORM\Column(length: 150)]
    #[Assert\NotBlank(message: "Ce champ ne peut pas être vide")]
    #[Assert\Length(
        min: 4,
        max: 100,
        minMessage: "Ce champ doit contenir au moins {{ limit }} caractères.",
        maxMessage: "Ce champ doit contenir au plus {{ limit }} caractères.", 
    )]
    private ?string $name = null;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank(message: "Ce champ ne peut pas être vide")]
    #[Assert\Length(
        min: 5,
        max: 20,
        exactMessage: "S'il vous plaît veuillez entrer un numéro de téléphone valide.",
    )]
    private ?string $phone_number = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Ce champ ne peut pas être vide")]
    #[Assert\Length(
        min: 10,
        max: 50000,
        minMessage: "Ce champ doit contenir au moins {{ limit }} caractères.",
        maxMessage: "Ce champ doit contenir au plus {{ limit }} caractères.", 
    )]
    private ?string $email = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: "Ce champ ne peut pas être vide")]
    private ?string $message = null;

    #[ORM\ManyToOne(inversedBy: 'message')]
    private ?Properties $property = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
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

    public function getPhoneNumber(): ?string
    {
        return $this->phone_number;
    }

    public function setPhoneNumber(string $phone_number): static
    {
        $this->phone_number = $phone_number;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;

        return $this;
    }

    public function getProperty(): ?Properties
    {
        return $this->property;
    }

    public function setProperty(?Properties $property): static
    {
        $this->property = $property;

        return $this;
    }
}
