<?php

namespace App\Entity;

use App\Repository\DepartmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DepartmentRepository::class)
 */
class Department
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $Name;

    /**
     * @ORM\Column(type="integer")
     */
    private $Capacity;

    /**
     * @ORM\OneToMany(targetEntity=student::class, mappedBy="department")
     */
    private $name;

    public function __construct()
    {
        $this->name = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getCapacity(): ?int
    {
        return $this->Capacity;
    }

    public function setCapacity(int $Capacity): self
    {
        $this->Capacity = $Capacity;

        return $this;
    }

    public function addName(student $name): self
    {
        if (!$this->name->contains($name)) {
            $this->name[] = $name;
            $name->setDepartment($this);
        }

        return $this;
    }

    public function removeName(student $name): self
    {
        if ($this->name->removeElement($name)) {
            // set the owning side to null (unless already changed)
            if ($name->getDepartment() === $this) {
                $name->setDepartment(null);
            }
        }

        return $this;
    }
}
