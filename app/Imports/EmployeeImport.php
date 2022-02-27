<?php

namespace App\Imports;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
//class EmployeeImport implements ToCollection, WithHeadingRow,WithValidation
class EmployeeImport implements ToModel, WithValidation, WithHeadingRow
{
    public function rules(): array
    {
    return [
        'navn'             => 'required|max:100',
        'email'            => 'required|email|unique:employees',
        'adgangskode'         => 'required|min:6'

    ];

    }

    public function customValidationMessages()
    {
    return [

            #All Email Validation for Teacher Email
            'email.required'    => 'Email must not be empty!',
            'email.email'       => 'Incorrect email address!',
            'email.unique'      => 'The email has already been used',


            #Max Lenght Validation
            'navn.required'               => 'Navn must not be empty!',
            'navn.min'                    => 'The minimun length Navn :min',

            #Max Lenght Validation
            'adgangskode.required'               => 'Adgangskode must not be empty!',
            'adgangskode.min'                    => 'The minimun length adgangskode :min',

       ];
  }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //dd($row);
        //print_r($row);
        //echo "-------------------------";
        /*
        Validator::make($row->toArray(), [
            '*.name' => 'required', 'string', 'max:255',
            '*.email' => 'required', 'string', 'email', 'max:255', 'unique:employees',
            '*.password' => 'required', 'max:255',
        ])->validate();*/
        $edata= new Employee([
            'name' => trim($row['navn']),
            'email' => $row['email'],
            'password'=>Hash::make($row['adgangskode']),
            'user_id'=>Auth::user()->id,
            'status' => 1,
        ]);
        $details = [
            'email'=>$row['email'],
            'password'=>$row['adgangskode'],
            'company'=>Auth::user()->company
        ];
        //$email=\App\Models\Employee::where('id',$emp_id)->value('email');
        \Mail::to($row['email'])->cc(Auth::user()->email)->send(new \App\Mail\EmployeeLoginMail($details));
        return $edata;

    }
    /*public function collection(Collection $rows)
    {

         Validator::make($rows->toArray(), [
             '*.name' => 'required','string', 'max:255',
             '*.email' => 'required', 'string', 'email', 'max:255', 'unique:employees',
             '*.password' => 'required',
         ])->validate();

        foreach ($rows as $row) {
            Employee::create([
                'name' => $row['name'],
                'email' => $row['email'],
                'password' => bcrypt($row['password']),
                'user_id'=>Auth::user()->id,
                'status' => 1,
            ]);
        }
    }*/

}
