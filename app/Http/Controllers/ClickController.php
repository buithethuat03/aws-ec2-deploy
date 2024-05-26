<?php

namespace App\Http\Controllers;

use App\Events\ClickUpdated;
use Illuminate\Http\Request;
use App\Models\ClickCounter;
class ClickController extends Controller
{
    //
    public function getCurrentClick(Request $request) {
        try {
            //get current click
            $currentClick = ClickCounter::value('current_click');

            return response()->json([
                "status" => true,
                "click" => $currentClick,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'msg' => $th->getMessage()
            ], 500);
        }
    }

    public function click(Request $request) {
        try {
            //Add current_click by 1
            ClickCounter::increment('current_click');
            $currentClick = ClickCounter::value('current_click');

            return response()->json([
                "status" => true,
                "click" => $currentClick,
                "msg" => "Update click counter successfully"
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'msg' => $th->getMessage()
            ], 500);
        }
    }


}
