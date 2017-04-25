<?php

namespace GestionBudgetBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommuneType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nomCommune', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('departement', EntityType::class, array(
                'class' => 'GestionBudgetBundle\Entity\Departement',
                'choice_label' => 'nomDepartement',
                'attr' => array('class' => 'form-control')
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GestionBudgetBundle\Entity\Commune'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'gestionbudgetbundle_commune';
    }


}
