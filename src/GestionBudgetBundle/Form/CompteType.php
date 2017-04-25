<?php

namespace GestionBudgetBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('libelle', TextType::class, array("attr" => array("class" => "form-control")))
            ->add('numeroCompte', TextType::class, array("attr" => array("class" => "form-control")))
            ->add('chapitre', EntityType::class, array(
                // query choices from this entity
                'class' => 'GestionBudgetBundle\Entity\Chapitre',

                // use the User.username property as the visible option string
                'choice_label' => 'designation',
                'attr' => array("class" => "form-control")
                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GestionBudgetBundle\Entity\Compte'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'gestionbudgetbundle_compte';
    }


}
