<?php

namespace App\Services;

class ProfanityFilter
{
    /**
     * Common Spanish profanity / obscene words list.
     */
    protected static array $badWords = [
        'mierda', 'puta', 'puto', 'cabron', 'cabrón', 'joder', 'coño', 'polla', 
        'maricon', 'maricón', 'gilipollas', 'hijo de puta', 'hijoputa', 'mamon', 
        'mamón', 'pendejo', 'pendeja', 'culiao', 'culia', 'cagar', 'cago', 
        'zorra', 'zorrón', 'follar', 'follon', 'follón', 'chingar', 'chingo'
    ];

    /**
     * Check if a given text contains any bad words.
     */
    public static function hasProfanity(string $text): bool
    {
        // Normalize text (lowercase, remove accents to make filter robust)
        $normalized = self::normalize($text);

        foreach (self::$badWords as $word) {
            $normalizedWord = self::normalize($word);
            if (str_contains($normalized, $normalizedWord)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Normalize text for comparison (lowercase and replace accented vowels).
     */
    protected static function normalize(string $text): string
    {
        $text = mb_strtolower($text, 'UTF-8');
        
        $replacements = [
            'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u', 'ü' => 'u',
            'à' => 'a', 'è' => 'e', 'ì' => 'i', 'ò' => 'o', 'ù' => 'u',
        ];

        return strtr($text, $replacements);
    }
}
