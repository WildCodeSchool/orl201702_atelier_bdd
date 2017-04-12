<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 12/04/17
 * Time: 17:12
 */

namespace GotBundle\Controller;
use GotBundle\Entity\Personnage;
use Symfony\Bridge\Doctrine\Tests\Fixtures\Person;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PersonnageController extends Controller
{
    /**
     * @Route("/show-personnage/{id}")
     */
    public function showPersonnageAction(Personnage $personnage)
    {
        $em = $this->getDoctrine()->getManager();
        // select * from personnage where id=$id
       // $personnage = $em->getRepository('GotBundle:Personnage')->find($id);

        return $this->render('GotBundle:Personnage:show.html.twig', ['personnage' => $personnage]);
    }


    /**
     * @Route("/list-personnage/{sexe}")
     */
    public function listPersonnageAction($sexe)
    {
        $em = $this->getDoctrine()->getManager();
        // select * from personnage where sexe='$sexe'
        $personnages = $em->getRepository('GotBundle:Personnage')->findBySexe($sexe);

        return $this->render('GotBundle:Personnage:list.html.twig', [
            'personnages' => $personnages,
            'sexe' => $sexe,
        ]);
    }
    /**
     * @Route("/add-personnage/{nom}/{prenom}/{sexe}/{bio}")
     */
    public function addPersoAction($nom,$prenom,$sexe,$bio)
    {
        $em = $this->getDoctrine()->getManager();
        // select * from personnage where sexe='$sexe'
        $personnage = new Personnage();
        $personnage->setNom($nom);
        $personnage->setPrenom($prenom);
        $personnage->setSexe($sexe);
        $personnage->setBio($bio);

        // select * from royaume where id=1
        $royaume = $em->getRepository('GotBundle:Royaume')->find(1);

        $personnage->setRoyaume($royaume);

        // enregistre l'état actuel de mon objet personnage
        $em->persist($personnage);

        // met à jour la BDD avec tous les objets persistés
        // insert into Personnage ...
        $em->flush();

        return $this->render('GotBundle:Personnage:add.html.twig', [
            'personnage' => $personnage,
        ]);
    }

    /**
     * @Route("/change-personnage/{idPerso}/{idRoyaume}")
     */
    public function changePersonnageAction($idPerso, $idRoyaume)
    {
        $em = $this->getDoctrine()->getManager();

        $personnage = $em->getRepository('GotBundle:Personnage')->find($idPerso);
        $royaume = $em->getRepository('GotBundle:Royaume')->find($idRoyaume);

        $personnage->setRoyaume($royaume);

        $em->flush();

        return $this->render('GotBundle:Personnage:update.html.twig', [
            'personnage' => $personnage,
        ]);
    }

    /**
     * @Route("/delete-personnage/{id}")
     */
    public function deletePersonnageAction(Personnage $personnage)
    {
        $em = $this->getDoctrine()->getManager();

        // bonus : on enlève un habitant au royaume concerné par la mort du personnage
        $royaume = $personnage->getRoyaume();
        $royaume->setNbHabitant($royaume->getNbHabitant()-1);

        $em->remove($personnage);

        $em->flush();

        return $this->render('GotBundle:Personnage:delete.html.twig', [
            'personnage' => $personnage,
        ]);
    }

}