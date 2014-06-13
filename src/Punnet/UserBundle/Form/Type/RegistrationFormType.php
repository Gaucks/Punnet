<?php
 
namespace Punnet\UserBundle\Form\Type;
 
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Punnet\SiteBundle\Entity\Region\Region;
 
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
															))
				->add('region', 'entity', array('class' 			=> 'PunnetSiteBundle:Region\Region',
												'property' 	   		=> 'Region',
												'label' 		   	=> 'Région:',
												'empty_value'   	=> 'Choisissez votre Region...',
												'attr'  			=> array('class' => 'signup')))
				->add('departement','text', array('attr' 			=> array('class' => 'signup')));								
		
		$factory = $builder->getFormFactory();
		
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function(FormEvent $event) use ($factory) {

                $data = $event->getData();
                
                if (null === $data) {
					return; // On sort de la fonction lorsque $data vaut null
					}
					
					// Si l'article n'est pas encore publié, on ajoute le champ publication
			        if (false === $data->getRegion()) {
			          	$event->getForm()->add(
			            $factory->createNamed('departement', 'text', array(), array('auto_initialize' => false)));
			         }
			         else { // Sinon, on le supprime
						 $event->getForm()->remove('departement', 'text', array('auto_initialize' => false));
						 }
        
		});
		
    }
    
    public function getName()
    {
        return 'fos_user_registration';
    }

}