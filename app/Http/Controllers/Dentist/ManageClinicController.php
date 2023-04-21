<?php

namespace App\Http\Controllers\Dentist;

use App\Http\Controllers\Controller;
use App\Models\Dentist;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class ManageClinicController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        /** @var Dentist $dentist */
        $dentist = $request->user()->profilable;

        $dentist->load('services');

        return view('dentist.manage-clinic', [
            'schedules' => $dentist->schedules,
            'services' => $dentist->services
        ]);
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function updateServices(Request $request): JsonResponse
    {
        $input = $request->validate([
            'services.*.id' => 'nullable|integer|exists:services,id',
            'services.*.label' => 'required|string|max:255',
            'services.*.price' => 'required|numeric|min:0',
        ]);

        /** @var Dentist $profilable */
        $profilable = $request->user()->profilable;
        $profilable->load('services');

        DB::beginTransaction();

        $serviceIds = array_filter(array_column($input['services'], 'id'));
        $profilable->services()->whereNotIn('id', $serviceIds)->delete();

        // Update existing services
        foreach ($input['services'] as $serviceData) {
            $payload = Arr::only($serviceData, ['label', 'price']);
            if (isset($serviceData['id'])) {
                /** @var Service $service */
                $service = $profilable->services->firstWhere('id', $serviceData['id']);
                $service->update($payload);
            } else {
                $profilable->services()->create($payload);
            }
        }

        // Delete removed services


        DB::commit();

        return response()->json([]);
    }
}
