<?php
namespace App\Controller;

use App\Entity\Question;
use App\Entity\Answer;
use App\Entity\Poll;

use App\Repository\AnswerRepository;
use App\Repository\PollRepository;

use Knp\Component\Pager\PaginatorInterface;

use App\Form\PollType;
use Symfony\Component\HttpFoundation\Tests\Test\Constraint\RequestAttributeValueSameTest;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
/**
 * @IsGranted("ROLE_USER")
 */
class PollController extends AbstractController
{
    /**
     * @Route("/poll", name="poll")
     */
    public function showQuiz(Request $request, AnswerRepository $repository, PaginatorInterface $paginator){

        $allQuestions = $this->getDoctrine()->getRepository(Question::class)->findAll();
        $answers = $this->getDoctrine()->getRepository(Answer::class)->findAll();


        $questions = $paginator->paginate($allQuestions,$request->query->getInt('page', 1),5);
//        $this->getParameter('records_per_page')

        if ($request->isMethod('POST')) {

            foreach ($request->request as $ans) {

//                foreach ($answers as $answer){
//                    if($ans == $answer){
//                        echo $answer;
//                    }
//                }

                    $poll = new Poll();
                    $poll->setUserId($this->getUser()->id);
                    $poll->setUserAnswer($ans);

                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($poll);
                    $entityManager->flush();
            }

            $this->addFlash('success', 'You have already voted!');
            return $this->redirectToRoute('showResults');
        }

        return $this->render('poll/index.html.twig', [
            'questions' => $questions,
        ]);
    }

    /**
     * @Route("/result", name="showResults")
     */
    public function showResults(PollRepository $pollRepository)
    {
        $questions = $this->getDoctrine()->getRepository(Question::class)->findAll();
        $answers = $this->getDoctrine()->getRepository(Answer::class)->findAll();

//        All answers for poll
        $pollAnswers = $this->getDoctrine()->getRepository(Poll::class)->findAll();

        $sum = 0;

foreach ($pollAnswers as $pa){
        if($pa->user_answer == 32){
            $sum++;
            echo 'Answer: '.$pa->user_answer.' count: '.$sum;
    }
}echo 'SUM: '.$sum;

// Answers auth user
        $ua = $pollRepository->findBy(['user_id' => $this->getUser()->id]);

        $this->denyAccessUnlessGranted('ROLE_USER');
        return $this->render('poll/result.html.twig', [
            'ua' => $ua,
            'questions'=>$questions,
            'answers'=>$answers,
            'pollAnswers'=>$pollAnswers,
        ]);
    }
}
