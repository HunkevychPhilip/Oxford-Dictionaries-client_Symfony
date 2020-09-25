<?php

namespace App\Controller;

use App\Service\Client\GuzzleClient;
use App\Service\Dictionary;
use Symfony\Component\String\Exception\InvalidArgumentException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="app_search")
     * @param Request $request
     * @param Dictionary $dictionary
     *
     * @return Response
     * @throws \App\Service\DictionaryException
     */
    public function search(Request $request, Dictionary $dictionary): Response

    {
        $searchForm = $request->query->all('search_form');

        if (isset($searchForm['word'])) {
            $word = strtolower($searchForm['word']);
        } else {
            throw new InvalidArgumentException('It looks like you didn\'t fill the \'word\' field!!');
        }

        if (isset($searchForm['language'])) {
            $lang = $searchForm['language'];
        } else {
            throw new InvalidArgumentException('\'language\' field is missing!');
        }

        $results = $dictionary->entries($lang, $word);

        return $this->render('main/search.html.twig', [
            'word' => $word,
            'language' => $lang,
            'results' => $results,
        ]);
    }
}
