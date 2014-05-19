<?php
namespace Neon\ExchangeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * LoginType
 *
 * @author David Yell <neon1024@gmail.com>
 */
class LoginType extends AbstractType {
	
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('email')
            ->add('password');
    }

    public function getName() {
        return 'user_login_form';
    }

    public function setDefaultOptions(\Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver) {
        // No default entity data to load
    }
	
}