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
     * @param string                                    $template     The template
     * @param string                                    $searchEngine The search engine
     * @return \Symfony\Component\HttpFoundation\Response The search form
     */
    public function form(Request $request, $template = 'default', $searchEngine = null, $website = null)
    {
        if (null === $searchEngine) {
            $searchEngine = $this->getDefaultSearchEngine($request);
        }
        if (null === $website) {
            $website = $request->getHttpHost();
        }

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

        return $this->render('@LyssalSearchEngine/search/form/'.$template.'.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Get the search engine.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request The request
     * @return string The search engine
     */
    protected function getDefaultSearchEngine(Request $request): string
    {
        // Unfortunately $this->getParameter() does not work with render(controller())
        if ($this->container instanceof ContainerInterface) {
            // Check the parameter
            $searchEngine = $this->container->getParameter('lyssal_search_engine.default_search_engine');
            if (null !== $searchEngine) {
                return $searchEngine;
            }
        }

        // Search engine by default
        return self::SEARCH_ENGINE_DEFAULT;
    }
}
