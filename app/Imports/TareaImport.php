<?php

namespace App\Imports;

use App\Models\Tarea;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;

class TareaImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $validatorCorrectivo = Validator::make(array(
            'tipo_de_tarea' => $row['tipo_de_tarea'],
            'ticket' => $row['ticket'],
            'atm' => $row['atm'],
            'cliente_id' => $row['cliente_id'],
            'sucursal_id' => $row['sucursal_id'],
            'fecha_mail' => $row['fecha_mail'],
            'fecha_cerrado' => $row['fecha_cerrado'],
            'prioridad_id' => $row['prioridad_id'],
            'estado_id' => $row['estado_id'],
            'user_id' => $row['user_id'],
        ), [
            'tipo_de_tarea' => 'required',
            'ticket' => 'required',
            'atm' => 'nullable',
            'cliente_id' => 'required',
            'sucursal_id' => 'required',
            'fecha_mail' => 'nullable',
            'fecha_cerrado' => 'nullable',
            'prioridad_id' => 'required',
            'estado_id' => 'required',
            'user_id' => 'required',
        ]);
        $validatorPreventivo = Validator::make(array(
            'tipo_de_tarea' => $row['tipo_de_tarea'],
            'ticket' => $row['ticket'],
            'atm' => $row['atm'],
            'cliente_id' => $row['cliente_id'],
            'sucursal_id' => $row['sucursal_id'],
            'fecha_mail' => $row['fecha_mail'],
            'fecha_cerrado' => $row['fecha_cerrado'],
            'prioridad_id' => $row['prioridad_id'],
            'estado_id' => $row['estado_id'],
            'user_id' => $row['user_id'],
        ), [
            'tipo_de_tarea' => 'required',
            'ticket' => 'nullable',
            'atm' => 'nullable',
            'cliente_id' => 'required',
            'sucursal_id' => 'required',
            'fecha_mail' => 'required',
            'fecha_cerrado' => 'nullable',
            'prioridad_id' => 'nullable',
            'estado_id' => 'required',
            'user_id' => 'required',
        ]);
        if($row['tipo_de_tarea'] == "CORRECTIVO"){
            if(!$validatorCorrectivo->fails()){
                return new Tarea([
                    'tipo_de_tarea' => $row['tipo_de_tarea'],
                    'ticket' => $row['ticket'],
                    'atm' => $row['atm'],
                    'cliente_id' => $row['cliente_id'],
                    'sucursal_id' => $row['sucursal_id'],
                    'fecha_mail' => $row['fecha_mail'],
                    'fecha_cerrado' => $row['fecha_cerrado'],
                    'prioridad_id' => $row['prioridad_id'],
                    'estado_id' => $row['estado_id'],
                    'user_id' => $row['user_id'],
                    'descripcion' => $row['descripcion'],
                ]);
            }
        }else{
            if(!$validatorPreventivo->fails()){
                return new Tarea([
                    'tipo_de_tarea' => $row['tipo_de_tarea'],
                    'ticket' => $row['ticket'],
                    'atm' => $row['atm'],
                    'cliente_id' => $row['cliente_id'],
                    'sucursal_id' => $row['sucursal_id'],
                    'fecha_mail' => $row['fecha_mail'],
                    'fecha_cerrado' => $row['fecha_cerrado'],
                    'prioridad_id' => $row['prioridad_id'],
                    'estado_id' => $row['estado_id'],
                    'user_id' => $row['user_id'],
                    'descripcion' => $row['descripcion'],
                ]);
            }
        }
    }
}
