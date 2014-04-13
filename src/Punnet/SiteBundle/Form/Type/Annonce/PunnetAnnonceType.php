<?php

namespace Punnet\SiteBundle\Form\Type\Annonce;

use Punnet\SiteBundle\Form\Annonce\AnnonceType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PunnetAnnonceType extends AnnonceType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
             ->add('title', 'text', array('attr' => array( 
            											  'placeholder' => 'Le titre de l\'annonce',
														  'label'		=> 'Titre'
            											 )) )
            ->add('description')
            ->add('price', 'text', array('attr' => array( 
            											  'placeholder' => '1000€',
														  'label'		=> 'Tarif',
														  'class'		=> 'price'
            											 )) )
            ->add('ville');
        
        $builder
        	->remove('date')
        	->remove('updated');
        
    }
}
