<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;

class AccountType extends AbstractType
{
    public function __construct(private readonly TranslatorInterface $translatable) { }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $username = $this->translatable->trans('site.account.nickname');
        $usernameHtml = $this->translatable->trans('site.account.nickname_label_html');
        $firstName = $this->translatable->trans('site.account.first_name');
        $lastName = $this->translatable->trans('site.account.last_name');
        $phone = $this->translatable->trans('site.account.phone');
        $email = $this->translatable->trans('site.account.email');

        $builder
            ->add('username', null, [
                'label' => $usernameHtml,
                'attr' => ['placeholder' => $username],
                'required' => true,
                'label_html' => true
            ])
            ->add('first_name', null, [
                'label' => $firstName,
                'attr' => ['placeholder' => $firstName]
            ])
            ->add('last_name', null, [
                'label' => $lastName,
                'attr' => ['placeholder' => $lastName]
            ])
            ->add('phone', null, [
                'label' => $phone,
                'attr' => ['placeholder' => $phone]
            ])
            ->add('email', EmailType::class, [
                'label' => $email,
                'attr' => ['placeholder' => $email],
                'required' => false
            ])
            ->add('photoUrl', null, [
                'required' => false,
                'attr' => ['class' => 'd-none']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'validation_groups' => ['edit']
        ]);
    }
}
