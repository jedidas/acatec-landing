<?php

namespace App\Filament\Resources\Banners\Pages;

use App\Models\Banner;

use Illuminate\Support\Facades\Storage;
use App\Filament\Resources\Banners\BannerResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBanner extends EditRecord
{
    protected static string $resource = BannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()->after(function (Banner $record) {
                // delete single
                if ($record->image) {
                    Storage::disk('public')->delete($record->image);
                }
            })
        ];
    }
}
