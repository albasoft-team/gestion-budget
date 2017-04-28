<?php

namespace GestionBudgetBundle\Form;

use Doctrine\ORM\EntityRepository;
use FOS\UserBundle\Event\FormEvent;
use GestionBudgetBundle\Entity\Departement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;

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
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('commune')
                        ->orderBy('commune.nomCommune', 'ASC');
                },
                'required' => false,
                'empty_data' =>null,
                'preferred_choices' => array(),
                'attr' => array("class" => "form-control")
                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ));
//        $formEditModel = function (FormInterface $form, Departement $departement = null) {
//
//                $form->add('commune',EntityType::class, array(
//                    // query choices from this entity
//                    'class' => 'GestionBudgetBundle\Entity\Commune',
//
//                    // use the User.username property as the visible option string
//                    'choice_label' => 'nomCommune',
////                    'query_builder' => function(EntityRepository $er) {
////                        return $er->createQueryBuilder('commune')
////                            ->orderBy('commune.nomCommune', 'ASC');
////                    },
//                    'required' => false,
//                    'empty_data' =>null,
//                    'preferred_choices' => array(),
//                    'attr' => array("class" => "form-control")
//                    // used to render a select box, check boxes or radios
//                    // 'multiple' => true,
//                    // 'expanded' => true,
//                ));
//        };
//        $builder->addEventListener(FormEvents::PRE_SET_DATA,function (FormEvent $event)
//        use ($formEditModel){
//            $data=$event->getForm()->getData();
//            $formEditModel($event->getForm(),$data);
//        });
//        $builder->get('departement')->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event)
//        use ($formEditModel){
//            $departement=$event->getForm()->getData();
//            $formEditModel($event->getForm()->getParent(),$departement);
//        });


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
