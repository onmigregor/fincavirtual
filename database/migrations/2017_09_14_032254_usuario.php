<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Usuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('usuario', function (Blueprint $table) {
            
            $table->increments('id');
            $table->string('nombre');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('rol');
            //$table->rememberToken();
            $table->timestamps();
        });
        DB::table('usuario')->insert(
         array(
            'nombre'   => 'unidad',
            'email'    => 'unidad@gmail.com',
            'password' => Hash::make('123456'),
            'rol'    => 'RL01',
         )
     );
        DB::table('usuario')->insert(
         array(
            'nombre'   => 'produccion',
            'email'    => 'produccion@gmail.com',
            'password' => Hash::make('123456'),
            'rol'    => 'RL02',
         )
     );
        DB::table('usuario')->insert(
         array(
            'nombre'   => 'compras',
            'email'    => 'compras@gmail.com',
            'password' => Hash::make('123456'),
            'rol'    => 'RL03',
         )
     );
 
    }

    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('usuario');
    }
}
