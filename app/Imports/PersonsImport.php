<?php

namespace App\Imports;

use App\Person;
//use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PersonsImport implements ToCollection, WithStartRow
{
    private $rows = 0;
    private $parent;
    private $data;
    private $start = 1;
    private $count = 12;

    public function __construct(array $parent = [], int $start, int $count)
    {
        $this->start = $start;
        $this->count = $count;
        $this->parent = $parent;
        $this->data = collect();
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return $this->start;
    }

    public function setStartRow($start)
    {
        $this->start = $start;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    /**
     * @return int
     */
    public function batchSize(): int
    {
        return 1000;
    }

    /**
     * Import to collection.
     */
    public function collection(Collection $rows)
    {
        //while($this->start <= $this->count) {
            foreach ($rows as $row) {
                ++$this->rows;
                $person = Person::create([
                    //'client_id' => $this->parent['client_id'],
                    'client_id' => $this->parent['client_id'],
                    'import_id' => $this->parent['id'],
                    //'period_id' => intval($row[2]),
                    'salutation' => $row[2],
                    'first_name' => $row[3],
                    'last_name' => $row[4],
                    'title' => $row[5],
                    'company_name' => $row[6],
                    'email' => $row[7],
                    'phone' => $row[8],
                    'mobile' => $row[9],
                    'website' => $row[11],
                    'active' => intval($row[14]),
                    'approved' => intval($row[15]),
                    'changed' => intval($row[16]),
                    'notes' => $row[17] ,
                    //'notes' => $this->parent['name'] . ' / ' . $this->parent['description'],
                ]);
                $this->data->push($person);
            }
        //}
    }
    
    /*
    public function model(array $row)
    {
        ++$this->rows;
        return new Person([
            //'client_id' => $this->parent['client_id'],
            'client_id' => $this->parent['client_id'],
            'import_id' => $this->parent['id'],
            //'period_id' => intval($row[2]),
            'salutation' => $row[2],
            'first_name' => $row[3],
            'last_name' => $row[4],
            'title' => $row[5],
            'company_name' => $row[6],
            'email' => $row[7],
            'phone' => $row[8],
            'mobile' => $row[9],
            'website' => $row[11],
            'active' => intval($row[14]),
            'approved' => intval($row[15]),
            'changed' => intval($row[16]),
            'notes' => $row[17] ,
            //'notes' => $this->parent['name'] . ' / ' . $this->parent['description'],
        ]);
    }
    */

    /**
     * @return collection
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return int
     */
    public function getRowCount(): int
    {
        return $this->rows;
    }
}
