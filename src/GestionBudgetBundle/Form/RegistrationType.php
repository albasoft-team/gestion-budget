<?php

namespace GestionBudgetBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
class RegistrationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom')
            ->add('prenom')
            ->add('adresse')
            ->add('region',EntityType::class, array(
        // query choices from this entity
        'class' => 'GestionBudgetBundle\Entity\Region',

        // use the User.username property as the visible option string
        'choice_label' => 'nomRegion',
        'attr' => array("class" => "form-control")
        // used to render a select box, check boxes or radios
        // 'multiple' => true,
        // 'expanded' => true,
            ))
            ->add('departement',EntityType::class, array(
                // query choices from this entity
                'class' => 'GestionBudgetBundle\Entity\Departement',

                // use the User.username property as the visible option string
                'choice_label' => 'nomDepartement',
                'attr' => array("class" => "form-control")
                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ))
            ->add('commune',EntityType::class, array(
                // query choices from this entity
                'class' => 'GestionBudgetBundle\Entity\Commune',

                // use the User.username property as the visible option string
                'choice_label' => 'nomCommune',
                'attr' => array("class" => "form-control")
                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ));

    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';

        // Or for Symfony < 2.8
        // return 'fos_user_registration';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }
    
//    /**
//     * {@inheritdoc}
//     */
//    public function configureOptions(OptionsResolver $resolver)
//    {
//        $resolver->setDefaults(array(
//            'data_class' => 'GestionBudgetBundle\Entity\User'
//        ));
//    }
//
//    /**
//     * {@inheritdoc}
//     */
//    public function getBlockPrefix()
//    {
//        return 'gestionbudgetbundle_user';
//    }



}
