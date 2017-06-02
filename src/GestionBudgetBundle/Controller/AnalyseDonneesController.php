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
        $chapitres = $em->getRepository('GestionBudgetBundle:Chapitre')->findAll();
        return $this->render("analysedonnees/index.html.twig", array(
           'comptes' => $comptes,
            'axes' => $axes,
            'chapitres' => $chapitres
        ));
    }

    public function postDonnesAnalyse(Request $request,$listeComplete = array(), $portee, $axe) {
        $results = $listeComplete;
        $em = $this->getDoctrine()->getManager();
        $datasource = array(
            'chart' => Constante::CHARTCARTE,
            'colorrange' => array(
                'color' => Constante::COLOR
            )
        );
        $datasource['data'] = array();
        $datasource['linkeddata'] = array();
        if ($results) {
            foreach ($results as $result) {
                if ($result->getNiveau() == 1) {
                    array_push($datasource['data'], array(
                        'id' => $result->getNom(),
                        'value' => $result->getValeurCompAxe(),
                        'link' => 'newchart-json-'.$result->getNom()
                    ));
                    $libelle = array();
                    $valuesBV = array(); $arraLink = array();
                    foreach ($results as $dep) {
                        $departValues = array(); $categoryVal = array();
                        if ($dep->getNiveau() == 2) {
                            if ($dep->getParent()->getNom() == $result->getNom())
                            {
                                if ($portee == Constante::COMMUNE) {
                                    array_push($libelle, array(
                                        'label' => $dep->getNom(),
                                        'link'  => 'newchart-json-'.$dep->getNom(),
                                        'value' => $dep->getValeurCompAxe()
                                    ));
                                }
                                 if ($portee == Constante::DEPARTEMENT) {
                                    array_push($libelle, array(
                                        'label' => $dep->getNom(),
                                        'value' => $dep->getValeurCompAxe()
                                    ));
                                }
                                foreach ($results as $com) {
                                    if ($com->getNiveau() == 3 && $com->getParent()->getNom() == $dep->getNom()) {
                                        array_push($departValues, array(
                                            'label' => $com->getNom(),
                                            'value' => $com->getValeurCompAxe()
                                        ));
                                    }
                                }
                                array_push($arraLink, array(
                                    'id' => $dep->getNom(),
                                    "linkedchart" => array(
                                        "chart" => Constante::ChartParameters($axe, 'les communes du département de '.$dep->getNom() ),
                                        'data' => $departValues,
                                    )

                                ));
                            }

                        }

                    }
                    $nomReg = $em->getRepository('GestionBudgetBundle:Region')->getNomRegionByCode($result->getNom());
                    array_push($datasource['linkeddata'], array(
                        'id' => $result->getNom(),
                        'linkedchart' => array(
                            'chart' => Constante::ChartParameters($axe,'Les départements de la région de '.$nomReg['nomRegion']),
                            'data' => $libelle,
                            'linkeddata' =>  $arraLink
                        )));
                }

            }
        }
        return $datasource;
    }

    private function constructListByPortee ($results, $portee, $axe) {
        $liste =array();
        if ($portee == Constante::COMMUNE) {
            $valeurAxe = 0;
            foreach ($results as $reslt) {
                switch ($axe) {
                    case 'BudgetVote' :
                            $valeurAxe = $reslt->getBudgetVote();
                            break;
                    case 'Budgetrecouvre' :
                            $valeurAxe = $reslt->getBudgetrecouvre();
                            break;
                    case 'BudgetDemande' :
                            $valeurAxe = $reslt->getBudgetDemande();
                            break;

                    default : $valeurAxe = $reslt->getBudgetVote(); break;
                }
                $noeudR = $this->construireNoeud($reslt->getDepartement()->getRegion()->getId(),$reslt->getDepartement()->getRegion()->getCodeRegion(),0,null,0);
                $noeudD = $this->construireNoeud($reslt->getDepartement()->getId(),$reslt->getDepartement()->getNomDepartement(),0,$noeudR, 0 );
                $noeudC = $this->construireNoeud($reslt->getCommune()->getId(),$reslt->getCommune()->getNomCommune(),3,
                        $noeudD , $valeurAxe);
                array_push($liste,$noeudC);
            }
        }
        if ($portee == Constante::DEPARTEMENT) {
            $valeurAxe = 0;
            foreach ($results as $reslt) {
                switch ($axe) {
                    case 'BudgetVote' :
                        $valeurAxe = $reslt->getBudgetVote();
                        break;
                    case 'Budgetrecouvre' :
                        $valeurAxe = $reslt->getBudgetrecouvre();
                        break;
                    case 'BudgetDemande' :
                        $valeurAxe = $reslt->getBudgetDemande();
                        break;

                    default : $valeurAxe = $reslt->getBudgetVote(); break;
                }
                $noeudR = $this->construireNoeud($reslt->getDepartement()->getRegion()->getId(),$reslt->getDepartement()->getRegion()->getCodeRegion(),0,null,0);
                $noeudD = $this->construireNoeud($reslt->getDepartement()->getId(),$reslt->getDepartement()->getNomDepartement(),2,$noeudR, $valeurAxe );
                array_push($liste,$noeudD);
            }
        }
        return $liste;

    }

