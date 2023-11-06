<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Appartement;
use App\Repository\ImmeubleRepository;
use App\Form\AjouterAppartementType;



class AppartementController extends AbstractController
{
    #[Route('/ajouter-appartement', name: 'app_ajouter-appartement')]
    public function ajouterAppartement(Request $request, ImmeubleRepository $immeubleRepository, EntityManagerInterface $em): Response
    {
        $appartement = new Appartement();
        $form = $this->createForm(AjouterAppartementType::class, $appartement);
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isSubmitted()&&$form->isValid()){
                $em->persist($appartement);
                $em->flush();
                $this->addFlash('notice','Appartement ajouté');
                return $this->redirectToRoute('app_accueil');
            }
        }
        return $this->render('appartement/ajouter-appartement.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
