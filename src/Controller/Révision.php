<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class Révision extends AbstractController 
{

// ...

#[Route('/helpiana', name: 'helpiana')] 
public function affichage() 
{
return new Response(content: '<h1> kms actually  </h1>' );
}
#[Route('/customiana/{request}', name: 'helpiana')]   //{ } => ki theb tajouti parametre 

public function custom($request) 
{
    dump ($request) ;
    return new Response(content :'<h1> mental aslyum when?  </h1>'.$request) ;

}
}


?>