<?php
/**
 * Created by PhpStorm.
 * User: Ibrahima
 * Date: 09/05/2017
 * Time: 12:13
 */

namespace GestionBudgetBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AnalyseDonneesController
 * @package GestionBudgetBundle\Controller
 * @Route("analysedonnees")
 */
class AnalyseDonneesController extends Controller
{

    /**
     * @Route("/", name="analyse_index")
     * @Method("GET")
     */
    public function indexAction() {

        $em = $this->getDoctrine()->getManager();
        $comptes = $em->getRepository("GestionBudgetBundle:Compte")->findAll();
        $axes = $em->getRepository("GestionBudgetBundle:Axe")->findAll();

        return $this->render("analysedonnees/index.html.twig", array(
           'comptes' => $comptes,
            'axes' => $axes
        ));
    }

    /**
     * @param Request $request
     * @Route("/postdonneesanalyse", options={"expose"=true}, name="postdonnees_analyse")
     * @Method("POST")
     */
    public function postDonnesAnalyse(Request $request) {
        $data = json_decode($request->getContent(), TRUE);
        $composant = $data['composant'];
        $axe = $data['axe'];
        $portee = $data['portee'];
        $em = $this->getDoctrine()->getManager();
        $results = $em->getRepository('GestionBudgetBundle:DonneesBudget')->getResultAnalyse($composant, $axe, $portee);
        $serializer = $this->get('serializer');
        $arrayResult = $serializer->normalize($results);

        return new JsonResponse($arrayResult);
    }
}