<?php
 
namespace Punnet\UserBundle\Form\Type;
 
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
 
class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        
        $builder->add('email', 'email', array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle', 
											  'attr'  => array('class' => 'signup')))
				->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle', 
											  'attr'  => array('class' => 'signup')))
				->add('plainPassword', 'repeated',  array(	'type' 				=> 'password',
														    'options' 			=> array('translation_domain' => 'FOSUserBundle'),
														    'first_options' 	=> array('label' => 'form.password',
														    'attr'				=> array('class' => 'signup')),
														    'second_options' 	=> array('label' => 'form.password_confirmation', 															'attr' 				=> array('class' => 'signup')),
															));
    }
    
    public function getName()
    {
        return 'fos_user_registration';
    }

}