<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_de_tarea');
            $table->string('ticket')->unique();
			$table->unsignedBigInteger('cliente_id')->nullable();
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('set null');
			$table->unsignedBigInteger('sucursal_id')->nullable();
            $table->foreign('sucursal_id')->references('id')->on('sucursales')->onDelete('set null');
            $table->text('descripcion')->nullable();
            $table->text('elementos')->nullable();
            $table->text('diagnostico')->nullable();
            $table->text('acciones')->nullable();
            $table->text('observaciones')->nullable();
            $table->integer('certificado')->nullable();
            $table->integer('atm')->nullable();
            $table->unsignedBigInteger('estado_id')->nullable();
            $table->foreign('estado_id')->references('id')->on('estados')->onDelete('set null');
            $table->unsignedBigInteger('prioridad_id')->nullable();
            $table->foreign('prioridad_id')->references('id')->on('prioridades')->onDelete('set null');
			$table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->date('fecha_mail')->nullable();
            $table->date('fecha_cerrado')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tareas');
    }
};
