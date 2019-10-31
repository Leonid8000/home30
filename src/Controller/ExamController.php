<?php


namespace App\Controller;
use App\Entity\Question;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
class ExamController extends AbstractController
{
    /**
     * @IsGranted("ROLE_USER")
     */
    /**
     * @Route("/exam", name="exam")
     */
    public function exam()
    {
        $questions = $this->getDoctrine()->getRepository(Question::class)->findAll();
        $this->denyAccessUnlessGranted('ROLE_USER');
        return $this->render('exam/exam.html.twig', [
            'questions' => $questions,
        ]);
    }
}
