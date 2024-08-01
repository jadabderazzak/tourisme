<?php


namespace App\Twig;

use Twig\TwigFunction;
use Twig\Extension\GlobalsInterface;
use Twig\Extension\AbstractExtension;
use Symfony\Component\HttpFoundation\RequestStack;

class AppExtension extends AbstractExtension implements GlobalsInterface
{
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function getGlobals(): array
    {
        $locale = $this->requestStack->getCurrentRequest()->getLocale();
        $dirs = $locale === 'ar' ? 'rtl' : 'ltr';

        return [
            'dirs' => $dirs,
        ];
    }
    public function getFunctions()
    {
        return [
            new TwigFunction('is_arabic', [$this, 'isArabic']),
        ];
    }

    public function isArabic(string $text): bool
    {
        return preg_match('/[\p{Arabic}]/u', $text) > 0;
    }
}
