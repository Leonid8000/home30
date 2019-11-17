<?php
namespace App\Controller;

use App\Entity\Answer;
use App\Entity\Question;
use App\Entity\Survey;

use App\Entity\SurveyQuestion;
use App\Form\QuestionFormType;

use App\Form\SurveyFormType;
use App\Repository\AnswerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


/**
 * @IsGranted("ROLE_ADMIN")
 */
class SurveyController extends AbstractController
{
//    /**
//     * @Route("/admin/questions", name="questions")
//     */
//    public function home()
//    {
//        $questions = $this->getDoctrine()->getRepository(Question::class)->findAll();
//
//        return $this->render('admin/question/index.html.twig', [
//            'questions' => $questions,
//        ]);
//    }
    /**
     * @Route("/admin/createsurvey", name="survey/create")
     */
    public function create(Request $request){

        $form = $this->createForm(SurveyFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        $surveyQuestion = new SurveyQuestion();
        $survey = $form->getData();
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($survey);
        $entityManager->flush();
        $this->addFlash('success', 'Survey created!');

        return $this->redirectToRoute('admin');
}
        return $this->render('admin/createsurvey.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

//$form = $this->createForm(QuestionFormType::class);
//$answers = $this->getDoctrine()->getRepository(Answer::class)->findAll();
//
//$form->handleRequest($request);
//if ($form->isSubmitted() && $form->isValid()) {
//    $question = $form->getData();
////        dd($request);
//    $entityManager = $this->getDoctrine()->getManager();
//    $entityManager->persist($question);
//    $entityManager->flush();
//    $this->addFlash('success', 'Question created!');
//
//    return $this->redirectToRoute('questions');
//}
//return $this->render('admin/question/create.html.twig', [
//    'form' => $form->createView(),
//    'answers'=>$answers
//]);

//public function create(Request $request){
//
//    if ($request->isMethod('POST')) {
//        $survey = new Survey();
//        $entityManager = $this->getDoctrine()->getManager();
//        $survey->setName($request->request->get('name'));
//        $survey->setQuestionsPerPage('5');
//        $entityManager->persist($survey);
//        $entityManager->flush();
//
//        $this->addFlash('success', 'You create survey');
//        return $this->redirectToRoute('admin');
//    }
//    return $this->render('admin/createsurvey.html.twig', [
////            'form' => $form->createView(),
////            'answers'=>$answers
//    ]);
//}