<?php

use App\Company;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws FileNotFoundException
     */
    public function run()
    {
        try {
            Company::truncate();
            $json = File::get('database/data/companies.json');
            $companies = json_decode($json);
            foreach ($companies->companies as $key => $value) {
                $value = trim(preg_replace('/[0-9\@\.\;\" "]+/', ' ', $value->Account_Name));
                Company::create([
                    'name' => $value,
                ]);
            }
        } catch (FileNotFoundException $exception) {
            dd($exception);
        }
    }
}
