<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\AlbumCategory;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	     //DB:statement('SET FOREIGN_KEY_CHECKS=0');
		 //User::truncate();
         $this->call(SeedUserTable::class);
		  $this->call(SeedAlbumCategoriesTable::class);
		 $this->call(SeedAlbumTable::class);
		 $this->call(SeedPhotoTable::class);
    }
}
