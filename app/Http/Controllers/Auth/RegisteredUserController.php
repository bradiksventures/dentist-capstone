<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Dentist;
use App\Models\Patient;
use App\Models\Receptionist;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     * @throws ValidationException
     */
    public function create(Request $request) : View
    {
        $this->validate($request, [
            'as' => [
                'sometimes',
                'nullable',
                'in:patient,dentist,receptionist'
            ]
        ]);

        return view('auth.register', [
            'as' => $request->input('as', 'patient')
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request) : RedirectResponse
    {

        // validate request
        $request->validate([
            'as'         => ['required', 'in:patient,dentist,receptionist'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'sex'        => ['required', 'in:male,female,others'],
            'email'      => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'address'    => ['required', 'string'],
            'password'   => ['required', 'confirmed', Rules\Password::defaults()],

            'prc_number'         => ['required_if:as,dentist', 'string'],
            'dental_clinic_name' => ['required_if:as,dentist', 'string'],
        ]);


        /** @var Patient|Dentist|Receptionist $profilable */
        DB::beginTransaction();

        $profilable = match ($request->input('as')) {
            'patient' => Patient::query()->create(),
            'dentist' => Dentist::query()->create(
                $request->only(['prc_number', 'dental_clinic_name'])
            ),
            'receptionist' => Receptionist::query()->create(),
        };

        /** @var User $user */
        $user = User::query()->create(array_merge(
            $request->only([
                'first_name',
                'last_name',
                'sex',
                'email',
                'address',
            ]), [
                'password'        => Hash::make($request->input('password')),
                'profilable_type' => $profilable::class,
                'profilable_id'   => $profilable->getKey(),
            ]
        ));

        DB::commit();

        return redirect(route('show.login'))->with('registrationOk', true);
    }
}