//    public function constructListByNiveauc($listDepart,$niveau) {
//        $departs = array();
//        $i = 0;
//        foreach ($listDepart as $listD) {
//            $noeudD = $listD->getParent();
//            if ($i == 0) {
//                $noeud = new Noeud();
//                if ($noeudD && $noeudD->getParent()) {
//                    $noeudR = $this->construireNoeud($noeudD->getParent()->getId(), $noeudD->getParent()->getNom(), 0, null,$noeudD->getParent()->getValeurCompAxe());
//                    $noeud = $this->construireNoeud($noeudD->getId(),$noeudD->getNom(), $niveau, $noeudR,0 );
//                }
//                array_push($departs,$noeud);
//            }
//            $contient = false;
//
//
//            if (count($departs) > 0) {
//                foreach ($departs as $dep) {
//                    if ($noeudD) {
//                        if ($dep->getId() == $noeudD->getId()) {
//                            $contient = true;
//                            $dep->setValeurCompAxe($dep->getValeurCompAxe() + $listD->getValeurCompAxe());
//                        }
//                    }
//                }
//                if ($contient == false)  {
//                    $noeud = new Noeud();
//                    if ($noeudD && $noeudD->getParent()) {
//                        $noeudR = $this->construireNoeud($noeudD->getParent()->getId(), $noeudD->getParent()->getNom(), 0, null, $noeudD->getParent()->getValeurCompAxe());
//                        $noeud = $this->construireNoeud($noeudD->getId(), $noeudD->getNom(),$niveau, $noeudR,$listD->getValeurCompAxe());
//                    }
//                    array_push($departs,$noeud);
//                }
//            }
//            $i++;
//        }
//        return $departs;
//    }
    private function constructListByNiveau($departs, $niveau) {
        $listRegion = array();
        $i = 0 ;
        foreach ($departs as $listD) {
            $noeudD = $listD->getParent();
            if ($i == 0) {
                $noeud = new Noeud();
                if ($noeudD) {
                    if ($noeudD->getParent()) {
                        $noeudR = $this->construireNoeud($noeudD->getParent()->getId(),$noeudD->getParent()->getNom(),0, null, $noeudD->getParent()->getValeurCompAxe() );
                        $noeud = $this->construireNoeud($noeudD->getId(), $noeudD->getNom(), $niveau, $noeudR, 0);
                    }
                }
                array_push($listRegion,$noeud);

            }
            $contient = false;
            if (count($listRegion) > 0) {
                foreach ($listRegion as $dep) {
                    if ($noeudD) {
                        if ($dep->getId() == $noeudD->getId()) {
                            $contient = true;
                            $dep->setValeurCompAxe($dep->getValeurCompAxe() + $listD->getValeurCompAxe());
                        }
                    }

                }
                if ($contient == false)  {
                    $noeud = new Noeud();
                    if ($noeudD) {
                        $noeudR = new Noeud();
                        if ($noeudD->getParent()) {
                            $noeudR = $this->construireNoeud($noeudD->getParent()->getId(),$noeudD->getParent()->getNom(),0, null, $noeudD->getParent()->getValeurCompAxe() );
                        }
                        $noeud = $this->construireNoeud($noeudD->getId(),$noeudD->getNom(),$niveau, $noeudR, $listD->getValeurCompAxe());
                    }
                    array_push($listRegion,$noeud);
                }
            }
            $i++;
        }
        return $listRegion;
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
        $em = $this->getDoctrine()->getManager();
         $listDepart = array();  $listRegion = array(); $departs = array();

        if ($portee == Constante::COMMUNE) {
            $result = $em->getRepository('GestionBudgetBundle:DonneesBudget')->getReslutDonneesAxeCommune($composant,$axe,$portee);
            //Zone de construction des communes
            $listDepart = $this->constructListByPortee($result,$portee, $axe);
            //Zone de construction des noeuds des departements
            $departs = $this->constructListByNiveau($listDepart,2);

            // Zone de construction des Regions
            $listRegion = $this->constructListByNiveau($departs,1);

        }
        if ($portee == Constante::DEPARTEMENT) {
            $result = $em->getRepository('GestionBudgetBundle:DonneesBudget')->getReslutDonneesAxeDepartement($composant,$axe,$portee);
            //Zone de construction des communes
            $listDepart = $this->constructListByPortee($result,$portee, $axe);
            // Zone de construction des Regions
            $listRegion = $this->constructListByNiveau($listDepart,1);
       }

        $listComDepart = array_merge($listDepart,$departs);
        $listComplete = array_merge($listComDepart, $listRegion);
         $dataSource = $this->postDonnesAnalyse($request,$listComplete,$portee, $axe);
//        Sérialisation des objets
        $normalizer = new ObjectNormalizer();

        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $encoder = new JsonEncode();

        $serializer = new  Serializer(array($normalizer), array($encoder));
        $arrayResult = $serializer->serialize($dataSource,'json');
//        $arrayResult = $serializer->serialize($listComplete,'json');

        return new JsonResponse($arrayResult);
    }

    /**
     * Construction  de noeud [commune,departement,region]
     * @param $id
     * @param $nom
     * @param $niveau
     * @param $parent
     * @param $valeurAxe
     * @return Noeud
     */
    public function construireNoeud($id, $nom,$niveau, $parent, $valeurAxe) {
        $noeud = new Noeud();
        $noeud->setId($id);
        $noeud->setNom($nom);
        $noeud->setNiveau($niveau);
        $noeud->setParent($parent);
        $noeud->setValeurCompAxe($valeurAxe);
        return $noeud;
    }

}