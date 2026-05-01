<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AchievementResource\Pages;
use App\Models\Achievement;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AchievementResource extends Resource
{
    protected static ?string $model = Achievement::class;

    protected static ?string $navigationIcon = 'heroicon-o-trophy';

    protected static ?string $navigationLabel = 'Prestasi Siswa';

    protected static ?string $pluralModelLabel = 'Prestasi';

    protected static ?string $modelLabel = 'Prestasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Prestasi')
                    ->schema([
                        Forms\Components\Select::make('student_id')
                            ->label('Siswa')
                            ->relationship('student', 'name')
                            ->options(Student::query()->pluck('name', 'id'))
                            ->searchable()
                            ->required(),

                        Forms\Components\TextInput::make('title')
                            ->label('Nama Prestasi / Event')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi')
                            ->rows(3)
                            ->columnSpanFull(),

                        Forms\Components\Select::make('level')
                            ->label('Tingkat')
                            ->options([
                                'Kecamatan' => 'Kecamatan',
                                'Kabupaten/Kota' => 'Kabupaten/Kota',
                                'Provinsi' => 'Provinsi',
                                'Nasional' => 'Nasional',
                                'Internasional' => 'Internasional',
                            ])
                            ->required(),

                        Forms\Components\Select::make('category')
                            ->label('Bidang')
                            ->options([
                                'Akademik' => 'Akademik',
                                'Olahraga' => 'Olahraga',
                                'Seni' => 'Seni',
                                'Agama' => 'Agama',
                                'Teknologi' => 'Teknologi',
                                'Lainnya' => 'Lainnya',
                            ])
                            ->required(),

                        Forms\Components\DatePicker::make('date')
                            ->label('Tanggal')
                            ->required(),

                        Forms\Components\FileUpload::make('certificate_path')
                            ->label('Sertifikat')
                            ->image()
                            ->disk('public')
                            ->directory('achievements')
                            ->maxSize(5120),

                        Forms\Components\FileUpload::make('photo_path')
                            ->label('Foto')
                            ->image()
                            ->disk('public')
                            ->directory('achievements')
                            ->maxSize(5120),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.name')
                    ->label('Siswa')
                    ->searchable(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Prestasi')
                    ->searchable()
                    ->limit(40),

                Tables\Columns\TextColumn::make('level')
                    ->label('Tingkat')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Kecamatan' => 'gray',
                        'Kabupaten/Kota' => 'info',
                        'Provinsi' => 'primary',
                        'Nasional' => 'success',
                        'Internasional' => 'warning',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('category')
                    ->label('Bidang'),

                Tables\Columns\TextColumn::make('date')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('level')
                    ->options([
                        'Kecamatan' => 'Kecamatan',
                        'Kabupaten/Kota' => 'Kabupaten/Kota',
                        'Provinsi' => 'Provinsi',
                        'Nasional' => 'Nasional',
                        'Internasional' => 'Internasional',
                    ]),
                Tables\Filters\SelectFilter::make('category')
                    ->options([
                        'Akademik' => 'Akademik',
                        'Olahraga' => 'Olahraga',
                        'Seni' => 'Seni',
                        'Agama' => 'Agama',
                        'Teknologi' => 'Teknologi',
                        'Lainnya' => 'Lainnya',
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
            ->defaultSort('date', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAchievements::route('/'),
            'create' => Pages\CreateAchievement::route('/create'),
            'edit' => Pages\EditAchievement::route('/{record}/edit'),
        ];
    }
}
