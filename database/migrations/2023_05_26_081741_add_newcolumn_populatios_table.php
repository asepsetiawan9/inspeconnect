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
        Schema::table('populations', function (Blueprint $table) {
             $table->bigInteger("garut_kota")->default(0)->nullable();
             $table->bigInteger("karangpawitan")->default(0)->nullable();
             $table->bigInteger("wanaraja")->default(0)->nullable();
             $table->bigInteger("tarogong_kaler")->default(0)->nullable();
             $table->bigInteger("tarogong_kidul")->default(0)->nullable();
             $table->bigInteger("banyuresmi")->default(0)->nullable();
             $table->bigInteger("samarang")->default(0)->nullable();
             $table->bigInteger("pasirwangi")->default(0)->nullable();
             $table->bigInteger("leles")->default(0)->nullable();
             $table->bigInteger("kadungora")->default(0)->nullable();
             $table->bigInteger("leuwigoong")->default(0)->nullable();
             $table->bigInteger("cibatu")->default(0)->nullable();
             $table->bigInteger("kersamanah")->default(0)->nullable();
             $table->bigInteger("malangbong")->default(0)->nullable();
             $table->bigInteger("sukawening")->default(0)->nullable();
             $table->bigInteger("karangtengah")->default(0)->nullable();
             $table->bigInteger("bayongbong")->default(0)->nullable();
             $table->bigInteger("cigedug")->default(0)->nullable();
             $table->bigInteger("cilawu")->default(0)->nullable();
             $table->bigInteger("cisurupan")->default(0)->nullable();
             $table->bigInteger("sukaresmi")->default(0)->nullable();
             $table->bigInteger("cikajang")->default(0)->nullable();
             $table->bigInteger("banjarwangi")->default(0)->nullable();
             $table->bigInteger("singajaya")->default(0)->nullable();
             $table->bigInteger("cihurip")->default(0)->nullable();
             $table->bigInteger("peundeuy")->default(0)->nullable();
             $table->bigInteger("pameungpeuk")->default(0)->nullable();
             $table->bigInteger("cisompet")->default(0)->nullable();
             $table->bigInteger("cibalong")->default(0)->nullable();
             $table->bigInteger("cikelet")->default(0)->nullable();
             $table->bigInteger("bungbulang")->default(0)->nullable();
             $table->bigInteger("mekarmukti")->default(0)->nullable();
             $table->bigInteger("pakenjeng")->default(0)->nullable();
             $table->bigInteger("pamulihan")->default(0)->nullable();
             $table->bigInteger("cisewu")->default(0)->nullable();
             $table->bigInteger("caringin")->default(0)->nullable();
             $table->bigInteger("talegong")->default(0)->nullable();
             $table->bigInteger("balubur_limbangan")->default(0)->nullable();
             $table->bigInteger("selaawi")->default(0)->nullable();
             $table->bigInteger("cibiuk")->default(0)->nullable();
             $table->bigInteger("pangatikan")->default(0)->nullable();
             $table->bigInteger("sucinaraja")->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('populations', function (Blueprint $table) {
            $table->dropColumn("garut_kota");
            $table->dropColumn("karangpawitan");
            $table->dropColumn("wanaraja");
            $table->dropColumn("tarogong_kaler");
            $table->dropColumn("tarogong_kidul");
            $table->dropColumn("banyuresmi");
            $table->dropColumn("samarang");
            $table->dropColumn("pasirwangi");
            $table->dropColumn("leles");
            $table->dropColumn("kadungora");
            $table->dropColumn("leuwigoong");
            $table->dropColumn("cibatu");
            $table->dropColumn("kersamanah");
            $table->dropColumn("malangbong");
            $table->dropColumn("sukawening");
            $table->dropColumn("karangtengah");
            $table->dropColumn("bayongbong");
            $table->dropColumn("cigedug");
            $table->dropColumn("cilawu");
            $table->dropColumn("cisurupan");
            $table->dropColumn("sukaresmi");
            $table->dropColumn("cikajang");
            $table->dropColumn("banjarwangi");
            $table->dropColumn("singajaya");
            $table->dropColumn("cihurip");
            $table->dropColumn("peundeuy");
            $table->dropColumn("pameungpeuk");
            $table->dropColumn("cisompet");
            $table->dropColumn("cibalong");
            $table->dropColumn("cikelet");
            $table->dropColumn("bungbulang");
            $table->dropColumn("mekarmukti");
            $table->dropColumn("pakenjeng");
            $table->dropColumn("pamulihan");
            $table->dropColumn("cisewu");
            $table->dropColumn("caringin");
            $table->dropColumn("talegong");
            $table->dropColumn("balubur_limbangan");
            $table->dropColumn("selaawi");
            $table->dropColumn("cibiuk");
            $table->dropColumn("pangatikan");
            $table->dropColumn("sucinaraja");
        });
    }
};
