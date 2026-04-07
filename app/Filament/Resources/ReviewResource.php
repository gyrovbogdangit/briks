<?php

namespace App\Filament\Resources;

use App\Models\Review;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Filament\Resources\ReviewResource\Pages;

class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;

    protected static ?string $navigationIcon = 'heroicon-s-star';

    protected static ?string $navigationLabel = 'Отзывы';

    protected static ?string $navigationGroup = 'Сайт';

    public static function getModelLabel(): string
    {
        return 'Отзыв';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Отзывы';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('product_id')
                ->label('Товар')
                ->relationship('product', 'name')
                ->searchable()
                ->required(),
            Forms\Components\TextInput::make('name')
                ->label('Имя')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('email')
                ->label('Email')
                ->email()
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('phone')
                ->label('Телефон')
                ->required()
                ->maxLength(50),
            Forms\Components\Select::make('rating')
                ->label('Оценка')
                ->options([1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5'])
                ->required(),
            Forms\Components\Textarea::make('body')
                ->label('Отзыв')
                ->required()
                ->columnSpanFull(),
            Forms\Components\Toggle::make('is_published')
                ->label('Опубликован')
                ->default(false),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('product.name')
                    ->label('Товар')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Имя')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Телефон'),
                Tables\Columns\TextColumn::make('rating')
                    ->label('Оценка')
                    ->sortable(),
                Tables\Columns\TextColumn::make('body')
                    ->label('Отзыв')
                    ->limit(60),
                Tables\Columns\IconColumn::make('is_published')
                    ->label('Опубликован')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('Опубликован'),
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
            'index'  => Pages\ListReviews::route('/'),
            'create' => Pages\CreateReview::route('/create'),
            'edit'   => Pages\EditReview::route('/{record}/edit'),
        ];
    }
}
