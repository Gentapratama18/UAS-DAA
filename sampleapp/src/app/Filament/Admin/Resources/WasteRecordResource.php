<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Center;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\WasteRecord;
use App\Models\WasteCategory;
use Filament\Resources\Resource;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Admin\Resources\WasteRecordResource\Pages;

class WasteRecordResource extends Resource
{
    protected static ?string $model = WasteRecord::class;

    protected static ?string $navigationIcon = 'heroicon-o-video-camera';

    protected static ?string $navigationGroup = 'Waste Record';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // User select field
                Forms\Components\Select::make('user_id')
                    ->label('User')
                    ->options(User::all()->pluck('name', 'id'))
                    ->required(),
    
                // Waste Category select field
                Forms\Components\Select::make('waste_category_id')
                    ->label('Waste Category')
                    ->options(WasteCategory::all()->pluck('category_name', 'id'))
                    ->required(),
    
                // Recycling Center select field
                Forms\Components\Select::make('center_id')
                    ->label('Recycling Center')
                    ->options(Center::all()->pluck('name', 'id'))
                    ->required(),
    
                // Weight input field (changed to string)
                Forms\Components\TextInput::make('weight')
                    ->label('Weight')
                    ->required()
                    ->maxLength(255),  // Assuming it's a string, limit length to prevent very long entries
    
                // Date picker field
                Forms\Components\DatePicker::make('date')
                    ->label('Date')
                    ->required(),
    
                // Description text area field
                Forms\Components\Textarea::make('description')
                    ->label('Description')
                    ->columnSpanFull(),
            ]);
    }
    
    public static function table(Table $table): Table
{
    return $table
        ->query(WasteRecord::with(['wasteCategory'])) // Eager load wasteCategory
        ->columns([
            Tables\Columns\TextColumn::make('user.name')
                ->label('User')
                ->sortable(),

            Tables\Columns\TextColumn::make('wastecategory.category_name') // Make sure category_name is correct
                ->label('Waste Category')
                ->sortable(),

            Tables\Columns\TextColumn::make('center.name')
                ->label('Recycling Center')
                ->sortable(),

            Tables\Columns\TextColumn::make('weight')
                ->sortable(),

            Tables\Columns\TextColumn::make('date')
                ->date()
                ->sortable(),

            Tables\Columns\TextColumn::make('description')
                ->label('description')
                ->sortable(),

            Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),

            Tables\Columns\TextColumn::make('updated_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ])
        ->filters([/* Filter can be added later */])
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
            'index' => Pages\ListWasteRecords::route('/'),
            'create' => Pages\CreateWasteRecord::route('/create'),
            'edit' => Pages\EditWasteRecord::route('/{record}/edit'),
        ];
    }
}
