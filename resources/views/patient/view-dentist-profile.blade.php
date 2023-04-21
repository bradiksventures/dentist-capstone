@php use Carbon\Carbon; @endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center justify-between">
            Dentist Profile
        </h2>
    </x-slot>
    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 gap-4 grid md:grid-cols-2 grid-cols-1 ">
            @if(session('createAppointment') === true)
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 col-span-2 rounded relative"
                     role="alert">
                    <strong class="font-bold">Congratulations!</strong>
                    <span class="block sm:inline">You have successfully sent an appointment!</span>
                </div>
            @endif
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg md:col-span-1 col-span-2">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        Dentist Information
                    </h2>
                </header>
                <div class="mt-6 space-y-6">
                    <div>
                        <div class="grid grid-cols-2">
                            <div class="py-1 font-semibold">Name</div>
                            <div class="py-1">{{ $dentist->profile->full_name }}</div>
                        </div>
                        <div class="grid grid-cols-2">
                            <div class="py-1 font-semibold">PRC Number</div>
                            <div class="py-1">{{ $dentist->prc_number }}</div>
                        </div>
                        <div class="grid grid-cols-2">
                            <div class="py-1 font-semibold">Clinic Name</div>
                            <div class="py-1">{{ $dentist->dental_clinic_name }}</div>
                        </div>
                        <div class="grid grid-cols-2">
                            <div class="py-1 font-semibold">Address</div>
                            <div class="py-1">{{ $dentist->profile->address }}</div>
                        </div>
                        <div class="grid grid-cols-2">
                            <div class="py-1 font-semibold">Email</div>
                            <div class="py-1">{{ $dentist->profile->email }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg flex-col flex md:col-span-1 col-span-2">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        Services Offered
                    </h2>
                    <p class="mt-1 text-sm text-gray-600">
                        See what this dentist has to offer
                    </p>
                </header>
                <div class="mt-6 space-y-6">
                    <table class="w-full border-collapse border-2 border-gray-200 shadow-sm">
                        <thead>
                        <tr class="bg-gray-100 text-left">
                            <th class="px-2 py-1 border-b-2 border-gray-200">Name</th>
                            <th class="px-2 py-1 border-b-2 border-gray-200">Price</th>
                            <th class="px-2 py-1 border-b-2 border-gray-200"></th>

                        </tr>
                        </thead>
                        <tbody>
                        <template x-for="({label, price, id}) in $store.bookingForm.services">
                            <tr class="hover:bg-gray-50">
                                <td class="px-2 py-1 border-b border-gray-200" x-text="label"></td>
                                <td class="px-2 py-1 border-b border-gray-200"
                                    x-text="() => {
                                        const cur = new Intl.NumberFormat('en-US', {
                                            style: 'currency',
                                            currency: 'PHP',
                                        })
                                        return cur.format(price)
                                    }"
                                >
                                </td>
                                <td class="px-2 py-1 border-b border-gray-200">
                                    <a href="#"
                                       @click="() => {
                                            modelOpen =!modelOpen;
                                            $store.bookingForm.reset(id);
                                       }"
                                       class="text-gray-500 hover:text-gray-700 ">Book</a>
                                </td>
                            </tr>
                        </template>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg flex-col flex col-span-2">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        My Appointments
                    </h2>
                    <p class="mt-1 text-sm text-gray-600">
                        View your appointments with this dentist.
                    </p>
                </header>
                <div class="mt-6 space-y-6 flex flex-1 items-stretch justify-center">
                    <table class="w-full border-collapse border-2 border-gray-200 shadow-sm">
                        <thead>
                        <tr class="bg-gray-100 text-left">
                            <th class="px-2 py-1 border-b-2 border-gray-200">Date & Time</th>
                            <th class="px-2 py-1 border-b-2 border-gray-200">Services</th>
                            <th class="px-2 py-1 border-b-2 border-gray-200">Amount</th>
                            <th class="px-2 py-1 border-b-2 border-gray-200">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <template x-for="({date, time, total, services}) in $store.bookingForm.appointments">
                            <tr class="hover:bg-gray-50">
                                <td class="px-2 py-1 border-b border-gray-200"
                                    x-text="() => [date,time].join(' ')"></td>

                                <td class="px-2 py-1 border-b border-gray-200">
                                    <template x-for="s in services">
                                        <span
                                            x-text="s"
                                            class="py-1 px-2 text-xs  rounded-full text-white bg-indigo-500 last:mr-0 mr-1">
                                          cyan
                                        </span>
                                    </template>
                                </td>


                                <td class="px-2 py-1 border-b border-gray-200" x-text="() => {
                                       return new Intl.NumberFormat('en-US', {
                                            style: 'currency',
                                            currency: 'PHP',
                                        }).format(total)
                                    }"></td>
                                <td class="px-2 py-1 border-b border-gray-200 text-orange-500">Pending</td>
                            </tr>
                        </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <x-slot:modalTitle>
            Book appointment
        </x-slot:modalTitle>
        <x-slot:modalSubtitle>
            Please choose a date, time, and services to avail for your appointment.
        </x-slot:modalSubtitle>
        <x-slot:modalContent>
            <div class="w-full">
                <form class="space-y-4">
                    <div class="space-y-2">
                        <label for="date" class="block text-gray-700">Date</label>
                        <input x-on:change="$store.bookingForm.fetchTimeSlots($event.target.value)" type="date"
                               id="date" name="date"
                               min="{{ Carbon::now()->addDay()->toDateString() }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <div class="space-y-2">
                        <span class="block  text-gray-700">Time Slots</span>
                        <template x-if="$store.bookingForm.payload.date">
                            <template x-for="(timeSlot, index) in $store.bookingForm.timeSlots" :key="index">
                                <div class="flex items-center">
                                    <input :disabled="!timeSlot.is_available" x-model="$store.bookingForm.payload.time"
                                           type="radio"
                                           name="timeslot"
                                           :id="'timeslot-' + timeSlot.time"
                                           :value="timeSlot.time"
                                           :disabled="!timeSlot.is_available"
                                           class="text-indigo-600 border-gray-300 rounded-fullradio focus:ring-indigo-500">
                                    <label :for="'timeslot-' + timeSlot.time"
                                           class="ml-3 block"
                                           :class="timeSlot.is_available ? 'text-gray-700' : 'text-red-700'"
                                           x-text="() => {
                                       if(!timeSlot.is_available) {
                                            return `${timeSlot.time} (Not Available)`
                                       }
                                       return timeSlot.time

                                       }">
                                    </label>
                                </div>
                            </template>
                        </template>
                        <template x-if="!$store.bookingForm.payload.date">
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                                 role="alert">
                                <span class="block sm:inline">Choose a date to show available time slots.</span>
                            </div>
                        </template>
                    </div>
                    <div class="space-y-2">
                        <span class="block text-gray-700">Select Items</span>
                        <template x-for="(item, index) in $store.bookingForm.services" :key="index">
                            <div class="flex items-center">
                                <input @change="$store.bookingForm.toggleService(item.id, $event.target.checked)"
                                       type="checkbox"
                                       :id="'item-' + item.id" :value="item.id"
                                       :checked="$store.bookingForm.payload.selectedServices.includes(item.id)"
                                       class="text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                <label :for="'item-' + item.id" class="ml-3 block font-medium text-gray-700"
                                       x-text="item.label"></label>
                                <span class="ml-auto  text-gray-500" x-text="() => {
                                const cur = new Intl.NumberFormat('en-US', {
                                            style: 'currency',
                                            currency: 'PHP',
                                        })
                                        return cur.format(item.price)
                                }"></span>
                            </div>
                        </template>
                        <hr>
                        <div class="flex items-center">
                            <span>Total:</span>
                            <span class="ml-auto" x-text="$store.bookingForm.total"></span>
                        </div>
                    </div>
                    <button type="button"
                            :disabled="!$store.bookingForm.canSubmit && 'disabled'"
                            :class="!$store.bookingForm.canSubmit && ' focus:outline-none disabled:opacity-25'"
                            @click="$store.bookingForm.canSubmit && $store.bookingForm.bookAppointment()"
                            class="w-full px-4 py-2 font-semibold text-white bg-indigo-500 rounded-md hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Submit
                    </button>
                </form>
            </div>
        </x-slot:modalContent>
    </div>
