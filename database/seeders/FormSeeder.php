<?php

namespace Database\Seeders;

use App\Models\Form;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;

class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        //get all services
        $services = Service::get()->pluck('name')->toArray();



        //create 10 forms for each service
        foreach (range(1, 150) as $service) {

            //create a 10 digit invoice number unique with invoice_id column in Form model
            do {
                // Generate a random 10-digit number
                $invoiceNumber = mt_rand(1000000000, 9999999999);

                // Check if this number already exists in the database
                $exists = Form::where('invoice_id', $invoiceNumber)->exists();
            } while ($exists);


            Form::create([
                'invoice_id' => $invoiceNumber,
                'type' => $services[array_rand($services)],
                'customer_name' => $faker->name(),
                'service_submission_date' => $faker->date(),
                'address_city' => $faker->city(),
                'address_country' => $faker->country(),
                'electronic_account_name' => $faker->name(),
                'agreed_to_terms' => ['yes', 'I agreed through WhatsApp'][array_rand(['yes', 'I agreed through WhatsApp'])],
                'phone_number' => $faker->phoneNumber(),
                'amount_previously_paid' => $faker->randomFloat(2, 0, 10000),
                'electronic_signature' => $faker->name(),
            ]);
        }
    }
}
