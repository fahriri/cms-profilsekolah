<?php

namespace App\Filament\Resources\SchoolProfilesResource\Pages;

use App\Filament\Resources\SchoolProfilesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Filament\Notifications\Notification;


class EditSchoolProfiles extends EditRecord
{
    protected static string $resource = SchoolProfilesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        try {
            $record->update($data);

            Notification::make()
            ->success()
            ->send();
        } catch (\Throwable $e) {
            dd([
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
        }

        return $record;
    }
}