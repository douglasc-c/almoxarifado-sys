<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserActivity;
use App\Models\Equipament;

class EquipamentsController extends Controller
{
    public function addEquipament(Request $request)
    {
        $user = User::where('token', $request->token)->first();
        $equipament = Equipament::where('serial_number', $request->serial_number)->first();

        if($user){
            if($equipament == null) {
                $equipament = new Equipament;
                $equipament->brand = $request->brand;  
                $equipament->model = $request->model;  
                $equipament->serial_number = $request->serial_number;  
                $equipament->accessories = $request->accessories;
                $equipament->access_password = $request->access_password;  
                $equipament->icloud_email = $request->icloud_email;  
                $equipament->icloud_password = $request->icloud_password;  
                $equipament->status = $request->status;
                $equipament->description = $request->description;
                $equipament->employeer_id = $request->employeer_id;
                $equipament->save();

                $activity_user = new UserActivity;
                $activity_user->uuid = md5(uniqid(rand(), true));
                $activity_user->user_id = $user->id;
                $activity_user->equipament_id = $equipament->id;
                $activity_user->description = 'Equipamento adicionado';
                $activity_user->save();

                return response()->json(['status' => true, 'equipament' => $equipament, 'message' => 'Equipamento adicionado!']);
            } else{
                return response()->json(['status' => false, 'message' => 'Equipamento já cadastrado!']);
            }
        }
        return response()->json(['status' => false, 'message' => 'Usuário não encontrado!']);
    }
    
    public function editEquipament(Request $request)
    {
        $user = User::where('token', $request->token)->first();
        $equipament = Equipament::where('id', $request->id)->first();

        if($user){
            if($equipament){
                $equipament->brand = $request->brand;  
                $equipament->model = $request->model;  
                $equipament->serial_number = $request->serial_number;  
                $equipament->accessories = $request->accessories;
                $equipament->access_password = $request->access_password;  
                $equipament->icloud_email = $request->icloud_email;  
                $equipament->icloud_password = $request->icloud_password;  
                $equipament->status = $request->status;
                $equipament->description = $request->description;
                $equipament->employeer_id = $request->employeer_id;
                $equipament->save();

                $activity_user = new UserActivity;
                $activity_user->uuid = md5(uniqid(rand(), true));
                $activity_user->user_id = $user->id;
                $activity_user->equipament_id = $equipament->id;
                $activity_user->description = 'Equipamento editado';
                $activity_user->save();

                return response()->json(['status' => true, 'equipament' => $equipament, 'message' => 'Equipamento editado!']);
            }
            return response()->json(['status' => false, 'message' => 'Equipamento não encontrado!']);
        }
        return response()->json(['status' => false, 'message' => 'Usuário não encontrado!']);
    }

    public function removeEquipament(Request $request)
    {
        $user = User::where('token', $request->token)->first();
        $equipament = Equipament::where('id', $request->id)->first();

        if($user){
            if($equipament){
                $activity_user = new UserActivity;
                $activity_user->uuid = md5(uniqid(rand(), true));
                $activity_user->user_id = $user->id;
                $activity_user->equipament_id = $equipament->id;
                $activity_user->description = 'Equipamento removido';
                $activity_user->save();

                $equipament->delete();

                return response()->json(['status' => true, 'message' => 'Equipamento removido!']);
            }
            return response()->json(['status' => false, 'message' => 'Equipamento não encontrado!']);
        }
        return response()->json(['status' => false, 'message' => 'Usuário não encontrado!']);
    }

    public function getEquipament()
    {
        $equipament = Equipament::get();
        $user = User::get();

        if($equipament){
            return response()->json(['status' => true, 'message' => 'Todos os equipamentos!', 'Equipament' => $equipament, 'user' => $user]);
        }
        return response()->json(['status' => false, 'message' => 'Equipamentos não encontrados!']);
    }
}
