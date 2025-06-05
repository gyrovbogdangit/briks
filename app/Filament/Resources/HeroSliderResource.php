<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\HeroSlider;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\HeroSliderResource\Pages;
use App\Filament\Resources\HeroSliderResource\RelationManagers;

class HeroSliderResource extends Resource
{
    protected static ?string $model = HeroSlider::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?string $navigationLabel = 'Главная страница';

    protected static ?string $navigationGroup = 'Сайт';

    public static function getModelLabel(): string
    {
        return 'Слайд';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Слайды';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('url')
                    ->maxLength(255)
                    ->columnSpanFull()
                    ->label('URL'),
                Forms\Components\FileUpload::make('image')
                    ->required()
                    ->image()
                    ->directory('hero-sliders')
                    ->columnSpanFull()
                    ->label('Слайд'),
                Forms\Components\TextInput::make('sort_index')
                    ->integer()
                    ->label('Порядковый номер')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('url')
                    ->label('URL')
                    ->url(fn($record) => $record->url ? $record->url : null),
                Tables\Columns\ImageColumn::make('image')
                    ->label('Слайд'),
                Tables\Columns\TextColumn::make('sort_index')
                    ->label('Порядковый номер')
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageHeroSliders::route('/'),
        ];
    }
}
