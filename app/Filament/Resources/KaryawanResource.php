<?php

namespace App\Filament\Resources;

use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\KaryawanResource\Pages;
use App\Filament\Resources\KaryawanResource\RelationManagers;
use App\Models\Karyawan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Actions\ForceDeleteAction;
use Filament\Forms\Components\Wizard;
use Illuminate\Support\HtmlString;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KaryawanResource extends Resource
{
    protected static ?string $model = Karyawan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('nama_karyawan')
                    ->required()
                    ->label('Nama'),
                TextInput::make('departemen_karyawan')
                    ->required()
                    ->label('Departemen')
                    ->datalist([
                        'HRD',
                        'Finance',
                        'General Affair',
                        'Development',
                        'Infrastructure',
                    ]),
                TextInput::make('level_karyawan')
                    ->required()
                    ->label('Level Jabatan')
                    ->datalist([
                        'Operator',
                        'Staff',
                        'Senior Staff',
                    ]),
                TextInput::make('foto_karyawan')
                    ->label('Foto')
                    ->reactive()
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->searchable()
                    ->label('ID'),
                TextColumn::make('nama_karyawan')
                    ->searchable()
                    ->label('Nama'),
                TextColumn::make('departemen_karyawan')
                    ->searchable()
                    ->label('Departemen'),
                TextColumn::make('level_karyawan')
                    ->searchable()
                    ->label('Level'),
                TextColumn::make('foto_karyawan')
                    ->searchable()
                    ->label('Foto'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKaryawans::route('/'),
            'create' => Pages\CreateKaryawan::route('/create'),
            'edit' => Pages\EditKaryawan::route('/{record}/edit'),
        ];
    }
}
