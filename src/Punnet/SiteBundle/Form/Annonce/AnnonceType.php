<?php

namespace Punnet\SiteBundle\Form\Annonce;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AnnonceType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('date')
            ->add('description')
            ->add('price')
            ->add('updated')
            ->add('ville')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Punnet\SiteBundle\Entity\Annonce\Annonce'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'punnet_sitebundle_annonce_annonce';
    }
}
