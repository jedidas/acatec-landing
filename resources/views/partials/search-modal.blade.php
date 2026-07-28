<div id="search-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        {{-- Modal content --}}
        <div class="relative bg-neutral-primary-soft border border-default rounded-base shadow-sm p-4 md:p-6">
            {{-- Modal header --}}
            <div class="flex items-center justify-between pb-3">
                <h3 class="text-lg font-medium text-heading">{{ __('Buscar') }}</h3>
                <button type="button"
                    class="text-body bg-transparent hover:bg-neutral-tertiary hover:text-heading rounded-base text-sm w-9 h-9 ms-auto inline-flex justify-center items-center"
                    data-modal-hide="search-modal">
                    <x-icon name="close" class="w-4 h-4 text-body" />
                </button>
            </div>
            {{-- Modal body --}}
            <div class="space-y-4 md:space-y-6 pt-4">

                <form action="{{ route('search.index') }}" method="GET" class="w-full mx-auto">
                    <label for="search" class="block mb-2.5 text-sm font-medium text-heading sr-only ">
                        {{ __('Buscar') }}
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <x-icon name="search" class="w-4 h-4 text-body" />
                        </div>
                        <input type="search" name="search" id="search"
                            class="block w-full p-3 ps-9 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body"
                            placeholder="{{ __('Buscar') }}..." required
                            value="@isset($search){{ $search }}@endisset" />

                        <button type="submit"
                            class="absolute end-1.5 bottom-1.5 text-white bg-orange hover:bg-orange-600 box-border border border-transparent focus:ring-4 focus:ring-orange-medium shadow-xs font-medium leading-5 rounded text-xs px-3 py-1.5 focus:outline-none">
                            {{ __('Buscar') }}
                        </button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>
