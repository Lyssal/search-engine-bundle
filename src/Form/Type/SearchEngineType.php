<?php
/**
 * This file is part of a Lyssal project.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\SearchEngineBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * The search engine form.
 */
class SearchEngineType extends AbstractType
{
    /**
     * @var \Symfony\Component\Routing\Generator\UrlGeneratorInterface The URL generator
     */
    protected $urlGenerator;


    /**
     * SearchEngineType constructor.
     *
     * @param \Symfony\Component\Routing\Generator\UrlGeneratorInterface $urlGenerator The URL generator
     */
    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }


    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $searchEngine = $options['search_engine'];
        $website = $options['website'];

        $builder
            ->setAction($this->urlGenerator->generate('lyssal_searchengine_search_form'))
            ->add('searchEngine', HiddenType::class, [
                'data' => $searchEngine
            ])
            ->add('website', HiddenType::class, [
                'data' => $website
            ])
            ->add('query', SearchType::class)
        ;
    }


    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setRequired('search_engine')
            ->setRequired('website')
        ;
    }
}
