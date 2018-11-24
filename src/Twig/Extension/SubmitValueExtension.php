<?php
/**
 * This file is part of a Lyssal project.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\SearchEngineBundle\Twig\Extension;

use Twig_Extension;
use Twig_SimpleFunction;

/**
 * The Twig extension to get the submit value.
 */
class SubmitValueExtension extends Twig_Extension
{
    /**
     * @var string The submit value
     */
    protected $submitValue;


    /**
     * SubmitValueExtension constructor.
     *
     * @param string $submitValue The submit value
     */
    public function __construct(string $submitValue)
    {
        $this->submitValue = $submitValue;
    }


    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('lyssal_searchengine_submitvalue', array($this, 'getSubmitValue'), ['is_safe' => ['html']])
        ];
    }


    /**
     * Get the submit value
     *
     * @return string The submit value
     */
    public function getSubmitValue(): string
    {
        return $this->submitValue;
    }
}
