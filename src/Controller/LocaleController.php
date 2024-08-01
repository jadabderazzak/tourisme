<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LocaleController extends AbstractController
{
    /**
     * @Route("/change/locales/{locale}", name="change_locale")
     */
    public function changeLocale($locale, Request $request)
    {
        $request->getSession()->set('_locale', $locale);
        // Redirige vers la page précédente ou vers une page spécifique après le changement de langue
        $referer = $request->headers->get('referer', $this->generateUrl('app_home'));
        return new RedirectResponse($referer);
    }
}