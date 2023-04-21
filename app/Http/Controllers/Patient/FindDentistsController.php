<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\AppointmentService;
use App\Models\Dentist;
use App\Models\DentistSchedule;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class FindDentistsController extends Controller
{
    public function index(): View
    {
        return view('patient.find-dentists');
    }

    /**
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function doFindDentists(Request $request): JsonResponse
    {
        $query = $request->input('query');

        $dentists = Dentist::query()
            ->whereHas('profile', function ($queryBuilder) use ($query) {
                $queryBuilder->where('first_name', 'like', "%{$query}%")
                    ->orWhere('last_name', 'like', "%{$query}%")
                    ->orWhere('address', 'like', "%{$query}%");
            })
            ->orWhere('dental_clinic_name', 'like', "%{$query}%")
            ->with('profile')
            ->get();

        return response()->json($dentists);
    }

    /**
     * Display the dentist's profile.
     * @param Dentist $dentist
     * @return View
     */
    public function viewDentistProfile(Dentist $dentist): View
    {
        $dentist->load('services');

        $appointments = Appointment::query()
            ->with('services.service')
            ->where([
                'patient_id' => Auth::user()->profilable->id,
                'dentist_id' => $dentist->id,
            ])
            ->get()
            ->map(function (Appointment $appointment) {
                return [
                    'total' => $appointment->services->sum('price'),
                    'date' => $appointment->date->format('m/d/Y'),
                    'time' => Carbon::createFromFormat('H:i', $appointment->time)->format('h:i A'),
                    'services' =>  $appointment->services->map(fn (AppointmentService $service) => $service->service->label)
                ];
            });


        return view('patient.view-dentist-profile', [
            'dentist' => $dentist,
            'appointments' => $appointments
        ]);
    }


    public function getDentistAvailableSchedules(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'date' => 'required|date_format:Y-m-d',
            'dentist_id' => 'required|exists:dentists,id'
        ]);

        /** @var Dentist $dentist */
        $dentist = Dentist::query()->findOrFail($validated['dentist_id']);

        // Convert the input date to a Carbon instance and extract the day of the week (1-7)
        $inputDate = Carbon::parse($validated['date']);
        $dayOfWeek = $inputDate->dayOfWeekIso;

        // Query the dentist_schedules table for available time slots of the specified dentist
        $availableSlots = $dentist->schedules()
            ->where('day', $dayOfWeek)
            ->orderBy('time')
            ->get();

        $appointments = $dentist->appointments()
            ->whereDate('date', $validated['date'])
            ->get();

        // Cross-check available slots with appointments
        $availableSlots = $availableSlots->map(function (DentistSchedule $slot) use ($appointments) {
            $timeSlot = Carbon::createFromFormat('H:i', $slot->time);
            $isAvailable = !$appointments->contains(function (Appointment $appointment) use ($timeSlot) {
                return Carbon::createFromFormat('H:i', $appointment->time)->equalTo($timeSlot);
            });

            return [
                'time' => $timeSlot->format('h:i A'),
                'is_available' => $isAvailable,
            ];
        });

        // Return the available time slots and availability indicators as a JSON response
        return response()->json($availableSlots);
    }


    public function createAppointment(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'dentist_id' => 'required|exists:dentists,id',
            'date' => 'required|date_format:Y-m-d',
            'time' => 'required|date_format:"h:i A"',
            'services' => 'required|array',
            'services.*.service_id' => 'required|exists:services,id',
            'services.*.price' => 'required|numeric',
        ]);

        /** @var Patient $patient */
        $patientId = Auth::user()->profilable->id;

        DB::beginTransaction();

        /** @var Dentist $dentist */
        $dentist = Dentist::query()->findOrFail($validated['dentist_id']);

        /** @var Appointment $appointment */
        $appointment = $dentist->appointments()->create([
            'patient_id' => $patientId,
            'date' => $validated['date'],
            'time' => Carbon::createFromFormat('h:i A', $validated['time'])->format('H:i'),
        ]);

        $appointment->services()->createMany(
            array_map(fn(array $service) => Arr::only($service, ['service_id', 'price']), $validated['services'])
        );

        DB::commit();

        session()->flash('createAppointment', true);
        return response()->json(['OK']);
    }

}
