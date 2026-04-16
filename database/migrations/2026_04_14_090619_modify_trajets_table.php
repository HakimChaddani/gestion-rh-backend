<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    // إذا كان الجدول موجوداً نعدله، وإلا ننشئه
    if (Schema::hasTable('trajets')) {
        Schema::table('trajets', function (Blueprint $table) {
            $table->dropColumn(['points_passage', 'poids_kg', 'prix', 'notes', 'statut']);
        });

        Schema::table('trajets', function (Blueprint $table) {
            $table->date('date_entree');
            $table->date('date_sortie')->nullable();
            $table->string('operation');
            $table->integer('nombre_jours')->default(1);
            $table->decimal('prix_unitaire', 10, 2);
        });
    } else {
        Schema::create('trajets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employe_id')->constrained('employes');
            $table->foreignId('vehicule_id')->constrained('vehicules');
            $table->date('date_entree');
            $table->date('date_sortie')->nullable();
            $table->string('operation');
            $table->integer('nombre_jours')->default(1);
            $table->decimal('prix_unitaire', 10, 2);
            $table->timestamps();
        });
    }
}
};
