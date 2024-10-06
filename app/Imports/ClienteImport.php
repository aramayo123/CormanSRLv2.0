<?php

namespace App\Imports;

use App\Models\Cliente;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;

class ClienteImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $validator = Validator::make(array('cliente' =>$row['cliente']), [
            'cliente' => 'required|string|unique:clientes',
        ]);
        if(!$validator->fails()){
            return new Cliente([
                'cliente' => $row['cliente'],
            ]);
        }
    }
}
