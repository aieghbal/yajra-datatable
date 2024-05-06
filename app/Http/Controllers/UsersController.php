<?php
namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Models\User;

class UsersController extends Controller
{
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('users.index');
    }
    public function getUsers()
    {
        $users = User::get();
        $arrayVar = [
            "data" => [

            ],
        ];
        foreach ($users as $user){
            array_push($arrayVar["data"], $user);
        }

        return response()->json($arrayVar);
    }
}
