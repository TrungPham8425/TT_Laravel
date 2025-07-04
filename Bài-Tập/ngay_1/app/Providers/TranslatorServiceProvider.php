<?php
// Service Provider này đăng ký TranslatorInterface tương ứng với APP_LOCALE
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\TranslatorInterface;
use App\Services\Translator\VietnameseTranslator;
use App\Services\Translator\EnglishTranslator;

class TranslatorServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Binding TranslatorInterface theo cấu hình APP_LOCALE
        $this->app->bind(TranslatorInterface::class, function ($app) {
            $locale = config('app.locale');
            if ($locale === 'vi') {
                return new VietnameseTranslator();
            }
            return new EnglishTranslator();
        });
    }
}
