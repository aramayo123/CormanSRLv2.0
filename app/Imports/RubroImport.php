<?php

namespace App\Imports;

use App\Models\Rubro;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;

class RubroImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $validator = Validator::make(array('rubro' =>$row['rubro']), [
            'rubro' => 'required|string|unique:rubros',
        ]);
        if(!$validator->fails()){
            return new rubro([
                'rubro' => $row['rubro'],
            ]);
        }
    }
}
