<?php

namespace App\Entity;

use App\Enum\ConsultationType;
use App\Enum\EmployeeSphera;
use App\Repository\EmployeeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\MaxDepth;

#[ORM\Entity(repositoryClass: EmployeeRepository::class)]
#[ORM\Table(name: '`employees`')]
class Employee implements UserInterface, PasswordAuthenticatedUserInterface
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

    #[ORM\Column(length: 255)]
    private ?string $phoneNumber = null;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $education = null;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $cualification = null; //квалификация

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $experience = null; // Стаж в годах

    #[ORM\Column(type: 'string', nullable: true, enumType: EmployeeSphera::class)]
    private ?EmployeeSphera $employeeSphera = null;

    public function getCualification(): ?string
    {
        return $this->cualification;
    }

    public function setCualification(?string $cualification): void
    {
        $this->cualification = $cualification;
    }  //квалификация
    public function getEmployeeSphera(): ?EmployeeSphera
    {
        return $this->employeeSphera;
    }

    public function setEmployeeSphera(EmployeeSphera $employeeSphera): void
    {
        $this->employeeSphera = $employeeSphera;
    }

    /**
     * @var Collection<int, ConsultationRequest>
     */
    #[MaxDepth(1)]
    #[ORM\OneToMany(targetEntity: ConsultationRequest::class, mappedBy: 'consultant')]
    private Collection $consulationRequests;

    public function __construct()
    {
        $this->roles = ['ROLE_EMPLOYEE'];
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

    public function getEducation(): ?string
    {
        return $this->education;
    }

    public function setEducation(?string $education): static
    {
        $this->education = $education;
        return $this;
    }

    public function getSpecialization(): ?string
    {
        return $this->specialization;
    }

    public function setSpecialization(?string $specialization): static
    {
        $this->specialization = $specialization;
        return $this;
    }

    public function getExperience(): ?int
    {
        return $this->experience;
    }

    public function setExperience(?int $experience): static
    {
        $this->experience = $experience;
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
            $consulationRequest->setConsultant($this);
        }

        return $this;
    }

    public function removeConsulationRequest(ConsultationRequest $consulationRequest): static
    {
        if ($this->consulationRequests->removeElement($consulationRequest)) {
            // set the owning side to null (unless already changed)
            if ($consulationRequest->getConsultant() === $this) {
                $consulationRequest->setConsultant(null);
            }
        }

        return $this;
    }

    private function normalizePhone(string $phone): string
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
