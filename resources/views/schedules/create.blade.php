<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Add new schedule</h2>
    </x-slot>


    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <fieldset class="p-5 border rounded-xl">
                        <legend class="p-2 text-lg font-bold">Add New Schedule</legend>

                        <form method="POST" action="{{ route('schedules.store') }}">
                            @csrf
                            <div class="grid w-full grid-cols-2 gap-4">
                                <div class="w-full">
                                    <x-input-label>from</x-input-label>
                                    <input type="datetime-local" name="from">
                                    @error('from')
                                        <div class="font-bold text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <x-input-label>to</x-input-label>
                                    <input type="datetime-local" name="to">
                                    @error('to')
                                        <div class="font-bold text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <x-input-label>course</x-input-label>
                                    <select name="course_id">
                                        <option disabled selected value="">select Course</option>
                                        @foreach (App\models\Course::orderBy('name')->pluck('name', 'id')->toArray() as $id => $name)
                                            <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    @error('course_id')
                                        <div class="font-bold text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <x-input-label>Class Room</x-input-label>
                                    <select name="class_room_id">
                                        <option disabled selected value="">select Class Room</option>
                                        @foreach (App\models\ClassRoom::orderBy('name')->pluck('name', 'id')->toArray() as $id => $name)
                                            <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    @error('class_room_id')
                                        <div class="font-bold text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <x-input-label>User</x-input-label>
                                    <select name="user_id">
                                        <option disabled selected value="">select User</option>
                                        @foreach (App\models\User::orderBy('name')->pluck('name', 'id')->toArray() as $id => $name)
                                            <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <div class="font-bold text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="flex justify-end mt-7">
                                    <x-primary-button type="submit">Add</x-primary-button>
                                </div>
                            </div>
                        </form>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
