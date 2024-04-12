<?php

namespace Websystems\StructureBundle\Admin\Field;

use Symfony\Component\Asset\Package;
use EasyCorp\Bundle\EasyAdminBundle\Config\Asset;
use Websystems\StructureBundle\Form\StructureType;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;

final class StructureField implements FieldInterface
{
    use FieldTrait;

    public static function new(string $propertyName, $label = null): self
    {
        $assetPackage = new Package(new EmptyVersionStrategy());
        $assetUrl = $assetPackage->getUrl('/bundles/structure/structure_index.js');

        return (new self())
            ->setProperty($propertyName)
            ->setLabel($label)
            ->setFormType(StructureType::class)
            ->addFormTheme('@Structure/admin/structure_field.html.twig')
            ->addCssFiles('/bundles/structure/structure_index.css')
            ->addJsFiles(Asset::new($assetUrl)->htmlAttr('type', 'module'))
        ;
    }
    
}