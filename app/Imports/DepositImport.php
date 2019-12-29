<?php
namespace App\Imports;

use App\Deposit;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Verta;
use Validator;

class DepositImport implements ToCollection
{
    public function collection(Collection $rows)
    {
         Validator::make($rows->toArray(), [
               // '*.9' => 'required|unique:depositing_receipt,smart_number',
               '*.0' => 'required',
               '*.1' => 'required',
               '*.2' => 'required',
               '*.3' => 'required',
               '*.4' => 'required',
               '*.5' => 'required',
               '*.6' => 'required',
               '*.7' => 'required',
               '*.8' => 'required',
               '*.9' => 'required',
           ])->validate();
        foreach ($rows as $row) 
        {
            $v = Verta::parse($row[2]);
            $date = $v->DateTime();
             Deposit::firstOrCreate([
            'baker_smart_id' => $row[0],
            'smart_number' => $row[9],
            'city_id' => $row[1],
            'deposit_date' => $date,
            'flour_type' => $row[3],
            'flour_id' => $row[4],
            'number_bags' => $row[5],
            'flourfactory_id' => $row[6],
            'branch_code' => $row[7],
            'user_id' => Auth::id(),
            'type' => 1,
            ]);
        }
    }
}
