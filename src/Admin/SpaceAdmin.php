<?php


namespace App\Admin;


use App\Entity\Place;
use App\Entity\Space;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SpaceAdmin extends AbstractAdmin
{

    /**
     * This method configures which fields are displayed on the edit and create actions.
     * The FormMapper behaves similar to the FormBuilder of the Symfony Form component;
     *
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Dane główne')
            ->add('name', TextType::class, ['label' => 'Nazwa'])
            ->add('description', TextareaType::class, ['label' => 'Opis','required' => false])
            ->end()
            ->with('Relacja')
            ->add('places', ModelType::class, [
                'required' => false,
                'multiple' => true,
                'class' => Place::class,
                'property' => 'name',
                'label' => 'Miejsce'
            ])
            ->end()
        ;
    }

    /**
     * This method configures the filters, used to filter and sort the list of models;
     *
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name',null,['label'=>'Nazwa'])
            ->add('places',null,['label'=>'Miejsce'])
        ;

    }

    /**
     * Here you specify which fields are shown when all models are listed
     * (the addIdentifier() method means that this field will link to the show/edit page of this particular model).
     *
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name',null,['label'=>'Nazwa'])
            ->add('description',null,['label'=>'Opis'])
            ->add('places',null, [
                    'associated_property' => 'name',
                    'label'=>'Miejsca',
                    'sort_field_mapping' => [
                        'fieldName' => 'name'
                    ]
                ])
        ;
    }

    public function toString($object)
    {
        return $object instanceof Space
            ? $object->getName()
            : 'Przestrzeń'; // shown in the breadcrumb on the create view
    }


}