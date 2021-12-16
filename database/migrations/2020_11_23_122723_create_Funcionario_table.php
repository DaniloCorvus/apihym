<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateFuncionarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Funcionario', function (Blueprint $table) {
            $table->integer('Identificacion_Funcionario')->primary();
            $table->enum('Suspendido', ['NO', 'SI'])->default('NO');
            $table->enum('Liquidado', ['NO', 'SI'])->default('NO');
            $table->string('Nombres', 45)->nullable();
            $table->string('Apellidos', 45)->nullable();
            $table->integer('Id_Grupo');
            $table->integer('Id_Dependencia')->default(1);
            $table->integer('Id_Cargo')->default(1);
            $table->integer('Id_Perfil');
            $table->date('Fecha_Nacimiento')->nullable();
            $table->string('Lugar_Nacimiento', 500)->nullable()->index('id_Municipio');
            $table->string('Tipo_Sangre', 3)->nullable();
            $table->string('Telefono', 15)->nullable();
            $table->string('Celular', 15)->nullable();
            $table->string('Correo', 45)->nullable();
            $table->string('Direccion_Residencia', 200)->nullable();
            $table->string('Estado_Civil', 15)->nullable();
            $table->string('Grado_Instruccion', 200)->nullable();
            $table->string('Titulo_Estudio', 200)->nullable();
            $table->string('Talla_Pantalon', 3)->nullable();
            $table->string('Talla_Bata', 3)->nullable();
            $table->string('Talla_Botas', 3)->nullable();
            $table->string('Talla_Camisa', 4)->nullable();
            $table->string('Username', 45)->nullable();
            $table->string('Password', 45)->nullable();
            $table->string('Imagen', 45)->nullable();
            $table->string('Autorizado', 2)->default('Si');
            $table->integer('Salario')->nullable();
            $table->string('Bonos', 45)->nullable();
            $table->string('Fecha_Ingreso', 10)->nullable();
            $table->integer('Hijos')->default(0);
            $table->timestamp('Ultima_Sesion')->nullable();
            $table->timestamp('Fecha_Registrado')->useCurrent();
            $table->string('personId', 100)->nullable();
            $table->string('persistedFaceId', 200)->default('');
            $table->enum('Tipo_Turno', ['Rotativo', 'Fijo', 'Mixto', 'Libre'])->default('Fijo');
            $table->integer('Id_Turno')->default(0);
            $table->integer('Id_Proceso')->default(0);
            $table->integer('Lider_Grupo')->default(0);
            $table->date('Fecha_Retiro')->nullable()->default('2100-12-31');
            $table->string('Sexo', 50)->nullable();
            $table->integer('Jefe')->nullable()->default(0);
            $table->enum('Salarios', ['Si', 'No'])->default('No');
            $table->enum('Reporte_HE', ['Si', 'No'])->default('No');
            $table->enum('Validacion_HE', ['Si', 'No'])->default('No');
            $table->enum('Reporte_Horario', ['Si', 'No'])->default('No');
            $table->enum('Asignacion_Horario', ['Si', 'No'])->default('No');
            $table->enum('Funcionarios', ['Si', 'No'])->default('No');
            $table->enum('Indicadores', ['Si', 'No'])->default('No');
            $table->enum('Configuracion', ['Si', 'No'])->default('No');
            $table->enum('Llegada_Tarde', ['Si', 'No'])->default('No');
            $table->enum('Novedades', ['Si', 'No'])->default('No');
            $table->enum('Permiso_App', ['Si', 'No'])->default('Si');
            $table->string('Contrato', 200)->default('');
            $table->string('Afiliaciones', 200)->default('');
            $table->string('Gcm_Id', 200)->default('');
            $table->enum('Estado', ['Activo', 'Inactivo'])->default('Activo');
            $table->integer('Saldo_Inicial_Peso')->default(0);
            $table->double('Saldo_Inicial_Bolivar')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Funcionario');
    }
}
