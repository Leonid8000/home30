<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

use App\Entity\User;
use App\Entity\Poll;
use App\Entity\Answer;
use App\Entity\Question;

use App\Repository\PollRepository;

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
    public function showResults(Request $request, PollRepository $pollRepository)
    {
//        if ($request->isMethod('POST')){
//        $entityManager = $this->getDoctrine()->getManager();
//        $query = $entityManager->createQuery('DELETE * FROM poll');
//        $query->execute();
//        }

        $pollRess = $this->getDoctrine()->getRepository(Poll::class)->findAll();
        $questions = $this->getDoctrine()->getRepository(Question::class)->findAll();
        $answer = $this->getDoctrine()->getRepository(Answer::class)->findAll();

        return $this->render('admin/results.html.twig', [
            'pollRess' => $pollRess,
            'questions' => $questions,
            'answer' => $answer,
        ]);
    }

    public function truncatePoll(Request $request, PollRepository $pollRepository){

    }
}
