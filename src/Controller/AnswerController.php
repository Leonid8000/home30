<?php
namespace App\Controller;

use App\Entity\Answer;
use App\Form\AnswerFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
/**
 * @IsGranted("ROLE_ADMIN")
 */
class AnswerController extends AbstractController
{
    /**
     * @Route("/admin/answers", name="answers")
     */
    public function index(Request $request, PaginatorInterface $paginator)
    {
        $allAnswers = $this->getDoctrine()->getRepository(Answer::class)->findAll();
        $answers = $paginator->paginate($allAnswers,$request->query->getInt('page', 1),10);

        return $this->render('admin/answer/index.html.twig', [
            'answers' => $answers,
        ]);
    }
    /**
     * @Route("/admin/answer/create", name="answer/create")
     */
    public function create(Request $request){

        $form_answer = $this->createForm(AnswerFormType::class);

        $form_answer->handleRequest($request);
        if ($form_answer->isSubmitted() && $form_answer->isValid()) {
            $answer_data = $form_answer->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($answer_data);
            $entityManager->flush();
            $this->addFlash('success', 'Answer created!');

            return $this->redirectToRoute('answers');
        }
        return $this->render('admin/answer/create.html.twig', [
            'form' => $form_answer->createView(),
        ]);
    }
    /**
     * @Route("/admin/answer/delete/{id}", name="answer/delete")
     * Method({"DELETE"})
     */
    public function delete(Request $request, $id){
        $answer = $this->getDoctrine()->getRepository(Answer::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($answer);
        $entityManager->flush();
        $response = new Response();
        $response->send();
    }
    /**
     * @Route("/admin/answer/edit/{id}", name="answer/edit")
     * Method({"GET", "POST"})
     */
    public function edit(Request $request, $id){

        $answer = $this->getDoctrine()->getRepository(Answer::class)->find($id);
        $form = $this->createFormBuilder($answer)
            ->add('answer', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('save', SubmitType::class, array(
                'label' => 'Update',
                'attr' => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            return $this->redirectToRoute('answers');
        }
        return $this->render('admin/answer/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
