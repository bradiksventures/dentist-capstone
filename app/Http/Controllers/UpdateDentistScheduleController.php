<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class UpdateDentistScheduleController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $input = $request->validate([
            'schedule.*.day' => 'required|numeric:in' . implode(',', range(0, 6)),
            'schedule.*.time' => 'required|date_format:H:i',
        ]);

        DB::beginTransaction();
        $request->user()->profilable->schedules()->delete();
        $request->user()->profilable
            ->schedules()
            ->createMany($input['schedule']);
        DB::commit();

        return response()->json([]);
    }
}
