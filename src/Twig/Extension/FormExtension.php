<?php
/**
 * This file is part of a Lyssal project.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\SearchEngineBundle\Twig\Extension;

use Symfony\Bridge\Twig\Extension\HttpKernelRuntime;
use Symfony\Component\HttpKernel\Controller\ControllerReference;
use Twig_Extension;
use Twig_SimpleFunction;

/**
 * The Twig extension to display the form.
 */
class FormExtension extends Twig_Extension
{
    /**
     * @var \Symfony\Bridge\Twig\Extension\HttpKernelRuntime The Twig extension for render()
     */
    protected $httpKernelRuntime;


    /**
     * FormExtension constructor.
     *
     * @param \Symfony\Bridge\Twig\Extension\HttpKernelRuntime $httpKernelRuntime The Twig extension for render()
     */
    public function __construct(HttpKernelRuntime $httpKernelRuntime)
    {
        $this->httpKernelRuntime = $httpKernelRuntime;
    }


    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('lyssal_searchengine_display', array($this, 'display'), ['is_safe' => ['html']])
        ];
    }


    /**
     * Display the form.
     *
     * @param array $attributes The form attributes
     * @return string The form
     */
    public function display(array $attributes = []): string
    {
        return $this->httpKernelRuntime->renderFragment(
            new ControllerReference('Lyssal\\SearchEngineBundle\\Controller\\SearchController:form', $attributes)
        );
    }
}
