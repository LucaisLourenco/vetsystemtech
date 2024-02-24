<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    const TABLE = 'permissions';

    public static string $id = 'id';
    public static string $idRole = 'role_id';
    public static string $idResource = 'resource_id';
    public static string $permission = 'permission';
    public static string $asTableRoles = 'roles';
    public static string $asTableResource = 'resources';
    public static string $onColumnRoles = 'id';
    public static string $onColumnResource = 'id';

    public function up(): void
    {
        Schema::create(self::TABLE, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(static::$idRole);
            $table->foreign(static::$idRole)->references(static::$onColumnRoles)->on(static::$asTableRoles);
            $table->unsignedBigInteger(static::$idResource);
            $table->foreign(static::$idResource)->references(static::$onColumnResource)->on(static::$asTableResource);
            $table->boolean(static::$permission);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(self::TABLE);
    }
};
