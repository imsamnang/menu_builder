<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubCategoriesTableSeeder extends Seeder
{
  public function run()
  {
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
		DB::table('sub_categories')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
		
		DB::table('sub_categories')->insert([
			'name' => 'Phones, Tablets',
			'slug' => str_slug('Phones Tablets','-'),
			'description' => 'Phones, Tablets',
			'order' => '1',
			'category_id' => '1',
		]);

		DB::table('sub_categories')->insert([
			'name' => 'Phone Accessories',
			'slug' => str_slug('phone accessories','-'),
			'description' => 'Phone Accessories',
			'order' => '2',
			'category_id' => '1',
		]);

		DB::table('sub_categories')->insert([
			'name' => 'Computers',
			'slug' => str_slug('computers','-'),
			'description' => 'Computers',
			'order' => '1',
			'category_id' => '2',
		]);

		DB::table('sub_categories')->insert([
			'name' => 'Softwares',
			'slug' => str_slug('softwares','-'),
			'description' => 'Softwares',
			'order' => '2',
			'category_id' => '2',
		]);

		DB::table('sub_categories')->insert([
			'name' => 'Consumer Electronics',
			'slug' => str_slug('eonsumer electronics','-'),
			'description' => 'Consumer Electronics',
			'order' => '1',
			'category_id' => '3',
		]);

		DB::table('sub_categories')->insert([
			'name' => 'Security Camera',
			'slug' => str_slug('security samera','-'),
			'description' => 'Security Camera',
			'order' => '2',
			'category_id' => '3',
		]);

		DB::table('sub_categories')->insert([
			'name' => 'House for Sale',
			'slug' => str_slug('house for sale','-'),
			'description' => 'House for Sale',
			'order' => '1',
			'category_id' => '4',
		]);

		DB::table('sub_categories')->insert([
			'name' => 'House for Rent',
			'slug' => str_slug('house for rent','-'),
			'description' => 'House for Rent',
			'order' => '2',
			'category_id' => '4',
		]);

		DB::table('sub_categories')->insert([
			'name' => 'Accounting',
			'slug' => str_slug('accounting','-'),
			'description' => 'Accounting',
			'order' => '1',
			'category_id' => '5',
		]);

		DB::table('sub_categories')->insert([
			'name' => 'Administration',
			'slug' => str_slug('administration','-'),
			'description' => 'Administration',
			'order' => '2',
			'category_id' => '5',
		]);

		DB::table('sub_categories')->insert([
			'name' => ' Banking/Insurance',
			'slug' => str_slug(' banking insurance','-'),
			'description' => ' Banking/Insurance',
			'order' => '3',
			'category_id' => '5',
		]);

		DB::table('sub_categories')->insert([
			'name' => 'Security/Driver',
			'slug' => str_slug('security driver','-'),
			'description' => 'Security/Driver',
			'order' => '4',
			'category_id' => '5',
		]);

  }
}
