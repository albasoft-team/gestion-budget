<?php
/**
 * Created by PhpStorm.
 * User: Ibrahima
 * Date: 09/05/2017
 * Time: 12:13
 */

namespace GestionBudgetBundle\Controller;


use GestionBudgetBundle\Constantes\Constante;
use GestionBudgetBundle\Entity\Noeud;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

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
        $rslt = $em->getRepository('GestionBudgetBundle:DonneesBudget')->findAll();
        var_dump($rslt);
        die();
        $results = $em->getRepository('GestionBudgetBundle:DonneesBudget')->getResultAnalyse($composant, $axe, $portee);
        $datasource = array(
            'map' => array(
                "theme" => "ocean",
                "animation" => "0",
                "formatNumberScale" => "0",
                "showCanvasBorder" => "0",
                "showshadow" => "0",
                "fillColor" => "#04A3ED",
                "caption" => "Le budget voté par région",
                "entityFillHoverColor" => "#E5E5E9"
            ),
            'colorrange' => array(
                'color' => array(
                    array(
                        "minvalue"  => 0,
                        "maxvalue" => 15000000,
                        "code" => "#f8bd19",
                        "displayvalue" => "< 20M"
                    ),
                     array(
                         "minvalue" => "20000000",
                         "maxvalue" => 22000000,
                         "code" => "#6baa01",
                         "displayvalue" => "20-50M"
                    ),
                     array(
                         "minvalue" => "50000000",
                        "maxvalue" => 86000000,
                        "code" => "#eed698",
                        "displayvalue" => "50-100M"
                    ),
                     array(
                         "minvalue" => "100000000",
                        "maxvalue" => 105000000,
                        "code" => "#fa0808",
                        "displayvalue" => "100-200M"
                    )
                )
            )
        );
        $datasource['data'] = array();
        if ($results) {
            foreach ($results as $result) {
                array_push($datasource['data'], array(
                    'id' => $result['codeRegion'],
                    'value' => $result[1],
                    'link' => 'newchart-json-'.$result['nomRegion']
                ));
            }
        }
        $datasource['linkeddata'] = array();
//        $departs = new  \Doctrine\Common\Collections\ArrayCollection();
        $const = new Constante();
        foreach ($results as $result) {
            $region = $em->getRepository('GestionBudgetBundle:Region')->find($result['id']);

            $departs  =  $region->getDepartements();
            $libelle = array();
            $valuesBV = array();
            foreach ($departs as $depart) {
                array_push($libelle, array(
                    'label' => $depart->getNomDepartement()
                ));
                if ($portee == $const::DEPARTEMENT) {
                    $values = $em->getRepository('GestionBudgetBundle:DonneesBudget')->getAxeValueByDepartement($axe, $depart->getId());
                    array_push($valuesBV, array(
                        'value' => $values['budgetVote']
                    ));
                }

//                if ($portee == $const::COMMUNE) {
//                    $values = $em->getRepository('GestionBudgetBundle:DonneesBudget')
//                                    ->getResultAgregaCommunes($composant) ;
////                    array_push($valuesBV, array(
////                        'value' => $values[1],
////                        'link' => 'newchart-json-'.$values['nomCommune']
////                    ));
//                    var_dump($values);
//                }
            }
            array_push($datasource['linkeddata'], array(
                    'id' => $result['nomRegion'],
                    'linkedchart' => array(
                        'chart' => array(
                            "showvalues" => "0",
                            "formatNumberScale" => "0",
                            "theme" => "fint"
                        ),
                        'categories' => array(
                            'category' => $libelle
                        ),
                        'dataset' => array(
                            'seriesname' => 'vue sur '.$axe,
                            'data' => $valuesBV
                        )
                    )

            ));
        }
        $normalizer = new ObjectNormalizer();

        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $encoder = new JsonEncode();

        $serializer = new  Serializer(array($normalizer), array($encoder));
        $arrayResult = $serializer->serialize($datasource,'json');

//        $serializer = $this->get('serializer');
//        $arrayResult = $serializer->normalize($datasource);

        return new JsonResponse($arrayResult);
    }

    /**
     * @param Request $request
     * @Route("/postdata", name="postdata_analyse", options={"expose"=true})
     * @Method("POST")
     */
    public function constructionListe(Request $request) {
        $data = json_decode($request->getContent(), TRUE);
        $composant = $data['composant'];
        $axe = $data['axe'];
        $portee = $data['portee'];
        $liste = array();
        $em = $this->getDoctrine()->getManager();
        $result = $em->getRepository('GestionBudgetBundle:DonneesBudget')->getReslutDonnees($composant,$axe,$portee);



        //Sérialisation des objets
        $normalizer = new ObjectNormalizer();

        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $encoder = new JsonEncode();

        $serializer = new  Serializer(array($normalizer), array($encoder));
        $arrayResult = $serializer->serialize($result,'json');

        return new JsonResponse($arrayResult);
    }

    public function construireNoeud($nom, $parent, $valeurAxe) {
        $noeud = new Noeud();
        $noeud->setNom($nom);
        $noeud->setParent($parent);
        $noeud->setValeurCompAxe($valeurAxe);
        return $noeud;
    }

}