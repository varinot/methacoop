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
        

            $doc1 = new Docs();
            $doc1->setDoctit('documentation 1da');
            $doc1->setDocref('reference 1da');
        
            $manager->persist($doc1);
            $manager->flush();              
         // creation  actualités
         
 
            $actu1 = new News();
            $actu1->setNewstit('actualité 1a');
            $actu1->setNewscont('contenu actu 1a');
         //    $actu->setCreatedAt = new \DateTime('NOW');
            $manager->persist($actu1);
            $manager->flush(); 
            
            for ($i = 0; $i < 10; $i++) {
                $actu = new News();
                $actu->setNewstit('actualité '.$i);
                $actu->setNewscont('contenu actu  '.$i);
                $manager->persist($actu);
            }
                $manager->flush();
    }
}