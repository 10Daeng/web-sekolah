<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentResource\Pages;
use App\Models\Classroom;
use App\Models\Document;
use App\Models\Subject;
use App\Models\Teacher;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DocumentResource extends Resource
{
    protected static ?string $model = Document::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder';

    protected static ?string $navigationLabel = 'Materi & Tugas';

    protected static ?string $pluralModelLabel = 'Dokumen';

    protected static ?string $modelLabel = 'Dokumen';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Dokumen')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Judul')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi')
                            ->rows(3)
                            ->columnSpanFull(),

                        Forms\Components\Select::make('type')
                            ->label('Tipe')
                            ->options([
                                'materi' => 'Materi Pembelajaran',
                                'tugas' => 'Tugas',
                                'soal' => 'Bank Soal',
                                'lainnya' => 'Lainnya',
                            ])
                            ->required(),

                        Forms\Components\Select::make('class_id')
                            ->label('Kelas')
                            ->relationship('class', 'name')
                            ->options(Classroom::query()->pluck('name', 'id')),

                        Forms\Components\Select::make('subject_id')
                            ->label('Mata Pelajaran')
                            ->relationship('subject', 'name')
                            ->options(Subject::query()->pluck('name', 'id')),

                        Forms\Components\Select::make('teacher_id')
                            ->label('Guru')
                            ->relationship('teacher', 'name')
                            ->options(Teacher::query()->pluck('name', 'id')),

                        Forms\Components\FileUpload::make('file_path')
                            ->label('File')
                            ->disk('public')
                            ->directory('documents')
                            ->multiple()
                            ->maxSize(5120)
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('video_url')
                            ->label('Link Video')
                            ->url()
                            ->placeholder('https://...'),

                        Forms\Components\DatePicker::make('deadline')
                            ->label('Deadline (untuk tugas)'),

                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'draft' => 'Draft',
                                'published' => 'Dipublikasikan',
                            ])
                            ->default('published')
                            ->required(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->limit(50),

                Tables\Columns\TextColumn::make('type')
                    ->label('Tipe')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'materi' => 'info',
                        'tugas' => 'warning',
                        'soal' => 'success',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('class.name')
                    ->label('Kelas'),

                Tables\Columns\TextColumn::make('subject.name')
                    ->label('Mapel'),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'published' => 'success',
                        'draft' => 'gray',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'materi' => 'Materi Pembelajaran',
                        'tugas' => 'Tugas',
                        'soal' => 'Bank Soal',
                        'lainnya' => 'Lainnya',
                    ]),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Dipublikasikan',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDocuments::route('/'),
            'create' => Pages\CreateDocument::route('/create'),
            'edit' => Pages\EditDocument::route('/{record}/edit'),
        ];
    }
}
