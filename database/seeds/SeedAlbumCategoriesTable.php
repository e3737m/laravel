<?php

use Illuminate\Database\Seeder;
use App\Models\AlbumCategory;

class SeedAlbumCategoriesTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cats =
            ['abstract',
                'animals',
                'business',
                'cats',
                'city',
                'food',
                'nightlife',
                'fashion',
                'people',
                'nature',
                'sports',
                'technics',
                'transport',
            ];
        foreach ($cats as $cat){
            AlbumCategory::create(
                [
                     'category_name'=> $cat,
                    
                    
                    ]
                
            );
                
        }
    }
}
