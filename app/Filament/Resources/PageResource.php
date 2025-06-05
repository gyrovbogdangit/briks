<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Page;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PageResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PageResource\RelationManagers;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-s-pencil-square';

    protected static ?string $navigationLabel = 'Страницы';

    protected static ?string $navigationGroup = 'Сайт';

    public static function getModelLabel(): string
    {
        return 'Страницы';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Страницы';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Название страницы')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('sort_index')
                    ->label('Порядковый номер')
                    ->integer(),
                Forms\Components\TextInput::make('description')
                    ->label('Описание')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('og_title')
                    ->label('Open Graph Title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('og_description')
                    ->label('Open Graph Description')
                    ->required()
                    ->maxLength(255),
                RichEditor::make('html')
                    ->columnSpanFull()
                    ->toolbarButtons([
                        'attachFiles',
                        'blockquote',
                        'bold',
                        'bulletList',
                        'codeBlock',
                        'h1',
                        'h2',
                        'h3',
                        'italic',
                        'link',
                        'orderedList',
                        'redo',
                        'strike',
                        'underline',
                        'undo',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Название страницы')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
