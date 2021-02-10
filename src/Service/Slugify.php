<?php

namespace App\Service;

class Slugify
{
    public function generate(string $slug) : string
    {
        //transliterate
        $slug = iconv('utf-8', 'us-ascii//TRANSLIT', $slug);

        //remplace tous ce qui n'est pas lettre par des -
        $slug = preg_replace('~[^\pL\d]+~u', '-', $slug);

        //supprimer les caractères non voulus
        $slug = preg_replace('~[^-\w]+~', '', $slug);

        //trim
        $slug = trim($slug, '-');

        //passe le tout en minuscule
        $slug = strtolower($slug);

        return $slug;
    }
}