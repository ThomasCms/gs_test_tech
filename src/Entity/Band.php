<?php

namespace App\Entity;

use App\Repository\BandRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

// The expectations of each company are different. If this technical test had been my first feature, before moving on to
// another ticket I would have taken the time to ask a colleague what he thought of the constraints I had chosen. I
// could also have added more, so I'll leave comments in the feature to document my choices.
#[ORM\Entity(repositoryClass: BandRepository::class)]
#[UniqueEntity(
    fields: ['name'],
    message: 'This band is already repertoried.',
)]
class Band implements \JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]
    #[Assert\NotBlank(
        message: 'Your band\'s name should not be blank'
    )]
    #[Assert\Type(
        type: 'string',
        message: 'Your band\'s name should be a string'
    )]
    #[Assert\Length(
        max: 255,
        maxMessage: 'Your band\'s name cannot be longer than {{ limit }} characters',
    )]
    private ?string $name = null;

    // in french, (the langage used in the file), the longest country name is "Royaume-Uni de Grande-Bretagne et
    // d'Irlande du Nord". 42 chars. But that's the kind of thing that changes over the decades, and I don't think
    // there's enough need to optimize the DB to make it worthwhile to impose a constraint. Same logic for "city".
    // we could also imagine this property using arrays rather than strings, but according to the example, I think
    // that's not what's expected.
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(
        message: 'Your band\'s should not be blank'
    )]
    #[Assert\Type(
        type: 'string',
        message: 'Your band\'s country should be a string'
    )]
    #[Assert\Length(
        max: 255,
        maxMessage: 'Your band\'s country cannot be longer than {{ limit }} characters',
    )]
    private ?string $country = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(
        message: 'Your band\'s city should not be blank'
    )]
    #[Assert\Type(
        type: 'string',
        message: 'Your band\'s city should be a string'
    )]
    #[Assert\Length(
        max: 255,
        maxMessage: 'Your band\'s city cannot be longer than {{ limit }} characters',
    )]
    private ?string $city = null;

    #[ORM\Column(type: Types::SMALLINT)]
    #[Assert\NotBlank(
        message: 'Your band\'s start year should not be blank'
    )]
    #[Assert\Type(
        type: 'int',
        message: 'Your band\'s start year should be an integer'
    )]
    private ?int $startYear = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    #[Assert\Type(
        type: 'int',
        message: 'Your band\'s end year should be an integer'
    )]
    #[Assert\GreaterThanOrEqual(propertyPath: 'startYear')]
    private ?int $endYear = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Type(
        type: 'string',
        message: 'Your band\'s founders list should be a string'
    )]
    #[Assert\Length(
        max: 255,
        maxMessage: 'Your band\'s founders list cannot be longer than {{ limit }} characters',
    )]
    private ?string $founders = null;

    // not a small int because I can imagine in the next few years an artistic initiative that would have an entire
    // stadium singing along, selling the event as "come and take part in your concert and let's form the world's
    // biggest artistic group ever for one night".
    #[ORM\Column(nullable: true)]
    #[Assert\Type(
        type: 'int',
        message: 'Your band\'s members amount should be an integer'
    )]
    #[Assert\Length(
        max: 255,
        maxMessage: 'Your band\'s members list cannot be longer than {{ limit }} characters',
    )]
    private ?int $members = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Type(
        type: 'string',
        message: 'Your band\'s music style should be a string'
    )]
    #[Assert\Length(
        max: 255,
        maxMessage: 'Your band\'s music style cannot be longer than {{ limit }} characters',
    )]
    private ?string $musicStyle = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(
        message: 'Your band\'s details should not be blank'
    )]
    #[Assert\Type(
        type: 'string',
        message: 'Your band\'s details should be a string'
    )]
    private ?string $details = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getStartYear(): ?int
    {
        return $this->startYear;
    }

    public function setStartYear(?int $startYear): static
    {
        $this->startYear = $startYear;

        return $this;
    }

    public function getEndYear(): ?int
    {
        return $this->endYear;
    }

    public function setEndYear(?int $endYear): static
    {
        $this->endYear = $endYear;

        return $this;
    }

    public function getFounders(): ?string
    {
        return $this->founders;
    }

    public function setFounders(?string $founders): static
    {
        $this->founders = $founders;

        return $this;
    }

    public function getMembers(): ?int
    {
        return $this->members;
    }

    public function setMembers(?int $members): static
    {
        $this->members = $members;

        return $this;
    }

    public function getMusicStyle(): ?string
    {
        return $this->musicStyle;
    }

    public function setMusicStyle(?string $musicStyle): static
    {
        $this->musicStyle = $musicStyle;

        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(?string $details): static
    {
        $this->details = $details;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'country' => $this->getCountry(),
            'city' => $this->getCity(),
            'startYear' => $this->getStartYear(),
            'endYear' => $this->getEndYear(),
            'founders' => $this->getFounders(),
            'members' => $this->getMembers(),
            'musicStyle' => $this->getMusicStyle(),
            'details' => $this->getDetails(),
        ];
    }
}
