<?php

namespace App\Controller;

use App\Entity\Student;
use App\Repository\StudentRepository;
use App\Form\StudentFormType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

#[Route('/student')]
class StudentController extends AbstractController
{
    #[Route('/student', name: 'app_student')]
    public function index(): Response
    {
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }
    #[Route('/affiche', name: 'affiche')]
    public function affiche(StudentRepository $repo): Response
    {
        $result=$repo->findAll();
        return $this->render('student/index.html.twig', [
            'result' => $result,
        ]);
    }
    #[Route('/addf', name: 'addf')]
   public function addf(ManagerRegistry $mr,Request $req): Response
   {
       
       $s=new Student();  //1 -instance
       
        $form=$this->createForm(StudentFormType::class,$s);
      
       $form->handleRequest($req);
       if($form->isSubmitted()){
        $em=$mr->getManager();
        $em->persist($s);
        $em->flush();
        return $this->redirectToRoute('affiche');
       }
       
       return $this->render('student/add.html.twig',[
        'f'=>$form->createView()
       ]);

   }
   #[Route('/updatef/{id}', name: 'updatef')]
public function updatef(ManagerRegistry $mr, Request $req, $id): Response
{
    $em = $mr->getManager();
    $s = $em->getRepository(Student::class)->find($id); 
    
    $form = $this->createForm(StudentFormType::class, $s);
    
    $form->handleRequest($req);
    
    if ($form->isSubmitted() ) {
        $em=$mr->getManager();
        $em->persist($s);
        $em->flush(); 
        return $this->redirectToRoute('affiche');
    }
    
    return $this->render('student/update.html.twig', [
        'f' => $form->createView(),
        'id' => $id
    ]);
}
  
#[Route('/remove/{id}', name: 'remove')]
public function remove(StudentRepository $repo, $id, ManagerRegistry $mr): Response
{
    $student = $repo->find($id); 
    $em = $mr->getManager();
    $em->remove($student);
    $em->flush();
    
   
    return $this-> redirectToRoute('affiche');
}

}