</x-app-layout>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('bookingForm', {
            payload: {
                date: null,
                time: null,
                selectedServices: []
            },
            appointments: {!! $appointments->toJson() !!},
            timeSlots: [],
            services: {!!  $dentist->services->isNotEmpty() ? $dentist->services->toJson() : json_encode([]) !!},
            get total() {
                return new Intl.NumberFormat('en-US', {
                    style: 'currency',
                    currency: 'PHP',
                }).format(this.services.filter(i => this.payload.selectedServices.includes(i.id)).reduce((acc, curr) => (acc + (+curr.price)), 0))
            },
            reset(id) {
                this.payload.selectedServices = [id];
            },
            toggleService(id) {
                if (this.payload.selectedServices.includes(id)) {
                    this.payload.selectedServices.splice(this.payload.selectedServices.indexOf(id), 1)
                } else {
                    this.payload.selectedServices.push(id)
                }
            },
            fetchTimeSlots(date = '') {
                this.payload.date = date;
                if (date === '') return;

                // Replace the URL with your endpoint to fetch available time slots
                axios.post(`/patient/view-dentist-availability`, {
                    date,
                    dentist_id: {{$dentist->id}}
                })
                    .then(({data}) => this.timeSlots = data);
            },
            selectTimeSlot(time) {
                this.payload.time = time;
            },
            bookAppointment() {
                if (!this.canSubmit) {
                    return;
                }

                axios.post('/patient/create-appointment', {
                    dentist_id: {{ $dentist->id }},
                    time: this.payload.time,
                    date: this.payload.date,
                    services: this.payload.selectedServices.map((id) => ({
                        service_id: id,
                        price: (this.services.find(i => i.id === id) || {}).price
                    }))
                }).then(() => {
                    window.location.reload();
                })
            },

            get canSubmit() {
                return [
                    (this.payload.date || '').trim(),
                    (this.payload.time || '').trim(),
                    (this.payload.selectedServices || []).length,
                ].every(i => !!i);
            }
        });
    })
</script>
