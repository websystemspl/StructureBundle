<?php

namespace Websystems\StructureBundle\Form;

use Symfony\Component\Form\FormView;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class StructureType extends AbstractType
{
    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        $view->vars['pattern'] = null;
        unset($view->vars['attr']['pattern']);
    }

    public function getParent(): ?string
    {
        return TextareaType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'structure';
    }
}
