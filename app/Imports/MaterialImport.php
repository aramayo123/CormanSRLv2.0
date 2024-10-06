<?php

namespace App\Imports;

use App\Models\Material;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;

class MaterialImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $validator = Validator::make(array(
            'rubro_id' =>$row['rubro'],
            'descripcion' =>$row['descripcion'],
            'unidad' =>$row['unidad'],
        ), 
        [
            'rubro_id' => 'required',
            'descripcion' => 'required|string|unique:materiales',
            'unidad' => 'required|string',
        ]);
        if(!$validator->fails()){
            return new Material([
                'rubro_id' =>$row['rubro'],
                'descripcion' =>$row['descripcion'],
                'unidad' =>$row['unidad'],
            ]);
        }
    }
}
