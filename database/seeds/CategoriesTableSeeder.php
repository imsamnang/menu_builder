<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{

  public function run()
  {

    DB::statement('SET FOREIGN_KEY_CHECKS = 0');
    DB::table('categories')->truncate();
    DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        
  	DB::table('categories')->insert([
  		'name' => 'Phones & Tablets',
  		'slug' => str_slug('phones and tablets','-'),
  		'description' => 'Phones and Tablets',
  		'order' => '1',
  	]);
  	DB::table('categories')->insert([
  		'name' => 'Computers & Accessories',
  		'slug' => str_slug('computers and accessories','-'),
  		'description' => 'Computers and Accessories',
  		'order' => '2',
  	]);
  	DB::table('categories')->insert([
  		'name' => 'Electronics & Appliances',
  		'slug' => str_slug('electronics and appliances','-'),
  		'description' => 'Electronics & Appliances',
  		'order' => '3',
  	]);
  	DB::table('categories')->insert([
  		'name' => 'House & Lands',
  		'slug' => str_slug('house and lands','-'),
  		'description' => 'House & Lands',
  		'order' => '4',
  	]);

  	DB::table('categories')->insert([
  		'name' => 'Jobs',
  		'slug' => str_slug('jobs','-'),
  		'description' => 'Jobs',
  		'order' => '5',
  	]);  	  	  	  	
  }
}
