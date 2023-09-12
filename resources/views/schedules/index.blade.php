<x-app-layout>
    <x-slot name='header'>
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Schedule
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-end">
                        <x-primary-link href="{{ route('schedules.create') }}">Add new Schedule</x-primary-button>
                    </div>
                    <!-- component -->
                    <div class="p-5">
                        @if (session()->has('added'))
                            <div>
                                <div
                                    class="flex justify-center items-center m-1 font-medium py-1 px-2  rounded-md text-green-100 bg-green-700 border border-green-700 ">
                                    <div slot="avatar">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-check-circle w-5 h-5 mx-2">
                                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                        </svg>
                                    </div>
                                    <div class="text-xl font-normal  max-w-full flex-initial">
                                        <div class="py-2">This is a success messsage
                                            <div class="text-sm font-base">
                                                {{ session('added') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-auto flex-row-reverse">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-x cursor-pointer hover:text-green-400 rounded-full w-5 h-5 ml-2">
                                                <line x1="18" y1="6" x2="6" y2="18">
                                                </line>
                                                <line x1="6" y1="6" x2="18" y2="18">
                                                </line>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                    <form action="{{ route('schedules.index') }}">
                        <div class="flex justify-evenly">
                            <div>
                                <x-input-label for='Search By Name'>Search By course</x-input-label>
                                <x-text-input name='search'></x-text-input>
                            </div>
                            <div>
                                <x-primary-button type="submit">search</x-primary-button>
                            </div>
                        </div>
                    </form>

                    <!-- component -->
                    <div class="flex flex-col">
                        <div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5">
                            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                                <div class="overflow-hidden">
                                    <table class="w-full">
                                        <thead class="bg-white border-b">
                                            <tr>
                                                <th scope="col"
                                                    class="px-6 py-4 text-sm font-medium text-left text-gray-900">
                                                    #
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-4 text-sm font-medium text-left text-gray-900">
                                                    from
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-4 text-sm font-medium text-left text-gray-900">
                                                    to
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-4 text-sm font-medium text-left text-gray-900">
                                                    course
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-4 text-sm font-medium text-left text-gray-900">
                                                    category
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-4 text-sm font-medium text-left text-gray-900">
                                                    user
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-4 text-sm font-medium text-left text-gray-900">
                                                    created at
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-4 text-sm font-medium text-left text-gray-900">
                                                    actions
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($schedules as $key => $schedule)
                                                <tr class="bg-gray-100 border-b">
                                                    <td
                                                        class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                                                        {{ $key + $schedules->firstItem() }}
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                                                        {{ $schedule->from }}
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                                                        {{ $schedule->to }}
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                                                        {{ $schedule->course->name }}
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                                                        {{ $schedule->classRoom->name }}
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                                                        {{ $schedule->user->name }}
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                                                        {{ date_format(date_create($schedule->created_at), 'Y-m-d h:i:s a') }}
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                                                        <div class="flex justify-evenly">
                                                            <div>
                                                                <a href="{{ route('schedules.edit', $schedule->id) }}">
                                                                    <i class="fa-solid fa-pen-to-square"></i></a>
                                                            </div>
                                                            <div>
                                                                <form method="POST"
                                                                    action="{{ route('schedules.destroy', $schedule->id) }}">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button type="submit">
                                                                        <i class="fa-solid fa-trash"
                                                                            style="color: #ef0606;"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <td colspan='9' class="text-center bg-gray-100 border-b">
                                                    NO DATA YET
                                                </td>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        {{ $schedules->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
