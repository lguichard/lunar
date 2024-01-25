<?php

namespace Lunar\Admin\Plugins;

use Filament\Resources\Pages\Concerns\HasTranslatableFormWithExistingRecordData;
use Filament\Resources\Pages\Concerns\HasTranslatableRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;

trait EditRecordTranslatable
{
    use HasActiveLocaleSwitcher;
    //use HasTranslatableFormWithExistingRecordData;
    //use HasTranslatableRecord;

    public function getRecord(): Model
    {
        if (blank($this->activeLocale)) {
            return $this->record;
        }

        return $this->record->setLocale($this->activeLocale);
    }

    protected function fillForm(): void
    {
        dd("ic");
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        dd("ic");
    }

    public function setActiveLocale(string $locale): void
    {
        dd("la");
    }
}