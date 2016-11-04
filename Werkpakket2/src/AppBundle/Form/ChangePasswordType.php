<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ChangePasswordType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options)
{
$builder->add('oldPassword', PasswordType::class);
$builder->add('newPassword', RepeatedType::class, array(
'invalid_message' => 'The password fields must match.',
'required' => true,
'first_options'  => array('label' => 'Password'),
'second_options' => array('label' => 'Repeat Password'),
));
}

public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$resolver->setDefaults(array(
'data_class' => 'AppBundle\Form\Model\ChangePassword',
));
}

public function getName()
{
return 'change_password';
}
}