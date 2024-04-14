<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Send message
        </h2>
    </x-slot>


    @if ($roles->contains('id', 1))
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


                <div class="flex justify-center items-center">
                    <div
                        class="max-w-sm p-6 w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <form class="max-w-sm mx-auto" action=" {{ route('saveMessage') }} " method="POST">

                            @csrf
                            <input type="hidden" value="{{ $user->id }}" id="id_user" name="id_user">
                            <h2>User: {{ $user->name }} </h2>
                            <div class="flex flex-wrap mt-5">
                                <div class="w-1/2 p-1">
                                    <x-input-label for="categories" :value="__('Categories')" />
                                    <div class="flex items-center mb-4">
                                        <select id="categories" name="categories"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="">Choose an option</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    @if (!$categoriesSelected->contains($category->id)) disabled @endif
                                                    {{ old('categories') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->description }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <x-input-error class="mt-2" :messages="$errors->get('categories')" />

                                </div>

                                <div class="w-1/2 p-1">
                                    <x-input-label for="notification" :value="__('Type notification')" />

                                    <div class="flex items-center mb-4">
                                        <select id="notification" name="notification"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="">Choose an option</option>
                                            @foreach ($notifications as $notification)
                                                <option value="{{ $notification->id }}"
                                                    @if (!$notificationsSelected->contains($notification->id)) disabled @endif
                                                    {{ old('notification') == $notification->id ? 'selected' : '' }}>
                                                    {{ $notification->type }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <x-input-error class="mt-2" :messages="$errors->get('notification')" />
                                </div>
                            </div>


                            <label for="message"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Message</label>
                            <textarea id="message" rows="4" name="message"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Write a message">{{ old('message') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('message')" />


                            <div class="flex justify-center items-center mt-5">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    @endif



</x-app-layout>
