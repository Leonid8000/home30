<?php
namespace App\Controller;
use App\Entity\Question;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Entity\User;
use App\Entity\Poll;
use App\Entity\Answer;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('admin/home.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    /**
     * @Route("/admin/users", name="users")
     */
    public function showUsers()
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        return $this->render('admin/users.html.twig', [
            'users' => $users,
        ]);
    }
    /**
     * @Route("/admin/results", name="results")
     */
    public function showResults()
    {
        $pollRess = $this->getDoctrine()->getRepository(Poll::class)->findAll();
        $questions = $this->getDoctrine()->getRepository(Question::class)->findAll();
        $answer = $this->getDoctrine()->getRepository(Answer::class)->findAll();

        return $this->render('admin/results.html.twig', [
            'pollRess' => $pollRess,
            'questions' => $questions,
            'answer' => $answer,
        ]);
    }
}
