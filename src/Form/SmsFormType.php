<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class SmsFormType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                child: 'from',
                type: TextType::class,
                options: $this->phoneNumberOptions(label: '* From')
            )
            ->add(
                child: 'to',
                type: TextType::class,
                options: $this->phoneNumberOptions(label: '* To')
            )
            ->add(
                child: 'text',
                type: TextareaType::class,
                options: [
                    'label' => '* Message',
                    'label_attr' => [
                        'class' => 'form-label',
                    ],
                    'attr' => [
                        'class' => 'form-control rounded-1 message',
                    ],
                    'row_attr' => ['class' => 'col-12 mb-4'],
                    'constraints' => [
                        new NotBlank(options: [
                            'message' => 'Please enter a message.'
                        ]),
                    ],
                ]
            )
            ->add(
                child: 'send',
                type: SubmitType::class,
                options: [
                    'label' => 'Send',
                    'attr' => [
                        'class' => 'btn btn-outline-primary rounded-1'
                    ],
                    'row_attr' => [
                        'class' => 'col-md-12 d-flex justify-content-end align-content-center'
                    ],
                ]
            );
    }

    /**
     * @param string $label
     * @return array
     */
    private function phoneNumberOptions(string $label): array
    {
        return [
            'label' => $label,
            'label_attr' => [
                'class' => 'form-label',
            ],
            'attr' => [
                'class' => 'form-control rounded-1',
            ],
            'row_attr' => ['class' => 'col-lg-6 col-12 mb-4'],
            'constraints' => [
                new NotBlank(options: [
                    'message' => 'Please enter your phone number.'
                ]),
                new Length(options: [
                    'min' => 9,
                    'max' => 15,
                    'minMessage' => 'Your phone number should be at least {{ limit }} characters.',
                    'maxMessage' => 'Your phone number cannot be longer than {{ limit }} characters.'
                ]),
            ],
        ];
    }

    /**
     * @param OptionsResolver $resolver
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'attr' => ['class' => 'g-3'],
        ]);
    }
}