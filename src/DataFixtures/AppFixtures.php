<?php

namespace App\DataFixtures;

use App\Entity\News;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Traits\Gescredat;
class AppFixtures extends Fixture
{
    
    use Gescredat;
    public function load(ObjectManager $manager)
    {
        // creation  actualités
         
            $actu1 = new News();
            $actu1->setNewstit('actualité 1a');
            $actu1->setNewscont('contenu actu 1a');
            $manager->persist($actu1);
            $manager->flush(); 
            
            for ($i = 0; $i < 5; $i++) {
                $actus = new News();
                $actus->setNewstit('actualité '.$i);
                $actus->setNewscont('Cela ne sera pas une surprise 
                 mais nous avons le regret de vous annoncer que BioExpo
                  ne se déroulera pas dans un format physique à 
                 la fin du mois de mars comme annoncé et comme nous espérions.
                Cela dit, nous avons encore des choses en réserve pour vous. '.$i);
                $manager->persist($actus);
            }
                $manager->flush();
    }
}