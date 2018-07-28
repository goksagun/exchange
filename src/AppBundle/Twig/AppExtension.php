<?php

namespace AppBundle\Twig;

use AppBundle\Entity\Exchange;
use AppBundle\Utils\Helper;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('currency_symbol', [$this, 'currencySymbolFilter']),
            new TwigFilter('title_case', [$this, 'titleCaseFilter']),
        ];
    }

    public function currencySymbolFilter($code)
    {
        return Exchange::CURRENCY_SYMBOLS[$code] ?? '';
    }

    public function titleCaseFilter($value)
    {
        return Helper::titleCase($value);
    }
}