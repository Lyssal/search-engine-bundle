<?php
/**
 * This file is part of a Lyssal project.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\SearchEngineBundle\Controller;

use Lyssal\SearchEngine\Setting\SettingFactory;
use Lyssal\SearchEngineBundle\Form\Type\SearchEngineType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * The controller for the search.
 *
 * @Route("/search")
 */
class SearchController extends AbstractController
{
    /**
     * @var string The default search engine
     */
    public const SEARCH_ENGINE_DEFAULT = 'qwant';


    /**
     * Display the search form.
     *
     * @Route("/form", name="lyssal_searchengine_search_form", methods={"GET", "POST"})
     *
     * @param \Symfony\Component\HttpFoundation\Request $request      The request
     * @param string|null                               $searchEngine The search engine
     * @param string|null                               $website      The website
     * @param string|null                               $template     The template
     * @return \Symfony\Component\HttpFoundation\Response The search form
     */
    public function form(Request $request, $searchEngine = null, $website = null, $template = null)
    {
        if (null === $searchEngine) {
            $searchEngine = $this->getSearchEngine($request);
        }
        $website = $this->getWebsite($website, $request);

        $form = $this->createForm(SearchEngineType::class, null, [
            'search_engine' => $searchEngine,
            'website' => $website
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $query = $form->get('query')->getData();
            $searchEngine = $form->get('searchEngine')->getData();
            $website = $form->get('website')->getData();

            $settingFactory = new SettingFactory();
            $engineSetting = $settingFactory->getSetting($searchEngine)
                ->setWebsite($website)
                ->setQuery($query);

            return $this->redirect($engineSetting->generateSearchUrl());
        }

        $template = $this->getTemplate($template);

        return $this->render('@LyssalSearchEngine/search/form/'.$template.'.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Get the search engine.
     *
     * @return string The search engine
     */
    protected function getSearchEngine(): string
    {
        // Unfortunately $this->getParameter() does not work with render(controller())
        if ($this->container instanceof ContainerInterface) {
            // Check the parameter
            $searchEngine = $this->container->getParameter('lyssal_search_engine.search_engine.default');
            if (null !== $searchEngine) {
                return $searchEngine;
            }
        }

        // Search engine by default
        return self::SEARCH_ENGINE_DEFAULT;
    }

    /**
     * Get the website.
     *
     * @param string|null                               $website The custom website
     * @param \Symfony\Component\HttpFoundation\Request $request The request
     * @return string The website
     */
    protected function getWebsite(?string $website, Request $request): ?string
    {
        // We do not want to search in a host
        if ($this->container instanceof ContainerInterface && !$this->container->getParameter('lyssal_search_engine.host.search_on_host')) {
            return null;
        }

        // If the user want a specific website
        if (null !== $website) {
            return $website;
        }

        // Get host in config
        if ($this->container instanceof ContainerInterface) {
            $website = $this->container->getParameter('lyssal_search_engine.host.default');
        }

        // Else get current host
        if (null === $website) {
            $website = $request->getHttpHost();
        }

        return $website;
    }

    /**
     * Get the template.
     *
     * @param string|null $template The custom template
     * @return string The template
     */
    protected function getTemplate(?string $template): string
    {
        // If the user want a specific template
        if (null !== $template) {
            return $template;
        }

        // Get template in config
        if ($this->container instanceof ContainerInterface) {
            $template = $this->container->getParameter('lyssal_search_engine.templating.form_template');
        } else {
            $template = 'default';
        }

        return $template;
    }
}
