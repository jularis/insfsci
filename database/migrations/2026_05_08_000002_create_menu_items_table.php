<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('menus')) {
            Schema::create('menus', function (Blueprint $table) {
                $table->id();
                $table->string('name')->unique();
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('menu_items')) {
            Schema::create('menu_items', function (Blueprint $table) {
                $table->id();
                $table->foreignId('menu_id')->constrained()->cascadeOnDelete();
                $table->foreignId('parent_id')->nullable()->constrained('menu_items')->nullOnDelete();
                $table->unsignedInteger('order')->default(0);
                $table->string('title');
                $table->string('url')->nullable();
                $table->string('target')->nullable();
                $table->string('icon_class')->nullable();
                $table->string('color')->nullable();
                $table->string('route')->nullable();
                $table->text('parameters')->nullable();
                $table->timestamps();
            });
        }

        $menuId = DB::table('menus')->where('name', 'front-menu')->value('id');

        if (! $menuId) {
            $menuId = DB::table('menus')->insertGetId([
                'name' => 'front-menu',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        if (DB::table('menu_items')->where('menu_id', $menuId)->exists()) {
            return;
        }

        $now = now();

        DB::table('menu_items')->insert([
            ['menu_id' => $menuId, 'parent_id' => null, 'order' => 1, 'title' => 'Accueil', 'url' => '/', 'target' => '_self', 'icon_class' => null, 'color' => null, 'route' => null, 'parameters' => null, 'created_at' => $now, 'updated_at' => $now],
            ['menu_id' => $menuId, 'parent_id' => null, 'order' => 2, 'title' => "L'institut", 'url' => 'l-institut', 'target' => '_self', 'icon_class' => null, 'color' => null, 'route' => null, 'parameters' => null, 'created_at' => $now, 'updated_at' => $now],
            ['menu_id' => $menuId, 'parent_id' => null, 'order' => 3, 'title' => 'Etablissements', 'url' => 'etablissements', 'target' => '_self', 'icon_class' => null, 'color' => null, 'route' => null, 'parameters' => null, 'created_at' => $now, 'updated_at' => $now],
            ['menu_id' => $menuId, 'parent_id' => null, 'order' => 4, 'title' => 'Services', 'url' => 'services', 'target' => '_self', 'icon_class' => null, 'color' => null, 'route' => null, 'parameters' => null, 'created_at' => $now, 'updated_at' => $now],
            ['menu_id' => $menuId, 'parent_id' => null, 'order' => 5, 'title' => 'Galerie', 'url' => 'galerie', 'target' => '_self', 'icon_class' => null, 'color' => null, 'route' => null, 'parameters' => null, 'created_at' => $now, 'updated_at' => $now],
            ['menu_id' => $menuId, 'parent_id' => null, 'order' => 6, 'title' => 'Communiques', 'url' => 'communiques', 'target' => '_self', 'icon_class' => null, 'color' => null, 'route' => null, 'parameters' => null, 'created_at' => $now, 'updated_at' => $now],
            ['menu_id' => $menuId, 'parent_id' => null, 'order' => 7, 'title' => 'Actualites', 'url' => 'actualites', 'target' => '_self', 'icon_class' => null, 'color' => null, 'route' => null, 'parameters' => null, 'created_at' => $now, 'updated_at' => $now],
            ['menu_id' => $menuId, 'parent_id' => null, 'order' => 8, 'title' => 'Contact', 'url' => 'contactez-nous', 'target' => '_self', 'icon_class' => null, 'color' => null, 'route' => null, 'parameters' => null, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }

    public function down(): void
    {
        //
    }
};
