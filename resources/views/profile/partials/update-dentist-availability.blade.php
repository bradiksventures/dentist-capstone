<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Availability') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Timeslots available for your patients to choose') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6"
          x-data="{ schedule: [{
            day: 0,
            time: null
          }] }"
    >
        @csrf
        @method('put')

        <template x-for="(item, index) in schedule">
            <div class="grid grid-flow-col auto-cols-max gap-4 items-center">
                <div>
                    <x-select
                        name="day"
                        :options="['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']"
                    />
                </div>
                <div>
                    <x-text-input id="time" type="time" name="last_name" required/>
                </div>
                <template x-if="index === schedule.length - 1">
                    <div >
                        <x-secondary-button type="button" x-on:click="() => schedule.push({})">Add</x-secondary-button>
                    </div>
                    <div>
                        <x-secondary-button type="button" x-on:click="() => schedule.splice(index, 1)">Remove</x-secondary-button>
                    </div>
                </template>
                <template x-if="index < schedule.length ">
                    <div >
                        <x-secondary-button type="button" x-on:click="() => schedule.splice(index, 1)">Remove</x-secondary-button>
                    </div>
                </template>
            </div>
        </template>
    </form>
</section>
