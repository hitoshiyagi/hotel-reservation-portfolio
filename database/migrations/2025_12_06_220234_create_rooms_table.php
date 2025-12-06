<?php

// database/migrations/2025_12_D06_220234_create_rooms_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * rooms_table を作成します。
     */
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            // 1. id (bigint, Primary Key, Auto Increment)
            $table->id();

            // 2. type_name (varchar(100), Unique)
            $table->string('type_name', 100)->unique()->comment('タイプ名（例：プレミアム、スタンダード）');

            // 3. description (text, NULL可)
            $table->text('description')->nullable()->comment('部屋タイプの説明');

            // 4. price (int, Not NULL, Default 0)
            $table->integer('price')->default(0)->comment('1泊あたり料金');

            // 5. capacity (int, Not NULL, Default 4)
            $table->integer('capacity')->default(4)->comment('最大宿泊人数（最大4名）');

            // 6. total_rooms (int, Not NULL, Default 1)
            $table->integer('total_rooms')->default(1)->comment('同タイプの部屋総数');
            
            // 7. available_rooms (int, Not NULL, Default 0)
            $table->integer('available_rooms')->default(0)->comment('現在の空き部屋数（total_rooms - 予約済み数）');

            // 8. plan (tinyint, Not NULL, Default 0)
            $table->tinyInteger('plan')->default(0)->comment('プラン（0=素泊まり）将来用');

            // 9 & 10. created_at, updated_at (timestamp, NULL可)
            // $table->timestamps()で自動生成されます。
            $table->timestamps();

            // 11. deleted_at (timestamp, NULL可) - 【論理削除】
            // LaravelのSoftDeletes機能を利用するためのカラムです。
            $table->softDeletes()->comment('論理削除用（削除日時）');
        });
    }

    /**
     * Reverse the migrations.
     * rooms_table を削除します。
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
