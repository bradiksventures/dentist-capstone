@php use App\Models\DentistSchedule; @endphp
<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Schedule') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Timeslots available for your patients to choose') }}
        </p>
    </header>

    <form class="mt-6 space-y-6" x-data="{
        collection: {{ ($schedules->isNotEmpty() ? $schedules : collect([new DentistSchedule(['day' => 0])]))->toJson() }},
        errors: {},
        hasError(field) {
            return this.errors.hasOwnProperty(field);
        },
        getError(field) {
            return this.hasError(field) && this.errors[field][0];
        },
    }">

        <template x-for="(item, index) in collection" :key="index">
            <div>
                <div class="grid grid-flow-col auto-cols-max gap-4 items-center">
                    <div>
                        <x-select
                            :options="['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']"
                            value="1"
                            model="collection[index]['day']"
                        />

                    </div>
                    <div>
                        <x-text-input id="time" type="time" name="last_name" required x-model="collection[index]['time']"/>
                    </div>
                    <div>
                        <template x-if="index > 0">
                            <x-secondary-button type="button" x-on:click="() => collection.splice(index, 1)">
                                x
                            </x-secondary-button>
                        </template>
                    </div>
                </div>
                <div>
                    <p x-show="hasError(`schedule.${index}.day`)" class="mt-1 text-xs text-red-600" x-text="getError(`schedule.${index}.day`)"></p>
                    <p x-show="hasError(`schedule.${index}.time`)" class="mt-1 text-xs text-red-600" x-text="getError(`schedule.${index}.time`)"></p>
                </div>
            </div>
        </template>

        <x-secondary-button type="button" x-on:click="() => {
            if(!!collection[collection.length - 1].time) {
                collection.push({day: 0})
            }else{
                window.alert('Enter both day and time for the last item before adding new line. ')
            }
        }">
            Add new
        </x-secondary-button>

        <div class="flex items-center gap-4">
            <x-primary-button type="button" x-on:click="() => {
                 axios.post('/update-dentist-schedule', {
                    schedule: collection
                }).then(() => {
                    window.location.reload()
                }).catch(error => {
                    if (error.response.status === 422) {
                        errors = error.response.data.errors;
                    } else {
                        window.alert('Something went wrong. Please try again later.');
                    }
                });
            }">{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
