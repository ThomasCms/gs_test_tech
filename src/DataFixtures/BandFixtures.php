<?php

namespace App\DataFixtures;

use App\Entity\Band;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BandFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $band = new Band();
        $band->setName('Les casseroles');
        $band->setCountry('France');
        $band->setCity('Madrid');
        $band->setStartYear(1962);
        $band->setEndYear(2020);
        $band->setDetails('Tous les opéras complets tous les soirs pendant 58 ans, personne n\'avais jamais vu ça.');
        $band->setFounders('Marting Garix');
        $band->setMembers(41);
        $band->setMusicStyle('RNB');

        $band2 = new Band();
        $band2->setName('Mozart et les copains');
        $band2->setCountry('Narnia');
        $band2->setCity('Luxembourg');
        $band2->setStartYear(2018);
        $band2->setEndYear(2019);
        $band2->setDetails('Des étoiles dans les yeux de novembre 2018 à février 2019');
        $band2->setFounders('Molière, Snoop Dog et Edith Piaf');
        $band2->setMembers(41);
        $band2->setMusicStyle('Country');

        $band3 = new Band();
        $band3->setName('3 pattes et un canard');
        $band3->setCountry('Egypte');
        $band3->setCity('Le Mans');
        $band3->setStartYear(2000);
        $band3->setDetails('On espère un deuxieme album ! Et connaitre le nom du chanteur !');

        $manager->persist($band);
        $manager->persist($band2);
        $manager->persist($band3);

        $manager->flush();
    }
}