<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Punnet\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\Validator\Constraint\UserPassword as OldUserPassword;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class ProfileFormType extends AbstractType
{
    private $class;

    /**
     * @param string $class The User class name
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if (class_exists('Symfony\Component\Security\Core\Validator\Constraints\UserPassword')) {
            $constraint = new UserPassword();
        } else {
            // Symfony 2.1 support with the old constraint class
            $constraint = new OldUserPassword();
        }

        $this->buildUserForm($builder, $options);

        $builder->add('current_password', 'password', array(
            'label' => 'form.current_password',
            'translation_domain' => 'FOSUserBundle',
            'mapped' => false,
            'constraints' => $constraint,
            'attr' => array('class' => 'signin')
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->class,
            'intention'  => 'profile',
        ));
    }

    public function getName()
    {
        return 'fos_user_profile';
    }

    /**
     * Builds the embedded form representing the user.
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    protected function buildUserForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle', 'attr' => array('class' => 'signin')))
            ->add('email', 'email', array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle', 'attr' => array('class' => 'signin')))
            ->add('region','entity',array('required'		 	=> FALSE,
	            												   'class' 	        	=> 'PunnetSiteBundle:Region\Region',
																   'property' 	   		=> 'Region',
																   'label' 		   		=> 'Region:',
																   'empty_value'   		=> 'Choisissez votre Region...', 
															       'attr'		   		=> array('class' => 'profile_select')
															   ))
			->add('departement','entity', array('required'		 	=> FALSE,
	            												   'class' 	        	=> 'PunnetSiteBundle:Departement\Departement',
																   'property' 	   		=> 'departement',
																   'label' 		   		=> 'Département:',
																   'empty_value'   		=> 'Choisissez votre département...', 
															       'attr'		   		=> array('class' => 'profile_select')
															   ))												
            ->add('ville','entity', array('required'		 	=> FALSE,
	            												   'class' 	        	=> 'PunnetSiteBundle:Ville\Ville',
																   'property' 	   		=> 'ville',
																   'label' 		   		=> 'Ville:',
																   'empty_value'   		=> 'Choisissez votre ville...', 
															       'attr'		   		=> array('class' => 'profile_select')
															   ))
            ->add('surname', 'text' , array('label' => 'Prénom' , 'required' => FALSE, 'attr' => array( 'class' 			=> 'signin',
            																	  'placeholder' 		=> 'Prénom')))
            																	 
	        ->add('firstname', 'text' , array('label' => 'Nom' , 'required' => FALSE, 'attr' => array('class' 			=> 'signin',
	            																	   'placeholder' 	=> 'Nom')))
	            
	        ->add('phone', 'text' , array('label' => 'Téléphone' , 'required' => FALSE,  
										  'attr' => array('class' => 'signin',
	            																	  'placeholder'     => 'Ex: 0102030405')))
	        ->add('showphone','choice', array( 'label' 	 => 'Afficher le numéro' , 
	        				                   'choices' => array(
						                							'1' => 'Maquer mon numéro',
																	'2' => 'Toujours afficher mon numéro'),
											   'attr'	 => array('class' => 'profile_select')))
																		
	        ->add('description', 'textarea' , array('required' => FALSE, 'attr' => array(
	        										'class'    => 'login', 'placeholder'     => 'Une description de votre profile')))
		    ->add('file','file', array('required' => FALSE, 'label' => 'Votre photo',  'attr' => array('class' => 'login_file' )));
	        

        ;
    }
}
