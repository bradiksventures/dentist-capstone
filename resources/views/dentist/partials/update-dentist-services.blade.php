@php use App\Models\Service; @endphp
<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Services') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Services provided by the dentist') }}
        </p>
    </header>

    <form class="mt-6 space-y-6" x-data="{
        services: {{ ($services->isNotEmpty() ? $services : collect([new Service(['label' => '', 'price' => ''])]))->toJson() }},
        errors: {},
        hasError(field) {
            return this.errors.hasOwnProperty(field);
        },
        getError(field) {
            return this.hasError(field) && this.errors[field][0];
        },
    }">

        <template x-for="(item, index) in services" :key="index">
            <div>
                <div class="grid grid-flow-col auto-cols-max gap-4 items-center">
                    <div>
                        <x-text-input id="serviceName" type="text" placeholder="Label" required
                                      x-model="services[index]['label']"/>
                    </div>
                    <div>
                        <x-text-input id="price" type="number" placeholder="Price" min="0" step="0.01" required
                                      x-model="services[index]['price']"/>
                    </div>
                    <div>
                        <template x-if="index > 0">
                            <x-secondary-button type="button" x-on:click="() => services.splice(index, 1)">
                                x
                            </x-secondary-button>
                        </template>
                    </div>
                </div>
                <div>
                    <p x-show="hasError(`services.${index}.label`)" class="mt-1 text-xs text-red-600"
                       x-text="getError(`services.${index}.label`)"></p>
                    <p x-show="hasError(`services.${index}.price`)" class="mt-1 text-xs text-red-600"
                       x-text="getError(`services.${index}.price`)"></p>
                </div>
            </div>
        </template>

        <x-secondary-button type="button" x-on:click="() => {
            if(!!services[services.length - 1].label && !!services[services.length - 1].price) {
                services.push({label: '', price: ''})
            }else{
                window.alert('Enter both service label and price for the last item before adding new line. ')
            }
        }">
            Add new
        </x-secondary-button>

        <div class="flex items-center gap-4">
            <x-primary-button type="button" x-on:click="() => {
                 axios.post('/dentist/update-services', {
                    services: services
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
