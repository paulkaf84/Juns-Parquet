<?php

namespace App\Filament\Resources;

use App\Enums\DecisionState;
use App\Enums\JugementState;
use App\Filament\Clusters\DossierCluster;
use App\Filament\Resources\JugementResource\Pages;
use App\Filament\Resources\JugementResource\RelationManagers;
use App\Models\Jugement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JugementResource extends Resource
{
    protected static ?string $cluster = DossierCluster::class;
    protected static ?string $model = Jugement::class;

    protected static ?string $navigationIcon = 'heroicon-o-scale';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('dossier_id')
                    ->relationship('dossier', 'nom')
                    ->required(),
                Forms\Components\DateTimePicker::make('date')
                    ->required(),
                Forms\Components\TextInput::make('jugement')
                    ->required(),
                Forms\Components\Select::make('statut')
                    ->enum(JugementState::class)
                    ->options(JugementState::class)
                    ->required(),
                Forms\Components\Select::make('decision')
                    ->enum(DecisionState::class)
                    ->options(DecisionState::class)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jugement')
                    ->searchable(),
                Tables\Columns\TextColumn::make('statut')
                    ->searchable(),
                Tables\Columns\TextColumn::make('decision')
                    ->searchable(),
                Tables\Columns\TextColumn::make('dossier.nom')
                    ->numeric()
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
            'index' => Pages\ListJugements::route('/'),
            'create' => Pages\CreateJugement::route('/create'),
            'edit' => Pages\EditJugement::route('/{record}/edit'),
        ];
    }
}
