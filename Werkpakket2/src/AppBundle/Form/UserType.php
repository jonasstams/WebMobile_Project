<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\User;
use Symfony\Component\Security\Core\Role\RoleHierarchy;
class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('username', TextType::class, array(
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('password', TextType::class, array(
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('rolesString', ChoiceType::class, array(
                'choices' => array('Admin' => 'ROLE_ADMIN','Coach' => 'ROLE_COACH', 'Both' => 'ROLE_ADMIN ROLE_COACH'),
                'multiple' => false,
                'label'  => 'Role',
                'required' => true,
                'attr' => array(
                    'class' => 'form-control'
                )

            ));

    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User'
        ));
    }
}
