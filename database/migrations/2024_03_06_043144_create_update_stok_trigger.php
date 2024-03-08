<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{

  public function up(): void{DB::unprepared('
      CREATE TRIGGER update_stok AFTER INSERT ON detail_penjualans FOR EACH ROW
      BEGIN
          DECLARE produk_id INT;
          DECLARE jumlah INT;

            SELECT NEW.produk_id, NEW.jumlah INTO produk_id, jumlah;

            UPDATE produks 
            SET stok = stok - jumlah 
            WHERE id = produk_id;
        END;    
    ');
    }


  public function down(): void{DB::unprepared('DROP TRIGGER IF EXISTS update_stok');}
};
