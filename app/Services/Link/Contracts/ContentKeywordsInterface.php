<?php

namespace App\Services\Link\Contracts;

interface ContentKeywordsInterface
{
    public function extractKeywords($content): array;
}
