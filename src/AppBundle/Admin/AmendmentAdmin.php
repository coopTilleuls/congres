<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Text\Amendment;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * Amendment administration.
 *
 * @author Kévin Dunglas <kevin@les-tilleuls.coop>
 */
class AmendmentAdmin extends Admin
{
    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->add('text', null, array('label' => 'Texte'))
            ->add('author', null, array('label' => 'Auteur'))
            ->add('startLine', null, array('label' => 'Ligne'))
            ->add('type', 'choice', array('label' => 'Type de modification', 'choices' => Amendment::getTypes()))
            ->add('content', null, array('label' => 'Contenu'))
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('text', null, array('label' => 'Texte'))
            ->add('author', null, array('label' => 'Auteur'))
            ->add('startLine', null, array('label' => 'Ligne'))
            ->add('type', null, array('label' => 'Type de modification'))
            ->add('content', null, array('label' => 'Contenu'))
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('id')
            ->add('text', null, array('label' => 'Texte'))
            ->add('author', null, array('label' => 'Auteur'))
            ->add('startLine', null, array('label' => 'Ligne'))
            ->add('humanReadableType', null, array('label' => 'Type de modification'))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                ),
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('text', null, array('label' => 'Texte'))
            ->add('author', null, array('label' => 'Auteur'))
            ->add('startLine', null, array('label' => 'Ligne'))
            ->add('type', null, array('label' => 'Type de modification'), 'choice', array('choices' => Amendment::getTypes()))
            ->add('content', null, array('label' => 'Contenu'))
        ;
    }

    /**
     * @return array
     */
    public function getExportFields()
    {
        return array(
            'text',
            'author',
            'startLine',
            'humanReadableType',
            'content',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getExportFormats()
    {
        return array(
            'xls',
        );
    }
}
