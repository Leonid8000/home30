<?php

namespace App\DataFixtures;

use App\Entity\Survey;
use App\Entity\SurveyQuestion;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class SurveyFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $survey = new Survey();
        $survey->setName('Survey 1');
        $survey->setQuestionsPerPage(5);
        $manager->persist($survey);
        $manager->flush();
    }
}
//for ($i = 0; $i < 10; $i++) {
//    $surveyQuestion = new SurveyQuestion();
//    $surveyQuestion->setQuestion('Question '.($i+1));
//    $surveyQuestion->setSurvey($survey);
//    $manager->persist($surveyQuestion);
//}