<?php

namespace App\Filament\Clusters\DossierCluster\Resources\DossierResource\Pages;

use App\Filament\Clusters\DossierCluster\Resources\DossierResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDossier extends EditRecord
{
    protected static string $resource = DossierResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
