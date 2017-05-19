<?php

namespace GestionBudgetBundle\Repository;

/**
 * DonneesBudgetRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DonneesBudgetRepository extends \Doctrine\ORM\EntityRepository
{

    public function getAllDonneesBudgetByUserCommune($usercommune) {

        $query = $this->createQueryBuilder('db')
            ->where('db.commune=:usercommune')
//            ->where('com.nomCommune = :usercommune')
            ->setParameter('usercommune', $usercommune)
            ->getQuery();
        $donnees = $query->getResult();
        return $donnees;

    }
    public function getAllDonneesBudgetByUserDeparttement($userdepart) {

        $query = $this->createQueryBuilder('db')
            ->where('db.departement=:userdepart')
            ->setParameter(':userdepart',$userdepart)
//            ->where('dep.nomDepartement = :userdepart')
            ->andWhere('db.commune is NULL')
            ->getQuery();
        $donnees = $query->getResult();
        return $donnees;

    }

    public function getResultAnalyse($compsant, $axe, $portee) {
        $rq = $this->createQueryBuilder('db')
            ->join('db.departement','d')
            ->join('d.region','region')
            ->select('SUM(db.budgetVote),region.codeRegion,region.nomRegion,region.id')
            ->groupBy('region.id')
            ->join('db.compte','cp')
            ->where('cp.numeroCompte='.$compsant)
            ->getQuery();

        return $rq->getScalarResult();
    }

    /**
     * Les donnees niveau commune
     * @param $composant
     * @param $axe
     * @param $portee
     * @return array
     */
    public  function getReslutDonneesAxeCommune($composant, $axe,$portee) {

          $query = $this->createQueryBuilder('db')
                    ->select('db')
                    ->join('db.compte', 'compte')
                    ->where('compte.numeroCompte=:composant')
                    ->andWhere('db.commune is NOT NULL')
                    ->setParameter('composant',$composant)
                    ->getQuery();

          return $query->getResult();
    }
//     public  function getQuery($composant, $axe,$portee) {
//         $fields = array('db.'.$axe, 'c.id', 'd.id');
//          $query = $this->getEntityManager()->createQueryBuilder();
//         $query->select($fields)
//                    ->from('GestionBudgetBundle:DonneesBudget' , 'db')
//                    ->leftJoin('db.commune' , 'c')
//                    ->leftJoin('db.departement' , 'd')
//                    ->join('db.compte', 'compte')
//                    ->where('compte.numeroCompte=:composant')
//                    ->andWhere('db.commune is NOT NULL')
//                    ->setParameter('composant',$composant)
//                    ->getQuery();
//
//          return $query->getResult();
//    }


    public  function getReslutDonneesAxeDepartement($composant, $axe,$portee) {

        $query = $this->createQueryBuilder('db')
            ->select('db')
            ->join('db.compte', 'compte')
            ->where('compte.numeroCompte=:composant')
            ->andWhere('db.commune is NULL')
            ->setParameter('composant',$composant)
            ->getQuery();

        return $query->getResult();
    }
    public function getResultAgregaCommunes($composant) {
        $rq = $this->createQueryBuilder('db')
            ->join('db.commune','d')
            ->join('d.departement','departement')
            ->select('SUM(db.budgetVote),departement.id,departement.nomDepartement')
            ->groupBy('departement.id')
            ->join('db.compte','cp')
            ->where('cp.numeroCompte='.$composant)
            ->getQuery();

        return $rq->getScalarResult();
    }


    /**
     * @param $composant
     * @param $departId
     * @return mixed
     */

    public function getAxeValueByDepartement($axe,$departId) {

        $rq = $this->createQueryBuilder('db')
            ->select('db.budgetVote')
            ->join('db.departement','d')
            ->where('d.id='.$departId)
            ->andWhere('db.commune is NULL')
            ->getQuery();

        return $rq->getOneOrNullResult();
    }
}
