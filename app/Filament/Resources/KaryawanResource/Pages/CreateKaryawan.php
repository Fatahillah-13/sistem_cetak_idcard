<?php

namespace App\Filament\Resources\KaryawanResource\Pages;

use App\Filament\Resources\KaryawanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Forms\Components\WebcamCapture;

class CreateKaryawan extends CreateRecord
{
    protected static string $resource = KaryawanResource::class;
    protected function getFormSchema(): array
    {
        return [
            // Tambahkan field lain yang diperlukan
            WebcamCapture::make('foto_karyawan')
                ->label('Foto Karyawan')
                ->required(),
        ];
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Proses data sebelum disimpan ke database
        $image = $data['foto_karyawan'];
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = time() . '.png';
        \Storage::disk('public')->put($imageName, base64_decode($image));

        $data['foto_karyawan'] = $imageName;

        return $data;
    }
}
