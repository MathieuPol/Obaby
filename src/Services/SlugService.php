<?php
namespace App\Services;

use Symfony\Component\String\Slugger\SluggerInterface;


class SlugService
{
    private $slugger;

    /**
     * Constructor
     *
     */
    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function slug(string $string): string
    {
        return $this->slugger->slug($string)->lower();
    }


}