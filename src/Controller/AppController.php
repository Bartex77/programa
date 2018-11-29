<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\NumbersPlay;

/**
 * Class AppController
 * @package App\Controller
 */
class AppController extends AbstractController
{
    // max value of generated numbers (min is 1)
    const RAND_MAX = 100;

    /**
     * This method generates given number of random numbers and uses them to
     * calculate result for Programa Task 1
     *
     * @Route("/numbers/{numbersCount}", defaults={"numbersCount"=0}, name="numbers_play")
     *
     * @param int $numbersCount
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function numbersPlay(int $numbersCount = 0) {
        $numbersPlay = new NumbersPlay(0, 0); //might be prefilled
                                                         // no need for `try` block in this case
        $numbers = [];
        for ($i = 0; $i < $numbersCount; $i++) {
            $number = rand(1, self::RAND_MAX); // only for presentation; numbers don't need to be stored
            $numbers[] = $number;              // to meet the requirements
            $numbersPlay->acceptNumber($number); // no need for `try` block in this case
        }

        return $this->render('numbersPlay/index.html.twig',
            array(
                'result'    => $numbersPlay->result(),
                'numbers'   => $numbers
            ));
    }
}
