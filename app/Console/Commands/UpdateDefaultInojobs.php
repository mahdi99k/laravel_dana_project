<?php

namespace App\Console\Commands;

use App\Models\Inojob;
use Illuminate\Console\Command;

class UpdateDefaultInojobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string  
     */
    protected $signature = 'app:update-default-inojobs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update default values in inojobs table and replace them (instead of being null)';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $columnsWithDefaults = [
            'location' => "['province' => null, 'spot' => null]",
            'properties' => "['type' => null, 'site' => null, 'salary' => null]",
            'pin' => "[]",
            'major' => "[]",
            'date' => "['publishDate' => null, 'endDate' => null]",
            'count' => "['requests' => 0, 'views' => [], 'likes' => []]",
            'facilities' => "[]",
            'degrees' => "['bachelor' => null, 'master' => null, 'doctor' => null]",
            'properties' => "['gender' => null, 'age' => null]",
        ];

        foreach ($columnsWithDefaults as $column => $defaultValue) {
            Inojob::whereNull($column)->update([$column => $defaultValue]);
        }

        $this->info('Database records updated successfully.');
    }
}
