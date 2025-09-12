<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestTransactions extends TableWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Transaction::query())
            ->columns([
                //
                TextColumn::make('booking_trx_id')->label('Kode'),
                TextColumn::make('student.name')->label('Student'),
                TextColumn::make('pricing.name')->label('Paket'),
                TextColumn::make('grand_total_amount')->label('IDR'),
                TextColumn::make('is_paid')->label('Bayar'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                //
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }
}
