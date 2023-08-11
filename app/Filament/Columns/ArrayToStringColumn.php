<?php
namespace App\Filament\Columns;

use Filament\Tables\Columns\Column;

class ArrayToStringColumn extends Column
{
    public function format($value)
    {
        return implode(', ', $value);
    }
}
