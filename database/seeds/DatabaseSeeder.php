<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			$this->call(AdminTableSeeder::class);
			$this->call(CountryTableSeeder::class);
			$this->call(ProvinceTableSeeder::class);
			$this->call(CityTableSeeder::class);
			$this->call(MemberTableSeeder::class);
			$this->call(BuildingTableSeeder::class);
			$this->call(BusinessfieldTableSeeder::class);
			$this->call(BusinessTableSeeder::class);
			$this->call(MemberaffTableSeeder::class);
			$this->call(NewsTableSeeder::class);
			$this->call(EventTableSeeder::class);
			$this->call(PhotosCategoryTableSeeder::class);
			$this->call(TicketTableSeeder::class);
			$this->call(LogTicketTableSeeder::class);
			$this->call(BTicketTableSeeder::class);

    }
}

	class adminTableSeeder extends Seeder {
		public function run()
		{
			DB::table('admin')->delete();
			DB::table('admin')->insert(array(
					[
						'admin_name'=>'Administrator',
						'admin_username'=>'admin',
						'admin_password'=>'$2y$10$w8GwRj7VPqGD/5gFK6MHU.RADsw4/du9KIvOs8jiX/u.LtHSf76bu',
						'admin_email'=>'admin@maxel.com'
					]
				));
		}
	}

	class memberTableSeeder extends Seeder {
		public function run()
		{
			DB::table('ticket')->delete();
			DB::table('ticket')->insert(array(
					[
						'member_name'=>'ABC',
						'member_email'=>'abc@gmail.com',
						'member_username'=>'abc',
						'member_password'=>'$2y$10$w8GwRj7VPqGD/5gFK6MHU.RADsw4/du9KIvOs8jiX/u.LtHSf76bu',
						'member_birth_date'=>'1990-01-01',
						'member_gender'=>'l',
						'member_coin'=>'1000000',
						'city_code'=>'CTY00001'
					],
					[
						'member_name'=>'DEF',
						'member_email'=>'def@gmail.com',
						'member_username'=>'def',
						'member_password'=>'$2y$10$w8GwRj7VPqGD/5gFK6MHU.RADsw4/du9KIvOs8jiX/u.LtHSf76bu',
						'member_birth_date'=>'1990-02-02',
						'member_gender'=>'p',
						'member_coin'=>'999999',
						'city_code'=>'CTY00001'
					],
					[
						'member_name'=>'GHI',
						'member_email'=>'ghi@gmail.com',
						'member_username'=>'ghi',
						'member_password'=>'$2y$10$w8GwRj7VPqGD/5gFK6MHU.RADsw4/du9KIvOs8jiX/u.LtHSf76bu',
						'member_birth_date'=>'1990-03-03',
						'member_gender'=>'l',
						'member_coin'=>'0',
						'city_code'=>'CTY00002'
					]
				));
		}
	}

	class cityTableSeeder extends Seeder {
		public function run()
		{
			DB::table('ext_city')->delete();
			DB::table('ext_city')->insert(array(
					[
						'city_code'=>'CTY00001',
						'province_code'=>'PRO00001',
						'city_name'=>'SURABAYA'
					],
					[
						'city_code'=>'CTY00002',
						'province_code'=>'PRO00002',
						'city_name'=>'JAKARTA'
					]
				));
		}
	}

	class businessTableSeeder extends Seeder {
		public function run()
		{
			DB::table('business')->delete();
			DB::table('business')->insert(array(
					[
						'building_id' => '1',
						'bfield_id' => '1',
						'business_name'=>'PT. Jaya ABC',
						'business_email'=>'abc@gmail.com',
						'business_url'=>'http://abc.com'
					],
					[
						'building_id' => '2',
						'bfield_id' => '2',
						'business_name'=>'PT. DEF Maju',
						'business_email'=>'def@gmail.com',
						'business_url'=>'http://def.com'
					],
					[
						'building_id' => '3',
						'bfield_id' => '3',
						'business_name'=>'Toko Super GHI',
						'business_email'=>'ghi@gmail.com',
						'business_url'=>'http://ghi.com'
					]
				));
		}
	}

	class businessfieldTableSeeder extends Seeder {
		public function run()
		{
			DB::table('business_field')->delete();
			DB::table('business_field')->insert(array(
					[
						'bfield_name'=>'Business Field 1',
						'bfield_parent'=>'0',
					],
					[
						'bfield_name'=>'Business Field 2',
						'bfield_parent'=>'1',
					],
					[
						'bfield_name'=>'Business Field 3',
						'bfield_parent'=>'1',
					],
				));
		}
	}

	class buildingTableSeeder extends Seeder {
		public function run()
		{
			DB::table('building')->delete();
			DB::table('building')->insert(array(
					[
						'city_code'=>'CTY00001',
						'building_name'=>'PT. Jaya ABC Cabang Surabaya',
						'building_address'=>'Jl. ABC no 1-3, Surabaya',
						'building_lat'=>'0.0',
						'building_lng'=>'0.0'
					],
					[
						'city_code'=>'CTY00001',
						'building_name'=>'PT. DEF Maju Cabang Surabaya',
						'building_address'=>'Jl. DEF no 7-9, Surabaya',
						'building_lat'=>'0.0',
						'building_lng'=>'0.0'
					],
					[
						'city_code'=>'CTY00002',
						'building_name'=>'Toko Super GHI Cabang Jakarta',
						'building_address'=>'Jl. GHI no 12-15, Jakarta',
						'building_lat'=>'0.0',
						'building_lng'=>'0.0'
					]
				));
		}
	}

	class countryTableSeeder extends Seeder {
		public function run()
		{
			DB::table('ext_country')->delete();
			DB::table('ext_country')->insert(array(
					[
						'country_code'=>'COU00001',
						'country_name'=>'Indonesia'
					]
				));
		}
	}

	class provinceTableSeeder extends Seeder {
		public function run()
		{
			DB::table('ext_province')->delete();
			DB::table('ext_province')->insert(array(
					[
						'province_code'=>'PRO00001',
						'country_code'=>'COU00001',
						'province_name'=>'Jawa Timur'
					],
					[
						'province_code'=>'PRO00002',
						'country_code'=>'COU00001',
						'province_name'=>'Jakarta'
					]
				));
		}
	}

	class memberaffTableSeeder extends Seeder
	{
		public function run()
		{
			DB::table('member_affiliation')->delete();
			DB::table('member_affiliation')->insert(array(
					[
						'member_id' => '1',
						'business_id' => '1',
						'maff_role' => 'owner'
					],
					[
						'member_id' => '2',
						'business_id' => '2',
						'maff_role' => 'owner'
					]
				)
			);
		}
	}

	class newsTableSeeder extends Seeder
	{
		public function run()
		{
			DB::table('news')->delete();
			DB::table('news')->insert(array(
					[
						'member_id' => '1',
						'business_id' => '1',
						'news_title' => 'Diskon buka tahun 2016',
						'news_content' => 'Kami mengadakan diskon buka tahun 2016, silahkan mengunjungi toko-toko cabang kami.',
					],
					[
						'member_id' => '2',
						'business_id' => '2',
						'news_title' => 'Peluncuran produk baru',
						'news_content' => 'Kami telah meluncurkan sebuah produk baru. Hadirilah acara peluncuran produk baru kami',
					]
				)
			);
		}
	}

	class eventTableSeeder extends Seeder
	{
		public function run()
		{
			DB::table('event')->delete();
			DB::table('event')->insert(array(
					[
						'member_id' => '1',
						'business_id' => '1',
						'event_title' => 'Seminar Meningkatkan Produksi Produk',
						'event_content' => 'Kami mengadakan seminar meningkatkan produksi produk dengan cepat.',
						'event_address' => 'Jalan ABC no 1-3',
						'event_lat' => '-7.246582985239078',
						'event_lng' => '112.73772828564461',
						'event_start_date' => '2016-01-05 06:00:00',
						'event_end_date' => '2016-01-05 18:00:00',
					],
					[
						'member_id' => '2',
						'business_id' => '2',
						'event_title' => 'Bazaar Murah',
						'event_content' => 'Kami mengadakan bazaar murah dalam rangka ulang tahun perusahaan kami.',
						'event_address' => 'Jalan DEF no 4-7',
						'event_lat' => '-7.2953848501891825',
						'event_lng' => '112.730426795315',
						'event_start_date' => '2016-01-12 06:00:00',
						'event_end_date' => '2016-01-15 18:00:00',
					],
				)
			);
		}
	}

	class photosCategoryTableSeeder extends Seeder
	{
		public function run()
		{
			DB::table('photos_category')->delete();
			DB::table('photos_category')->insert(array(
					[
						'business_id' => '1',
						'pcat_name' => 'photo'
					],
					[
						'business_id' => '2',
						'pcat_name' => 'photo'
					],
					[
						'business_id' => '3',
						'pcat_name' => 'photo'
					]
				)
			);
		}
	}

	class ticketTableSeeder extends Seeder
	{
		public function run()
		{
			DB::table('ticket')->delete();
			DB::table('ticket')->insert(array(
					[
						'ticket_name' => 'News',
						'ticket_price' => '10',
						'ticket_description' => 'Use this ticket to posting news.',
					],
					[
						'ticket_name' => 'Event',
						'ticket_price' => '15',
						'ticket_description' => 'Use this ticket to posting event.',
					],
				)
			);
		}
	}

	class logTicketTableSeeder extends Seeder
	{
		public function run()
		{
			DB::table('log_ticket')->delete();
			DB::table('log_ticket')->insert(array(
					[
						'ticket_id' => '1',
						'logticket_price' => '10'
					],
					[
						'ticket_id' => '2',
						'logticket_price' => '15'
					],
				)
			);
		}
	}

	class bTicketTableSeeder extends Seeder
	{
		public function run()
		{
			DB::table('bticket')->delete();
			DB::table('bticket')->insert(array(
					[
						'ticket_id' => '1',
						'business_id' => '1',
						'bticket_amount' => '3'
					],
					[
						'ticket_id' => '2',
						'business_id' => '1',
						'bticket_amount' => '3'
					],
					[
						'ticket_id' => '1',
						'business_id' => '2',
						'bticket_amount' => '3'
					],
					[
						'ticket_id' => '2',
						'business_id' => '2',
						'bticket_amount' => '3'
					],
					[
						'ticket_id' => '1',
						'business_id' => '3',
						'bticket_amount' => '3'
					],
					[
						'ticket_id' => '2',
						'business_id' => '3',
						'bticket_amount' => '3'
					],
				)
			);
		}
	}