<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Customer;
use App\Models\Seller;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Illuminate\Http\UploadedFile;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CustomerResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Filament\Resources\CustomerResource\RelationManagers;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('name')
            ->label('Nome')
            ->required(),

        TextInput::make('email')
            ->label('Email')
            ->required(),

            FileUpload::make('image_path')
            ->label('Imagem')
            ->image()
            ->required(),

        TextInput::make('telefone')
            ->label('Telefone')
            ->required(),

        Select::make('tipo_cliente')
            ->label('Tipo de cliente')
            ->options([
                'PF' => 'Pessoa Física',
                'PJ' => 'Pessoa Jurídica',
            ])
            ->required(),

            Select::make('vendedores')
            ->multiple()
            ->relationship('sellers', 'name')

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('email'),
                TextColumn::make('telefone'),
                TextColumn::make('tipo_cliente'),
                TextColumn::make('formatted_vendedores')
                ->label('Vendedores'),
                ImageColumn::make('image_path')
                    ->label('Imagem')
                    ->circular()
                    ->height(80)

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }

    public function destroy(Customer $customer)
    {

        $customer->sellers()->detach();


        $customer->delete();

        return redirect()->route('filament.resource.table', 'customers')->with('success', 'Cliente excluído com sucesso.');
    }
}
