<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVwMenusView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement("
        CREATE VIEW vw_menus AS
SELECT m.*,mm.title AS ParentName,
case m.status when 0 then 'عدم نمایش' when 1 then 'قابل رویت' end as PersianStatus 
FROM menus m
LEFT JOIN menus mm on mm.id = m.parent_id
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_vw_menus_view');
    }
}
