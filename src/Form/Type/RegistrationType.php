<?php

namespace App\Form\Type;

use FOS\UserBundle\Form\Type\RegistrationFormType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;

/**
 * Class RegistrationType
 * @package App\Form\Type
 */
class RegistrationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('city',
            null,
            [
                'label' => 'form.city',
                'translation_domain' => 'FOSUserBundle',
                'required' => false,
            ]
        );
        $builder->add('country',
            CountryType::class,
            [
                'label' => 'form.country',
                'translation_domain' => 'FOSUserBundle',
                'preferred_choices' => ['FR'],
                'required' => false,
                'placeholder' => false,
            ]
        );
        $builder->add('avatarFile', VichImageType::class, [
            'label' => false,
            'translation_domain' => 'messages',
            'allow_delete' => false,
            'required' => false,
        ]);
    }

    /**
     * @return null|string
     */
    public function getParent()
    {
        return RegistrationFormType::class;
    }

    /**
     * @return null|string
     */
    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    /**
     * @return null|string
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
