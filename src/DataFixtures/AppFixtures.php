<?php

namespace App\DataFixtures;
use App\Entity\Docs;
use App\Entity\News;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // creation documentations
        $doc2 = new Docs();
        $doc2->setDoctit('documentation 2da');
        $doc2->setDocref('reference 2da');
        $manager->persist($doc2);
        $manager->flush();

            $doc1 = new Docs();
            $doc1->setDoctit('documentation 1da');
            $doc1->setDocref('reference 1da');
            $manager->persist($doc1);
            $manager->flush(); 

            $doc21 = new Docs();
            $doc21->setDoctit('documentation 421da');
            $doc21->setDocref('reference 421da');
            $manager->persist($doc21);
            $manager->flush(); 
         
            // creation  actualités
         
            $actu1 = new News();
            $actu1->setNewstit('actualité 1a');
            $actu1->setNewscont('contenu actu 1a');
            $manager->persist($actu1);
            $manager->flush(); 
            
            for ($i = 0; $i < 10; $i++) {
                $actu = new News();
                $actu->setNewstit('actualité '.$i);
                $actu->setNewscont('Cela ne sera pas une surprise 
                 mais nous avons le regret de vous annoncer que BioExpo
                  ne se déroulera pas dans un format physique à 
                 la fin du mois de mars comme annoncé et comme nous espérions.
                Cela dit, nous avons encore des choses en réserve pour vous. '.$i);
                $manager->persist($actu);
            }
                $manager->flush();
    }
}