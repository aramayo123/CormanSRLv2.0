<?php

namespace App\Imports;

use App\Models\Sucursal;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;

class SucursalImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $validator = Validator::make(array(
            'zona' => $row['zona'],
            'numero' => $row['numero'],
            'sucursal' => $row['sucursal'],
            'direccion' => $row['direccion'],
        ), [
            'zona' => 'required|string',
            'numero' => 'required',
            'sucursal' => 'required|string',
            'direccion' => 'required|string|unique:sucursales',
        ]);
        if(!$validator->fails()){
            return new Sucursal([
                'zona' => $row['zona'],
                'numero' => $row['numero'],
                'sucursal' => $row['sucursal'],
                'direccion' => $row['direccion'],
            ]);
        }
        
    }
}
