<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class ViteAssetsExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            new TwigFilter('vite_load_css', [$this, 'vite_load_css'],['is_safe' => ['html']]),
            new TwigFilter('vite_load_js', [$this, 'vite_load_js'],['is_safe' => ['html']]),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('vite_load_css', [$this, 'vite_load_css'], ['is_safe' => ['html']]),
            new TwigFunction('vite_load_js', [$this, 'vite_load_js'], ['is_safe' => ['html']]),
        ];
    }

    public function vite_load_css($value)
    {
        return <<<HTML
           <link rel="stylesheet" href="$value">
        HTML;
    }
    public function vite_load_js($value)
    {
        return <<<HTML
            
            <script src="$value"></script>
        HTML;
    }

   
}
