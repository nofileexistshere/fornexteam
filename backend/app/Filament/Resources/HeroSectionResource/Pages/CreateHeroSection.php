<?php

namespace App\Filament\Resources\HeroSectionResource\Pages;

use App\Filament\Resources\HeroSectionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateHeroSection extends CreateRecord
{
    protected static string $resource = HeroSectionResource::class;
    
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // If this is being set as active, deactivate all others
        if ($data['is_active'] ?? false) {
            \App\Models\HeroSection::query()->update(['is_active' => false]);
        }
        
        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
