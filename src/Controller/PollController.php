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

        $questions = $this->getDoctrine()->getRepository(Question::class)->findAll();
        

//        $questions = $paginator->paginate($allQuestions,$request->query->getInt('page', 1),5);

        if ($request->isMethod('POST')) {

//            $arr_data = $request->request;

            
            foreach ($request->request as $ans) {

                    $poll = new Poll();
                    $poll->setUserId($this->getUser()->id);
                    $poll->setUserAnswer($ans);

//                    $answer = new Answer();


                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($poll);
//                    $entityManager->persist($answer);
                    $entityManager->flush();
            }

            $this->addFlash('success', 'You have already voted!');
            return $this->redirectToRoute('showResults');
        }

        return $this->render('poll/index.html.twig', [
            'questions' => $questions,
        ]);
    }

    public function vote(){
        
    }
    /**
     * @Route("/result", name="showResults")
     */
    public function showResults(PollRepository $pollRepository)
    {
        $questions = $this->getDoctrine()->getRepository(Question::class)->findAll();
        $answers = $this->getDoctrine()->getRepository(Answer::class)->findAll();
        $pollAnswers = $this->getDoctrine()->getRepository(Poll::class)->findAll();

        $vote = 0;
        foreach ($pollAnswers as $poll){
//            foreach ($answers as $answer){
                
//                if($answer->answer == $poll->user_answer){
//                    $vote++;
//                }
                for ($i=1;$i<count($poll->user_answer);$i++) {
                    $votes = $poll[$i]; // значение~ответ
                    echo $votes[1].'<b>'.$votes[0].'</b><br>';
//                }
            }


            
//           echo $poll->user_answer."<br>";
//            echo $vote;
//            $poll->user_answer;
        }

        $ua = $pollRepository->findBy(['user_id' => $this->getUser()->id]);

        $this->denyAccessUnlessGranted('ROLE_USER');
        return $this->render('poll/result.html.twig', [
            'ua' => $ua,
            'questions'=>$questions,
            'answers'=>$answers,
        ]);
    }
}

//        $form = $this->createForm(PollType::class);
//
//        $form->handleRequest($request);
//        if ($form->isSubmitted() && $form->isValid()) {
//           $data = $form->getData();
//            $poll = new Poll();
//
//            $poll->setUserAnswer($data['user_answer']);
//            $poll->setUserQuestion($data['user_question']);
//            $poll->setUserId($data['user_id']);
//            dd($data);
//
//            $em->persist($poll);
//            $em->flush();
//
//            return $this->redirectToRoute('showResults');
//        }
//        return $this->render('exam/exam.html.twig', [
//            'poll_form' => $form->createView(),
//        ]);
//        $queryBuilder = $repository->getWithSearchQueryBuilder($questions);

//        $pagination = $paginator->paginate(
//            $queryBuilder, /* query NOT result */
//            $request->query->getInt('page', 1)/*page number*/,
//            10/*limit per page*/
//        );

// Найти поле или поля из таблицы(сущности)
//        $repository = $this->getDoctrine()->getRepository(Poll::class);
//        $product = $repository->findOneBy(['id' => '34']);

//$length = count($questions);
//        $sum_answer1 = 0;
//        $sum_answer2 = 0;
//
//        $sum_answer3 = 0;
//        $sum_answer4 = 0;
//
//        $quest3A = 0;
//        $quest3B = 0;
//
//        $quest4A = 0;
//        $quest4B = 0;
//
//        $quest5A = 0;
//        $quest5B = 0;
//
////        dd($questions[0]->answers[1]->answer);
//
//        foreach ($userAnswer as $ua) {
//            if($ua->user_answer1 == $questions[0]->answers[0]->answer){
//                $sum_answer1 ++;
//            }if($ua->user_answer1 == $questions[0]->answers[1]->answer){
//                $sum_answer2 ++;
//            }
//
//            if($ua->user_answer2 == $questions[1]->answers[0]->answer){
//                $sum_answer3 ++;
//            }if($ua->user_answer1 == $questions[1]->answers[1]->answer){
//                $sum_answer4 ++;
//            }
//
//            if($ua->user_answer3 == $questions[2]->answers[0]->answer){
//                $quest3A ++;
//            }if($ua->user_answer1 == $questions[2]->answers[1]->answer){
//                $quest3B ++;
//            }
//
//            if($ua->user_answer4 == $questions[3]->answers[0]->answer){
//                $quest4A ++;
//            }if($ua->user_answer1 == $questions[3]->answers[1]->answer){
//                $quest4B ++;
//            }
//
//            if($ua->user_answer5 == $questions[4]->answers[0]->answer){
//                $quest5A ++;
//            }if($ua->user_answer1 == $questions[4]->answers[1]->answer){
//                $quest5B ++;
//            }
//        }
//        echo "Первый вопрос За проголосовали: ".$sum_answer1." | Против: ".$sum_answer2."</br>";
//        echo "Второй вопрос За проголосовали: ".$sum_answer3." | Против: ".$sum_answer4."</br>";
//        echo "Третий вопрос За проголосовали: ".$quest3A." | Против: ".$quest3B."</br>";
//        echo "Четвертый вопрос За проголосовали: ".$quest4A." | Против: ".$quest4B."</br>";
//        echo "Пятый вопрос За проголосовали: ".$quest5A." | Против: ".$quest5B."</br>";