<?php

namespace App\Filament\Resources;

use App\Exports\RegistrationsExport;
use App\Filament\Resources\RegistrationResource\Pages;
use App\Models\Registration;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Maatwebsite\Excel\Facades\Excel;

class RegistrationResource extends Resource
{
    protected static ?string $model = Registration::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationLabel = 'PPDB - Pendaftar';

    protected static ?string $pluralModelLabel = 'Pendaftar';

    protected static ?string $modelLabel = 'Pendaftar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Calon Siswa')
                    ->schema([
                        Forms\Components\TextInput::make('registration_number')
                            ->label('No. Registrasi')
                            ->disabled()
                            ->dehydrated(false),

                        Forms\Components\TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required(),

                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->placeholder('untuk notifikasi status PPDB'),

                        Forms\Components\TextInput::make('nisn')
                            ->label('NISN')
                            ->maxLength(10),

                        Forms\Components\TextInput::make('nik')
                            ->label('NIK')
                            ->maxLength(16),

                        Forms\Components\TextInput::make('place_of_birth')
                            ->label('Tempat Lahir'),

                        Forms\Components\DatePicker::make('date_of_birth')
                            ->label('Tanggal Lahir'),

                        Forms\Components\Select::make('gender')
                            ->label('Jenis Kelamin')
                            ->options([
                                'L' => 'Laki-laki',
                                'P' => 'Perempuan',
                            ]),

                        Forms\Components\TextInput::make('religion')
                            ->label('Agama'),

                        Forms\Components\TextInput::make('child_order')
                            ->label('Anak ke-')
                            ->numeric(),

                        Forms\Components\Textarea::make('address')
                            ->label('Alamat')
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('previous_school')
                            ->label('Asal Sekolah'),

                        Forms\Components\Select::make('track')
                            ->label('Jalur')
                            ->options([
                                'Zonasi' => 'Zonasi',
                                'Prestasi' => 'Prestasi',
                                'Afirmasi' => 'Afirmasi',
                                'Mutasi' => 'Mutasi',
                            ])
                            ->required(),
                    ])->columns(2),

                Forms\Components\Section::make('Data Orang Tua')
                    ->schema([
                        Forms\Components\TextInput::make('father_name')
                            ->label('Nama Ayah'),
                        Forms\Components\TextInput::make('mother_name')
                            ->label('Nama Ibu'),
                        Forms\Components\TextInput::make('father_phone')
                            ->label('No HP Ayah'),
                        Forms\Components\TextInput::make('mother_phone')
                            ->label('No HP Ibu'),
                    ])->columns(2),

                Forms\Components\Section::make('Verifikasi')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'Pending' => 'Pending',
                                'Diverifikasi' => 'Diverifikasi',
                                'Lulus' => 'Lulus',
                                'Tidak Lulus' => 'Tidak Lulus',
                                'Cadangan' => 'Cadangan',
                            ])
                            ->required(),

                        Forms\Components\Textarea::make('notes')
                            ->label('Catatan')
                            ->columnSpanFull(),

                        Forms\Components\DateTimePicker::make('verified_at')
                            ->label('Tanggal Verifikasi'),

                        Forms\Components\Select::make('verified_by')
                            ->label('Diverifikasi Oleh')
                            ->relationship('verifier', 'name')
                            ->options(User::query()->pluck('name', 'id')),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('registration_number')
                    ->label('No. Registrasi')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),

                Tables\Columns\TextColumn::make('track')
                    ->label('Jalur')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Zonasi' => 'info',
                        'Prestasi' => 'success',
                        'Afirmasi' => 'warning',
                        'Mutasi' => 'primary',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Pending' => 'gray',
                        'Diverifikasi' => 'info',
                        'Lulus' => 'success',
                        'Tidak Lulus' => 'danger',
                        'Cadangan' => 'warning',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Daftar')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('track')
                    ->options([
                        'Zonasi' => 'Zonasi',
                        'Prestasi' => 'Prestasi',
                        'Afirmasi' => 'Afirmasi',
                        'Mutasi' => 'Mutasi',
                    ]),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'Pending' => 'Pending',
                        'Diverifikasi' => 'Diverifikasi',
                        'Lulus' => 'Lulus',
                        'Tidak Lulus' => 'Tidak Lulus',
                        'Cadangan' => 'Cadangan',
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
            ->headerActions([
                Tables\Actions\Action::make('export')
                    ->label('Export Excel')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(function () {
                        return Excel::download(new RegistrationsExport(), 'ppdb-export-' . now()->format('Ymd-His') . '.xlsx');
                    }),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRegistrations::route('/'),
            'create' => Pages\CreateRegistration::route('/create'),
            'edit' => Pages\EditRegistration::route('/{record}/edit'),
        ];
    }
}
