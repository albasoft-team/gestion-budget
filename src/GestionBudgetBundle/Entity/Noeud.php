<?php
/**
 * Created by PhpStorm.
 * User: Ibrahima
 * Date: 12/05/2017
 * Time: 13:02
 */

namespace GestionBudgetBundle\Entity;


class Noeud
{
    private $id;
    private $nom;
    private $parent;
    private $valeurCompAxe;

   public function getId() {
       return $this->id;
   }
   public function setId($id) {
       $this->id = $id;
   }
   public function getNom() {
       return $this->nom;
   }
   public function setNom($nom) {
       $this->nom = $nom;
   }
   public function getParent() {
       return $this->parent;
    }
   public function setParent($parent) {
       $this->parent = $parent;
   }

   public function getValeurCompAxe() {
       return $this->valeurCompAxe;
    }
   public function setValeurCompAxe($valeurcompaxe) {
       $this->valeurCompAxe = $valeurcompaxe;
   }
}