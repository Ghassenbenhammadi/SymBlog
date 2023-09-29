<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[UniqueEntity('email', 'Cet email existe déja au sein de l\'application.')]
#[ORM\HasLifecycleCallbacks]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue('CUSTOM')]
    #[ORM\Column(type: 'uuid')]
    #[ORM\CustomIdGenerator('doctrine.uuid_generator')]
    private ?string $id = null;
    
    #[ORM\Column(nullable:true,length:255)]
    private ?string $avatar;

    #[ORM\Column(length:255, unique:true)]
    #[Assert\NotBlank()]
    #[Assert\Email()]
    private string $email;

    #[ORM\Column(length:255, unique:true)]
    private ?string $lastName = null;
    #[ORM\Column(length:255, unique:true)]
    private ?string $firstName = null;
    #[ORM\Column(type:'json')]
    #[Assert\NotNull()]
    private array $roles = [ 'ROLE_USER'];

    private ?string $plainPassword = null;
    #[ORM\Column(length:255)]
    #[Assert\NotBlank()]
    private ?string $password;

    #[ORM\Column()]
    #[Assert\NotNull()]
    private \DateTimeImmutable $createdAt;
   
    #[ORM\Column(nullable: true)]
    private \DateTimeImmutable $updatedAt;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }
    #[ORM\PrePersist]
    public function prePersist(): void
    {
        $this->avatar = 'https://avatars.dicebear.com/api/big-ears-neutral/' . $this->email . '.svg';
    }

    #[ORM\PreUpdate]
    public function preUpdate(): void
    {
        $this->avatar = 'https://avatars.dicebear.com/api/big-ears-neutral/' . $this->email . '.svg';
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getAvatar(): string
    {
        return $this->avatar;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles = ['ROLE_USER'];

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(?string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
    public function eraseCredentials(): void
    {
        $this->plainPassword = null;
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function __toString()
    {
        return $this->firstName . ' ' . $this->lastName;
    }


}
