<?php

namespace Neon\ExchangeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Description of QuestionType
 *
 * @author David Yell <neon1024@gmail.com>
 */
class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('title')
            ->add('question');
    }

    public function getName() {
        return 'add_question_form';
    }

    public function setDefaultOptions(\Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Neon\ExchangeBundle\Entity\Question'
        ));
    }


}