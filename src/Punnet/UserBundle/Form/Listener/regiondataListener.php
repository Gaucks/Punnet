<?php
 
namespace Punnet\UserBundle\Form\Listener;
 
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\Event\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
 
use Doctrine\ORM\EntityManager;
 
class RegionDataListener implements EventSubscriberInterface
{
    private $factory;
    private $entityManager;
 
    public function __construct(FormFactoryInterface $factory,EntityManager $em)
    {
        $this->factory = $factory;
        $this->entityManager = $em;
         
    }
 
    public static function getSubscribedEvents()
    {
        return array(
        FormEvents::PRE_SET_DATA => 'preSetData',
        FormEvents::PRE_BIND => 'preBind',
        );
    }
 
    public function preSetData(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();
 
        //est declanché a la creation du formulaire!
         
        //presetdata peut donc avoir deux types de valeurs: NULL (dans le cadre d'une création, le type de materiel n'est pas selectionné!, on ne peut donc pas remplir le select avec les valeurs appropriées!)
        //la solution serait donc d'allouer une valeur par défaut à "type de matériel" pour ne pas nous retrouver dans le cas ou notre select ne serait pas initialisé, donc erreur au rendu TWIG qui attend une variable!
        if($data === null)
        {
            return;
        }
        else
        {
            //si Data n'est pas null, on est donc dans le cas d'une modification ou d'un affichage, il nous faut  récupérer le contenu de notre select "type de materiel" pour remplir de valeurs le second!
            //Je rappel que Data nous renvoie l'entité "Materiel" dont l'attribut typeMateriel pointe vers l'entité TypeDeMateriel d'ou la ligne suivante qui permet tout simplement de récupérer toutes les entitées Vis par exemple
 
            $departements = $this->entityManager->getRepository('PunnetSiteBundle:Departement\Departement')->findBy(array('region' => $data->getRegion());
             
                        $form->add($this->factory->createNamed('departement','entity',null, array()));
        }
     
    }
     
     
    public function preBind(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();
         
        //EST EXECUTE DES VALIDATION DU FORMULAIRE!!!! (inutile dans mon cas mais bon a savoir...)
         
    }
     
}