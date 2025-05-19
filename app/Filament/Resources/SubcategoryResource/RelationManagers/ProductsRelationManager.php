<?php

namespace App\Filament\Resources\SubcategoryResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use App\Models\Value;
use Filament\Forms\Form;
use App\Models\Attribute;
use Filament\Tables\Table;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use FilamentTiptapEditor\TiptapEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\RelationManagers\RelationManager;

class ProductsRelationManager extends RelationManager
{
    protected static string $relationship = 'products';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Tabs')
                    ->columnSpanFull()
                    ->tabs([
                        Tab::make('Информация')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Название')
                                    ->required()
                                    ->maxLength(255)
                                    ->columnSpanFull(),
                                TiptapEditor::make('description')
                                    ->label('Описание')
                                    ->required()
                                    ->columnSpanFull()
                                    ->profile('default'),
                                \Filament\Forms\Components\Hidden::make('subcategory_id')
                                    ->default(fn($livewire) => $livewire->getOwnerRecord()->id)
                                    ->dehydrated(true)
                                    ->required(),
                            ]),
                        Tab::make('Цена')
                            ->schema([
                                TextInput::make('price_per_piece')
                                    ->label('Цена за штуку')
                                    ->numeric(),
                                TextInput::make('discount_price_per_piece')
                                    ->label('Скидочная цена за штуку')
                                    ->numeric(),
                                TextInput::make('price_sqm')
                                    ->label('Цена за квадратный метр')
                                    ->numeric(),
                                TextInput::make('discount_price_sqm')
                                    ->label('Скидочная цена за квадратный метр')
                                    ->numeric(),
                            ]),
                        Tab::make('Файлы')
                            ->schema([
                                FileUpload::make('images')
                                    ->label('Изображения')
                                    ->multiple()
                                    ->image()
                                    ->imageCropAspectRatio('1:1')
                                    ->reorderable()
                                    ->directory('products')
                                    ->columnSpanFull(),
                                FileUpload::make('docs')
                                    ->label('Документы')
                                    ->multiple()
                                    ->reorderable()
                                    ->directory('products')
                                    ->storeFileNamesIn('docs_file_names')
                                    ->columnSpanFull(),
                            ]),
                        Tab::make('Статус')
                            ->schema([
                                Toggle::make('is_new')
                                    ->label('Новинка'),
                                Toggle::make('is_hit_of_sales')
                                    ->label('Хит продаж'),
                                Toggle::make('is_active')
                                    ->label('Активен'),
                            ]),
                        Tab::make('Характеристики')
                            ->schema([
                                Repeater::make('attributeValues')
                                    ->label('Характеристики')
                                    ->relationship('attributeValues')
                                    ->schema([
                                        Select::make('attribute_id')
                                            ->label('Атрибут')
                                            ->options(function ($get, $record, $livewire) {
                                                $subcategory = $record?->subcategory_id
                                                    ? \App\Models\Subcategory::find($record->subcategory_id)
                                                    : ($livewire->getOwnerRecord() ?? null);
                                                $categoryId = $subcategory?->category_id;
                                                if ($categoryId) {
                                                    return Attribute::where('category_id', $categoryId)
                                                        ->orderBy('name')
                                                        ->pluck('name', 'id');
                                                }
                                                return [];
                                            })
                                            ->reactive()
                                            ->required(),
                                        Select::make('value_id')
                                            ->label('Значение')
                                            ->options(function ($get) {
                                                $attributeId = $get('attribute_id');
                                                if ($attributeId) {
                                                    return Value::where('attribute_id', $attributeId)
                                                        ->orderBy('value')
                                                        ->pluck('value', 'id');
                                                }
                                                return [];
                                            })
                                            ->reactive()
                                            ->required()
                                    ])
                                    ->columns(2),
                            ]),
                    ])->persistTabInQueryString()
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                ImageColumn::make('images')
                    ->label('Изображение')
                    ->limit(2),
                Tables\Columns\TextColumn::make('name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
