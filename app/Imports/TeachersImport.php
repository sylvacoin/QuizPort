<?php

namespace App\Imports;

use App\Models\User;
use App\Notifications\WelcomeNotification;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TeachersImport implements ToCollection, WithBatchInserts, WithHeadingRow, SkipsOnError
{
    use SkipsErrors, Importable;

    public function collection(Collection $rows)
    {
        foreach($rows as $row){
            $password = Str::random(7);
            $user = User::create([
                'name' => $row['name'],
                'email' => $row['email'],
                'password' => Hash::make($password),
                'gender' => $row['gender']
            ]);

            $user->assignRole('teacher');

            $user->notify(new WelcomeNotification($user->name, $password));
        }
    }

    public function batchSize(): int {
        return 400;
    }

    public function onError(\Throwable $error){

    } //works with SkipsOnError trait to skip error messages

    public function failure( \Throwable $error)
    {

    }
}
