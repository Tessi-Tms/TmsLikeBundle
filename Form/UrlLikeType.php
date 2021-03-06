<?php

/**
 * @author Eddie BARRACO <eddie.barraco@idci-consulting.fr>
 */

namespace Tms\Bundle\LikeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Tms\Bundle\LikeBundle\Entity\UrlLike;

class UrlLikeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('url', UrlType::class, array(
                'default_protocol' => null
            ))
            ->add('userId');
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Tms\Bundle\LikeBundle\Entity\UrlLike'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'tms_bundle_likebundle_urlliketype';
    }
}
