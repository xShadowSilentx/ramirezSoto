<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Log Notifications
        </h2>
    </x-slot>


    @if ($roles->contains('id', 1))
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

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
                                    Category
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Notification
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Message
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Send date
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($logHistories as $log)
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $log->id }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $log->user->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $log->category->description }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $log->notification->type }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $log->message }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $log->created_at }}
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>



            </div>
        </div>
    @endif



</x-app-layout>
