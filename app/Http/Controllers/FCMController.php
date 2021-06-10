<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FCMController extends Controller
{
    public function index(Request $req) {
        $input = $req->all();
        $fcmToken = $input['fcm_token'];
        $userId = $input['user_id'];

        $user = User::findOrFail($userId);
        $user->fcm_token = $fcmToken;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'User token updated successfully'
        ]);
    }
}
