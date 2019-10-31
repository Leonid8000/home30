<?php
namespace App\Controller;
use App\Entity\Question;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
/**
 * @IsGranted("ROLE_ADMIN")
 */
class QuestionController extends AbstractController
{
    /**
     * @Route("/admin/questions", name="q-home")
     */
    public function home()
    {
        $questions = $this->getDoctrine()->getRepository(Question::class)->findAll();

        return $this->render('question/index.html.twig', [
            'questions' => $questions,
        ]);

    }
    /**
     * @Route("/admin/create", name="create")
     */
    public function create(Request $request){
        $question = new Question();
        $form = $this->createFormBuilder($question)
            ->add('title', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('answer', TextareaType::class, array('required' => false,
                'attr' => array('class' => 'form-control')))
            ->add('save', SubmitType::class, array(
                'label' => 'Create',
                'attr' => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $question = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($question);
            $entityManager->flush();
            return $this->redirectToRoute('q-home');
        }
        return $this->render('question/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/admin/delete/{id}", name="delete")
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
     * @Route("/admin/edit/{id}", name="edit")
     * Method({"GET", "POST"})
     */
    public function edit(Request $request, $id){
        $question = new Question();
        $question = $this->getDoctrine()->getRepository(Question::class)->find($id);
        $form = $this->createFormBuilder($question)
            ->add('title', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('answer', TextareaType::class, array('required' => false,
                'attr' => array('class' => 'form-control')))
            ->add('save', SubmitType::class, array(
                'label' => 'Update',
                'attr' => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            return $this->redirectToRoute('q-home');
        }
        return $this->render('question/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
}

