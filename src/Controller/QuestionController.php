<?php
namespace App\Controller;

use App\Entity\Answer;
use App\Entity\Question;

use App\Form\QuestionFormType;

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
class QuestionController extends AbstractController
{
    /**
     * @Route("/admin/questions", name="questions")
     */
    public function home()
    {
        $questions = $this->getDoctrine()->getRepository(Question::class)->findAll();

        return $this->render('admin/question/index.html.twig', [
            'questions' => $questions,
        ]);
    }
    /**
     * @Route("/admin/question/create", name="question/create")
     */
public function create(Request $request){

    $form = $this->createForm(QuestionFormType::class);
    $answers = $this->getDoctrine()->getRepository(Answer::class)->findAll();

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $question = $form->getData();
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($question);
        $entityManager->flush();
        $this->addFlash('success', 'Question created!');

        return $this->redirectToRoute('questions');
    }
    return $this->render('admin/question/create.html.twig', [
        'form' => $form->createView(),
        'answers'=>$answers
    ]);
}
    /**
     * @Route("/admin/question/delete/{id}", name="question/delete")
     * Method({"DELETE"})
     */
    public function delete(Request $request, $id){
        $question = $this->getDoctrine()->getRepository(Question::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($question);
        $entityManager->flush();
        $response = new Response();
        $response->send();
    }
    /**
     * @Route("/admin/question/edit/{id}", name="question/edit")
     * Method({"GET", "POST"})
     */
    public function edit(Request $request, $id){
        
        $question = $this->getDoctrine()->getRepository(Question::class)->find($id);
        $form = $this->createFormBuilder($question)
            ->add('title', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('answers',EntityType::class,[
                'class' => Answer::class,
                'choice_label' => 'answer',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('save', SubmitType::class, array(
                'label' => 'Update',
                'attr' => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            $this->addFlash('success', 'Question updated!');

            return $this->redirectToRoute('questions');
        }
        return $this->render('admin/question/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
}


