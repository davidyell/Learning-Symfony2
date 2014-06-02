<?php
namespace Neon\ExchangeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * TagType
 *
 * @author David Yell <neon1024@gmail.com>
 */
class TagType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('name');
    }

    public function getName() {
        return 'tag_add_form';
    }

    public function setDefaultOptions(\Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Neon\ExchangeBundle\Entity\Tag'
        ));
    }
}