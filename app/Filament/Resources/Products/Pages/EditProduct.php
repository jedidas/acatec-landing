<?php

namespace App\Filament\Resources\Products\Pages;

use Illuminate\Support\Facades\Storage;
use App\Filament\Resources\Products\ProductResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

use App\Models\Image;
use App\Models\Product;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()->after(function (Product $record) {
                // delete single
                if ($record->image) {
                    Storage::disk('public')->delete($record->image);
                }
                $images = Image::where('product_id', $record->id)->get();
                // delete images
                if ($images) {
                    foreach ($images as $image) {
                        Storage::disk('public')->delete($image->image);
                        $image->delete();
                    }
                }
            }),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['updated_on'] = now();
        return $data;
    }
}
