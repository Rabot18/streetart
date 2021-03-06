<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Class SitemapController.
 */
class SitemapController extends AbstractController
{
    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * SitemapController constructor.
     *
     * @param TranslatorInterface $translator
     */
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function __invoke(Request $request)
    {
        $locale = $request->getLocale();
        // TODO generate or config file
        $routes = [
            [
                'title' => '<a href="/'.$locale.'/map">'.$this->translator->trans('nav.link.sitemap').'</a>',
                'content' => '',
            ],
            [
                'title' => '<a href="/'.$locale.'/list">'.$this->translator->trans('header.menu.list').'</a>',
                'content' => '',
            ],
            [
                'title' => '<a href="/'.$locale.'/artist-list">'.$this->translator->trans('header.menu.artistlist').'</a>',
                'content' => '',
            ],
            [
                'title' => '<a href="/'.$locale.'/blog">'.$this->translator->trans('header.menu.blog').'</a>',
                'content' => '',
            ],
            [
                'title' => '<a href="/'.$locale.'/faq">'.$this->translator->trans('nav.link.faq').'</a>',
                'content' => '',
            ],
            [
                'title' => '<a href="/'.$locale.'/sitemap">'.$this->translator->trans('nav.link.sitemap').'</a>',
                'content' => '',
            ],
            [
                'title' => '<a href="/'.$locale.'/legals">'.$this->translator->trans('nav.link.legals').'</a>',
                'content' => '',
            ],
            [
                'title' => '<a href="/'.$locale.'/artwork/new">'.$this->translator->trans('header.menu.submit').'</a>',
                'content' => '',
            ],
        ];

        return $this->render('pages/content.html.twig', [
            'list' => $routes,
            'pageTitle' => $this->translator->trans('title.sitemap', [], 'Metas'),
            'pageDescription' => $this->translator->trans('description.sitemap', [], 'Metas'),
        ]);
    }
}
