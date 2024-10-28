<?php

namespace App\Services\Link\Client;

use App\Services\Link\Contracts\ContentKeywordsInterface;
use Illuminate\Support\Facades\File;

class ContentKeywords implements ContentKeywordsInterface
{
    private $stopwords;

    public function __construct()
    {
        // récupérer fichier stopWords.json dans resources/file
        $stopwordsFile = resource_path('file/stopWords.json');
        $this->stopwords = json_decode(File::get($stopwordsFile))->stopWords;
    }

    public function extractKeywords($content): array
    {
        // Étape 1 : Analyser les n-grammes
        $nGrams = $this->genereteNgrams($content);

        // Étape 2 : Trier les n-grammes par fréquence
        arsort($nGrams);

        // Étape 3 : Extraire les 5 mots-clés

        return array_slice($nGrams, 0, 5);
    }

    public function genereteNgrams($content): array
    {
        $content = strip_tags($content); // Supprimer les balises HTML
        $content = preg_replace('/[^a-zA-Z0-9 ]/', '', $content); // Supprimer les caractères spéciaux et la ponctuation
        $words = str_word_count($content, 1); // Diviser le contenu en mots
        $words = array_map('strtolower', $words); // Convertit le contenu en minuscules,
        $words = array_diff($words, $this->stopwords); // Supprimer les mots stopwords
        $wordFrequencies = array_count_values($words); // Calculer la fréquence des mots

        $n = 1;
        $ngrams = [];
        $totalWords = count($wordFrequencies);

        for ($i = 0; $i < $totalWords - $n + 1; ++$i) {
            $arrayWordsFrequencies = array_slice($wordFrequencies, $i, $n);
            $keyword = array_keys($arrayWordsFrequencies);
            $ngram = implode(' ', $keyword);
            $ngrams[] = $ngram;
        }

        return $ngrams;
    }
}
