<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\MaxDepth;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $login = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    private ?string $secondName = null;

    #[ORM\Column(options: ["default" => "CURRENT_TIMESTAMP"])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $roles = [];

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(options: ["default" => true])]
    private ?bool $isActive = null;

    #[ORM\Column]
    private ?int $age = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(type: 'string', length: 15, unique: true)]
    private ?string $phoneNumber = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $childrenFullName = null;

    #[ORM\Column(nullable: true)]
    private ?int $childrenAge = null;

    /**
     * @var Collection<int, ConsultationRequest>
     */
    #[MaxDepth(1)]
    #[ORM\OneToMany(targetEntity: ConsultationRequest::class, mappedBy: 'user', orphanRemoval: true)]
    private Collection $consulationRequests;

    public function __construct()
    {
        $this->roles = ['ROLE_USER'];
        $this->createdAt = new \DateTimeImmutable();
        $this->isActive = true;
        $this->consulationRequests = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(?string $login): static
    {
        $this->login = $login;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getSecondName(): ?string
    {
        return $this->secondName;
    }

    public function setSecondName(string $secondName): static
    {
        $this->secondName = $secondName;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(?bool $isActive): static
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function eraseCredentials(): void
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserIdentifier(): string
    {
        return $this->phoneNumber;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): static
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getChildrenFullName(): ?string
    {
        return $this->childrenFullName;
    }

    public function setChildrenFullName(?string $childrenFullName): static
    {
        $this->childrenFullName = $childrenFullName;

        return $this;
    }

    public function getChildrenAge(): ?int
    {
        return $this->childrenAge;
    }

    public function setChildrenAge(?int $childrenAge): static
    {
        $this->childrenAge = $childrenAge;

        return $this;
    }

    /**
     * @return Collection<int, ConsultationRequest>
     */
    public function getConsulationRequests(): Collection
    {
        return $this->consulationRequests;
    }

    public function addConsulationRequest(ConsultationRequest $consulationRequest): static
    {
        if (!$this->consulationRequests->contains($consulationRequest)) {
            $this->consulationRequests->add($consulationRequest);
            $consulationRequest->setUser($this);
        }

        return $this;
    }

    public function removeConsulationRequest(ConsultationRequest $consulationRequest): static
    {
        if ($this->consulationRequests->removeElement($consulationRequest)) {
            // set the owning side to null (unless already changed)
            if ($consulationRequest->getUser() === $this) {
                $consulationRequest->setUser(null);
            }
        }

        return $this;
    }

    public function normalizePhone(string $phone): string
    {
        // Удаляем все символы, кроме + и цифр
        $phone = preg_replace('/[^\d+]/', '', $phone);

        // Преобразуем 89... в +79..., если пользователь ввел в локальном формате
        if (preg_match('/^89\d{9}$/', $phone)) {
            $phone = '+7' . substr($phone, 1);
        }

        // Если нет плюса, добавим (на твое усмотрение)
        if (!str_starts_with($phone, '+')) {
            $phone = '+' . $phone;
        }

        return $phone;
    }

}
