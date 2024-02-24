<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    const TABLE = 'users';

    public static string $id = 'id';
    public static string $name = 'name';
    public static string $username = 'username';
    public static string $cpf = 'cpf';
    public static string $email = 'email';
    public static string $birth = 'birth';
    public static string $emailVerifiedAt = 'email_verified_at';
    public static string $active = 'active';
    public static string $password = 'password';
    public static string $idRole = 'role_id';
    public static string $idGender = 'gender_id';
    public static string $asTableRoles = 'roles';
    public static string $asTableGenders = 'genders';
    public static string $onColumnRoles = 'id';
    public static string $onColumnGenders = 'id';

    public function up(): void
    {
        Schema::create(self::TABLE, function (Blueprint $table) {
            $table->id();
            $table->string(static::$name);
            $table->string(static::$username)->unique();
            $table->string(static::$cpf)->unique();
            $table->unsignedBigInteger(static::$idRole);
            $table->foreign(static::$idRole)->references(static::$onColumnRoles)->on(static::$asTableRoles);
            $table->unsignedBigInteger(static::$idGender);
            $table->foreign(static::$idGender)->references(static::$onColumnGenders)->on(static::$asTableGenders);
            $table->string(static::$email)->unique();
            $table->date(static::$birth)->nullable();
            $table->timestamp(static::$emailVerifiedAt)->nullable();
            $table->string(static::$password);
            $table->integer(static::$active);
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(self::TABLE);
    }
};
