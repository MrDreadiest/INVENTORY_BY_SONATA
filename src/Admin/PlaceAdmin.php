<?php


namespace App\Admin;

use App\Entity\Place;
use App\Entity\PlaceCategory;
use App\Entity\Space;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class PlaceAdmin extends AbstractAdmin
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
                ->add('placeCategory', ModelType::class, [
                    'class' => PlaceCategory::class,
                    'property' => 'name',
                    'label' => 'Kategoria miejsca'
                ])
            ->add('space', ModelType::class, [
                'class' => Space::class,
                'property' => 'name',
                'label' => 'Przestrzeń'
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
            ->add('placeCategory',null,['label'=>'Kategoria miejsca'])
            ->add('space',null,['label'=>'Przestrzeń'])
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
            ->add('placeCategory.name',null,['label'=>'Kategoria miejsca'])
            ->add('space.name',null,['label'=>'Przestrzeń'])
        ;
    }

    public function toString($object)
    {
        return $object instanceof Place
            ? $object->getName()
            : 'Miejsce'; // shown in the breadcrumb on the create view
    }

}