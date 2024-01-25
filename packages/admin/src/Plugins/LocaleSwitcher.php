<?php

namespace Lunar\Admin\Plugins;


use Filament\Actions\SelectAction;
use Lunar\Models\Language;

class LocaleSwitcher extends SelectAction
{
    public static function getDefaultName(): ?string
    {
        return 'activeLocale';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label("Select language"); // TODO : translate
        
        $this->options(function (): array {
            $livewire = $this->getLivewire();

            return Language::select('code')->get()->pluck('code')->toArray();

            if (! method_exists($livewire, 'getTranslatableLocales')) {
                return [];
            }

            $locales = [];

            /** @var SpatieLaravelTranslatablePlugin $plugin */
            $plugin = filament('spatie-laravel-translatable');

            foreach ($livewire->getTranslatableLocales() as $locale) {
                $locales[$locale] = $plugin->getLocaleLabel($locale) ?? $locale;
            }

            return $locales; // TODO
        });

        //$this->setTranslatableLocaleOptions();
    }
}