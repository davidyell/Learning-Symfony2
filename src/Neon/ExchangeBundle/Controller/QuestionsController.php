<?php

namespace Neon\ExchangeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of QuestionsController
 *
 * @author David Yell <neon1024@gmail.com>
 */
class QuestionsController extends Controller {

    public function indexAction() {
        return $this->render('NeonExchangeBundle:Questions:index.html.twig');
    }

}