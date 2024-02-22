<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/wish', name: 'app_wish_')]
class WishController extends AbstractController
{
    #[Route('', name: 'list', methods: ['GET','POST'])]
    public function list(WishRepository $wishRepository) : Response
    {
        $wishes = $wishRepository->findAll();
        return $this->render('wish/list.html.twig', [
            'wishes'=>$wishes
        ]);
    }

    #[Route('/details/{id}', name: 'list-details', methods: ['GET','POST'])]
    public function listDetails(int $id, WishRepository $wishRepository) : Response
    {
        $wish = $wishRepository->find($id);
        if(!$wish){
            throw $this->createNotFoundException('Missing evil plan ! Meowhahaha !!!');
        }
        return $this->render('wish/list.details.html.twig', [
            "wish"=>$wish
        ]);
    }

    #[Route('/create', name: 'create', methods: ['GET','POST'])]
    public function createAWish(Request $request, EntityManagerInterface $entityManager) : Response
    {
        $wish = new Wish();
        $wish->setDateCreated(new \DateTime());
        $wish->setIsPublished(true);

        $wishForm = $this->createForm(WishType::class, $wish);
        $wishForm->handleRequest($request);

        if($wishForm->isSubmitted() && $wishForm->isValid()){
            $entityManager->persist($wish);
            $entityManager->flush();

            $this->addFlash('success', 'Evil plan added ! Nice evil job !');
            return $this->redirectToRoute('app_wish_list-details', ['id'=>$wish->getId()]);
        }
        return $this->render('wish/create.html.twig', [
            'wishForm'=>$wishForm->createView()
        ]);
    }


}