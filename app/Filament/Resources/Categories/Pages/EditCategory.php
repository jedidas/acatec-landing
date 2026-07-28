<?php

namespace App\Filament\Resources\Categories\Pages;

use App\Filament\Resources\Categories\CategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

use App\Models\Category;

class EditCategory extends EditRecord
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()->before(function (Category $record) {
                // delete single
                if ($record->image) {
                    Storage::disk('public')->delete($record->image);
                }

                if ($record->products) {
                    foreach ($record->products as $product) {
                        // delete images
                        if ($product->images) {
                            foreach ($product->images as $image) {
                                Storage::disk('public')->delete($image->image);
                                $image->delete();
                            }
                        }
                        // delete product
                        Storage::disk('public')->delete($product->image);
                        $product->delete();
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
