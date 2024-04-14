<x-app-layout>



    @if ($roles->contains('id', 1))
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <x-slot name="header">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        Registered users
                    </h2>
                </x-slot>

                @if (session('success-notification') === 'ok')
                    <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)"
                        class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800"
                        role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            <span class="font-medium">Success!</span> Notification sent successfully
                        </div>
                    </div>
                @endif

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Phone
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Category
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Notification
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <span class="sr-only">Send notification</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($usersData as $user)
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $user['id'] }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $user['name'] }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $user['phone'] }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ implode(', ', $user['categoriesSelected']->toArray()) }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ implode(', ', $user['notificationsSelected']->toArray()) }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <form action="{{ route('sendMessage', ['id' => $user['id']]) }}" method="post">
                                            @csrf
                                            @method('GET')

                                            <button type="submit"
                                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                                Send notification
                                            </button>
                                        </form>


                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    @else
        <div class="grid place-items-center mt-10">
            <h1>Welcome {{ Auth::user()->name }}</h1>
        </div>


    @endif



</x-app-layout>
