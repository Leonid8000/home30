<?php
namespace App\Controller;
use App\Entity\Question;
use App\Entity\Answer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
/**
 * @IsGranted("ROLE_USER")
 */
class ExamController extends AbstractController
{
    /**
     * @Route("/exam", name="exam")
     */
    public function exam()
    {
        $questions = $this->getDoctrine()->getRepository(Question::class)->findAll();
        $answers = $this->getDoctrine()->getRepository(Answer::class)->findAll();
        $this->denyAccessUnlessGranted('ROLE_USER');
        return $this->render('exam/exam.html.twig', [
            'questions' => $questions,
            'answers' => $answers,
        ]);
    }
    public function vote(){

    }
    /**
     * @Route("/result", name="showResults")
     */
    public function showResults()
    {
        $questions = $this->getDoctrine()->getRepository(Question::class)->findAll();
        $this->denyAccessUnlessGranted('ROLE_USER');
        return $this->render('exam/result.html.twig', [
            'questions' => $questions,
        ]);
    }
}
