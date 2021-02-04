<?php

namespace App\DataFixtures;
use App\Entity\Docs;
use App\Entity\News;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Gedmo\Mapping\Annotation as Gedmo; // gedmo annotations
use Gedmo\Timestampable\Traits\TimestampableEntity;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // creation documentations
        

            $doc1 = new Docs();
            $doc1->setDoctit('documentation 1da');
            $doc1->setDocref('reference 1da');
        //    $doc->setCreatedAt('2021-02-04  10:46:58');
            $manager->persist($doc1);
                        
         // creation  actualités
         
 
            $actu1 = new News();
            $actu1->setNewstit('actualité 1a');
            $actu1->setNewscont('contenu actu 1a');
         //    $actu->setCreatedAt = new \DateTime('NOW');
            $manager->persist($actu1);
            $manager->flush();                      
    }
}