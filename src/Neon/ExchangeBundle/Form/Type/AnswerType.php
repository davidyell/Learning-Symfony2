<?php

namespace Neon\ExchangeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Description of AnswerType
 *
 * @author David Yell <neon1024@gmail.com>
 */
class AnswerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('answer');
    }

    public function getName() {
        return 'add_answer_form';
    }

    public function setDefaultOptions(\Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Neon\ExchangeBundle\Entity\Answer'
        ));
    }


}