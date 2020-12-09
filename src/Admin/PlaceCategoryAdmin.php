<?php


namespace App\Admin;


use App\Entity\PlaceCategory;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PlaceCategoryAdmin extends AbstractAdmin
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
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
        ;

    }

    /**
     * This method configures the filters, used to filter and sort the list of models;
     *
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name',null,['label'=>'Nazwa']);
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
        ;
    }

    public function toString($object)
    {
        return $object instanceof PlaceCategory
            ? $object->getName()
            : 'Kategoria miejsca'; // shown in the breadcrumb on the create view
    }

}