<?php

namespace App\Filament\Resources;

use App\Enums\PaymentStatus;
use App\Enums\TaskStatus;
use App\Enums\TaskType;
use App\Filament\Resources\TaskResource\Pages;
use App\Filament\Resources\TaskResource\RelationManagers;
use App\Models\Task;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\FormsComponent;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
               Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Pekerjaan')
                            ->placeholder('Nama Pekerjaan')
                            ->required(),
                        Forms\Components\Select::make('type')
                            ->label('Tipe')
                            ->options([
                                TaskType::VisitStore->value => TaskType::VisitStore->value,
                                TaskType::ProductReview->value => TaskType::ProductReview->value,
                            ])
                            ->required(),
                        Forms\Components\DateTimePicker::make('visit_at')
                            ->label('Tanggal Kunjungan / Kerja')
                            ->required(),
                        Forms\Components\DateTimePicker::make('post_at')
                            ->label('Tanggal Posting')
                            ->required(),
                        Forms\Components\RichEditor::make('description')
                            ->label('Deskripsi / Brief')
                            ->required(),
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                TaskStatus::Todo->value => TaskStatus::Todo->value,
                                TaskStatus::OnProgress->value => TaskStatus::OnProgress->value,
                                TaskStatus::Done->value => TaskStatus::Done->value,
                            ])
                            ->required(),
                        Forms\Components\Select::make('payment_status')
                            ->label('Status Pembayaran')
                            ->options([
                                PaymentStatus::Unpaid->value => PaymentStatus::Unpaid->value,
                                PaymentStatus::Paid->value => PaymentStatus::Paid->value,

                            ])
                            ->required(),
                        Forms\Components\TextInput::make('instagram_link')
                            ->placeholder('https://instagram.com/abc'),
                        Forms\Components\TextInput::make('tiktok_link')
                            ->placeholder('https://tiktok.com/abc'),

                         
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTask::route('/create'),
            'edit' => Pages\EditTask::route('/{record}/edit'),
        ];
    }    
}
