<?php

namespace App\Controller;

use App\Repository\AnsRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Que;
use App\Entity\Ans;

class TestController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     */
    public function index()
    {
//$id = 1;
//        $que = $this->getDoctrine()->getRepository(Que::class)->find($id);
        
        $que=  $this->getDoctrine()->getRepository(Que::class)->findAll();
//        $ans =  $this->getDoctrine()->getRepository(Ans::class)->findAll();

//        $ans = $que->getAns();
//        foreach ($ans as $an){
//            dd($an);
//        }   
//        dd($ans);

//        $que = new Que();
//
//        foreach ($que->getAns() as $ans) {
//            dd($ans);
//        }
        return $this->render('test/login.html.twig', [
            'controller_name' => 'TestController',
//            'ans'=>$ans,
//            'que'=>$quesio,

        ]);
    }
}

//public function index(AnsRepository $ansRepository)
//{
//
//    $que = $this->getDoctrine()->getRepository(Que::class)->findAll();
////        $ans = $this->getDoctrine()->getRepository(Ans::class)->findAll();
//
//    $ans = $ansRepository->findBy(['que'=>$que]);
////        $que = $ans->getQue();
//
//    dd($ans);
//    return $this->render('test/login.html.twig', [
//        'controller_name' => 'TestController',
////            'que'=>$que,
//        'ans'=>$ans,
//    ]);
//}

