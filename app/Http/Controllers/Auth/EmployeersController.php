<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserActivity;
use App\Models\Employeer;
use App\Models\Equipament;

class EmployeersController extends Controller
{
    public function addEmployeer(Request $request)
    {
        $user = User::where('token', $request->token)->first();
        $employeer = Employeer::where('document_number', $request->document_number)->first();

        if($user){
            if($employeer == null) {
                $employeer = new Employeer;
                $employeer->name = $request->name;  
                $employeer->identification_number = $request->identification_number;  
                $employeer->document_number = $request->document_number;  
                $employeer->email = $request->email;
                $employeer->address = $request->address;  
                $employeer->phone = $request->phone;  
                $employeer->function = $request->function;  
                $employeer->save();

                $activity_user = new UserActivity;
                $activity_user->uuid = md5(uniqid(rand(), true));
                $activity_user->user_id = $user->id;
                $activity_user->employeer_id = $employeer->id;
                $activity_user->description = 'Funcionário adicionado';
                $activity_user->save();

                return response()->json(['status' => true, 'employeer' => $employeer, 'message' => 'Funcionário adicionado!']);
            } else{
                return response()->json(['status' => false, 'message' => 'Funcionário já cadastrado!']);
            }
        }
        return response()->json(['status' => false, 'message' => 'Usuário não encontrado!']);
    }
    
    public function editEmployeer(Request $request)
    {
        $user = User::where('token', $request->token)->first();
        $employeer = Employeer::where('id', $request->id)->first();

        if($user){
            if($employeer){
                $employeer->name = $request->name;
                $employeer->identification_number = $request->identification_number;
                $employeer->document_number = $request->document_number;
                $employeer->email = $request->email;
                $employeer->address = $request->address;
                $employeer->phone = $request->phone;
                $employeer->function = $request->function;
                $employeer->save();

                $activity_user = new UserActivity;
                $activity_user->uuid = md5(uniqid(rand(), true));
                $activity_user->user_id = $user->id;
                $activity_user->employeer_id = $employeer->id;
                $activity_user->description = 'Funcionário editado';
                $activity_user->save();

                return response()->json(['status' => true, 'employeer' => $employeer, 'message' => 'Funcionário editado!']);
            }
            return response()->json(['status' => false, 'message' => 'Funcionário não encontrado!']);
        }
        return response()->json(['status' => false, 'message' => 'Usuário não encontrado!']);
    }

    public function removeEmployeer(Request $request)
    {
        $user = User::where('token', $request->token)->first();
        $employeer = Employeer::where('id', $request->id)->first();

        if($user){
            if($employeer){
                $activity_user = new UserActivity;
                $activity_user->uuid = md5(uniqid(rand(), true));
                $activity_user->user_id = $user->id;
                $activity_user->employeer_id = $employeer->id;
                $activity_user->description = 'Funcionário removido';
                $activity_user->save();

                $employeer->delete();

                return response()->json(['status' => true, 'message' => 'Funcionário removido!']);
            }
            return response()->json(['status' => false, 'message' => 'Funcionário não encontrado!']);
        }
        return response()->json(['status' => false, 'message' => 'Usuário não encontrado!']);
    }

    public function getEmployeers(Request $request)
    {
        $employeers = Employeer::get();

        if($employeers){
            return response()->json(['status' => true, 'message' => 'Todos os funcionários!', 'employeers' => $employeers]);
        }
        return response()->json(['status' => false, 'message' => 'Funcionários não encontrados!']);
    }

    public function getEmployeer(Request $request)
    {
        $employeer = Employeer::where('id', $request->id)->first();

        if($employeer){

            $equipaments = Equipament::where('employeer_id', $employeer->id)->get();

            return response()->json(['status' => true, 'equipaments' => $equipaments, 'employeer' => $employeer]);
        }
        return response()->json(['status' => false, 'message' => 'Funcionários não encontrados!']);
    }
}
