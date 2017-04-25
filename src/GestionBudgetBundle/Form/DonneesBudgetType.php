<?php

namespace GestionBudgetBundle\Form;

use Doctrine\DBAL\Types\FloatType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DonneesBudgetType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('budgetDemande', NumberType::class, array('required' => false, 'attr' => array('class' => 'form-control')))
            ->add('budgetVote', NumberType::class, array('required' => false,'attr' => array('class' => 'form-control')))
            ->add('budgetrecouvre',NumberType::class, array('required' => false, 'attr' => array('class' => 'form-control')))
            ->add('departement', EntityType::class, array(
                'class' => 'GestionBudgetBundle\Entity\Departement',
                'choice_label' => 'nomDepartement',
                'attr' => array('class' => 'form-control')
            ))
            ->add('commune', EntityType::class, array(
                'class' => 'GestionBudgetBundle\Entity\Commune',
                'choice_label' => 'nomCommune',
                'attr' => array('class' => 'form-control')
            ))
            ->add('compte', EntityType::class, array(
                'class' => 'GestionBudgetBundle\Entity\Compte',
                'choice_label' => 'numeroCompte',
                'attr' => array('class' => 'form-control')
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GestionBudgetBundle\Entity\DonneesBudget'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'gestionbudgetbundle_donneesbudget';
    }


}
