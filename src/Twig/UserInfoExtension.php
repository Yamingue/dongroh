<?php

namespace App\Twig;

use App\Entity\User;
use App\Repository\CommandeRepository;
use Twig\TwigFilter;
use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;

class UserInfoExtension extends AbstractExtension
{
    private $commandeRepo;
    public function __construct(CommandeRepository $commandeRepo)
    {
        $this->commandeRepo = $commandeRepo;
    }
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            new TwigFilter('countPanier', [$this, 'countPanier']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('countPanier', [$this, 'countPanier']),
        ];
    }

    public function countPanier(User $user)
    {
        $commande = $this->commandeRepo->findNotOut($user);
        if (!$commande) {
            return 0;
        }
        return count($commande->getArticles());
    }
}
