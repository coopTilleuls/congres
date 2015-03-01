<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use AppBundle\Entity\Text\TextGroup;

class TextGroupAdmin extends Admin
{
    protected $baseRouteName = 'textgroup';
    protected $baseRoutePattern = 'textgroup';
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            //->add('id')
            ->add('name')
            ->add('description')
            ->add('submissionOpening')
            ->add('submissionClosing')
            ->add('voteOpening')
            ->add('voteClosing')
            ->add('voteType')
            ->add('voteModality')
            ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            //->add('id')
            ->add('author', 'sonata_type_model_autocomplete', array('property'=>'lastname'))
            ->add('name')
            ->add('description')
            ->add('submissionOpening')
            ->add('submissionClosing')
            ->add('voteOpening')
            ->add('voteClosing')
            ->add('voteType', 'choice', array(
                'label' => 'Type de vote',
                'choices' => array(
                    TextGroup::VOTETYPE_COLLECTIVE => "Vote collectif rapporté par procès verbal",
                    TextGroup::VOTETYPE_INDIVIDUAL => "Vote individuel directement sur le site",
                ),
                'multiple' => false,
            ))
            ->add('voteModality', 'choice', array(
                'label' => 'Mode de scrutin',
                'choices' => array(
                    TextGroup::VOTEMODALITY_VALIDATION => "Vote de selection des meilleurs textes",
                    TextGroup::VOTEMODALITY_REFERENDUM => "Vote referendaire",
                ),
                'multiple' => false,
            ))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
            ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            //->add('id')
            ->add('author', 'sonata_type_model_autocomplete', array('property'=>array('firstname', 'lastname')))
            ->add('name')
            ->add('description')
            ->add('submissionOpening')
            ->add('submissionClosing')
            ->add('voteOpening')
            ->add('voteClosing')
            ->add('voteType', 'choice', array(
                'label' => 'Type de vote',
                'choices' => array(
                    TextGroup::VOTETYPE_COLLECTIVE => "Vote collectif rapporté par procès verbal",
                    TextGroup::VOTETYPE_INDIVIDUAL => "Vote individuel directement sur le site",
                ),
                'multiple' => false,
            ))
            ->add('voteModality', 'choice', array(
                'label' => 'Mode de scrutin',
                'choices' => array(
                    TextGroup::VOTEMODALITY_VALIDATION => "Vote de selection des meilleurs textes",
                    TextGroup::VOTEMODALITY_REFERENDUM => "Vote referendaire",
                ),
                'multiple' => false,
            ))
            ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            //->add('id')
            ->add('name')
            ->add('author', 'sonata_type_model_autocomplete', array('property'=>array('firstname', 'lastname')))
            ->add('description')
            ->add('submissionOpening')
            ->add('submissionClosing')
            ->add('voteOpening')
            ->add('voteClosing')
            ->add('voteType', 'choice', array(
                'label' => 'Type de vote',
                'choices' => array(
                    TextGroup::VOTETYPE_COLLECTIVE => "Vote collectif rapporté par procès verbal",
                    TextGroup::VOTETYPE_INDIVIDUAL => "Vote individuel directement sur le site",
                ),
                'multiple' => false,
            ))
            ->add('voteModality', 'choice', array(
                'label' => 'Mode de scrutin',
                'choices' => array(
                    TextGroup::VOTEMODALITY_VALIDATION => "Vote de selection des meilleurs textes",
                    TextGroup::VOTEMODALITY_REFERENDUM => "Vote referendaire",
                ),
                'multiple' => false,
            ))
            ;
    }
    public function getNewInstance()
    {
        $instance = parent::getNewInstance();
        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        //$repo = $this->getDoctrine()->getRepository('AppBundle:Adherent')->findId($user->adherent);

        
        if ($instance->getAuthor() == NULL)
        {
            $instance->setAuthor($user->getProfile());
        }

        return $instance;
    }
}
