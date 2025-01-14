<?php

namespace App\Entity;

use App\Repository\ModuleRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: ModuleRepository::class)]
class Module
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\ManyToOne(targetEntity: Enseignant::class, inversedBy: 'modules')]
    #[ORM\JoinColumn(nullable: false)]
    private $enseignant;

    #[ORM\ManyToOne(targetEntity: Filiere::class, inversedBy: 'modules')]
    #[ORM\JoinColumn(nullable: false)]
    private $filiere;

    #[ORM\ManyToOne(targetEntity: Semestre::class, inversedBy: 'modules')]
    #[ORM\JoinColumn(nullable: false)]
    private $semestre;

    #[ORM\OneToMany(mappedBy: 'module', targetEntity: Note::class)]
    private $notes;

    public function __construct()
    {
        $this->notes = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getEnseignant(): ?enseignant
    {
        return $this->enseignant;
    }

    public function setEnseignant(?enseignant $enseignant): self
    {
        $this->enseignant = $enseignant;

        return $this;
    }

    public function getFiliere(): ?filiere
    {
        return $this->filiere;
    }

    public function setFiliere(?filiere $filiere): self
    {
        $this->filiere = $filiere;

        return $this;
    }

    public function getSemestre(): ?semestre
    {
        return $this->semestre;
    }

    public function setSemestre(?semestre $semestre): self
    {
        $this->semestre = $semestre;

        return $this;
    }

}
