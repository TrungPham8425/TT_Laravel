<?php
// Class này cài đặt TranslatorInterface cho tiếng Anh
namespace App\Services\Translator;

use App\Contracts\TranslatorInterface;

class EnglishTranslator implements TranslatorInterface
{
    public function greeting(): string
    {
        return 'Hello, admin';
    }
}
