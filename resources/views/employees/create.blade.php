<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Add new employee</h2>
    </x-slot>


    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <fieldset class="p-5 border rounded-xl">
                        <legend class="p-2 text-lg font-bold">Add new employee</legend>
                        {{-- @if ($errors->any())
                            <div>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li class="text-red-600">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif --}}
                        <form method="POST" action="{{ route('employees.store') }}">
                            @csrf
                            <div class="grid w-full grid-cols-3 gap-4">
                                <div class="w-full">
                                    <x-input-label>user</x-input-label>
                                    <select name="user_id">
                                        <option disabled selected value="">select user</option>
                                        @foreach (App\models\User::orderBy('name')->pluck('name','id')->toArray() as $id=>$name )
                                        <option value="{{ $id }}">{{ $name}}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <div class="font-bold text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <x-input-label>job_title</x-input-label>
                                    <x-text-input value="{{old('job_title')}}" name='job_title' class="w-full"></x-text-input>
                                    @error('job_title')
                                        <div class="font-bold text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <x-input-label>salary</x-input-label>
                                    <x-text-input value="{{old('salary')}}" name='salary' class="w-full"></x-text-input>
                                    @error('salary')
                                        <div class="font-bold text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <x-input-label>hire_date</x-input-label>
                                    {{-- <x-text-input value="{{old('hire_date')}}" name='hire_date' class="w-full"></x-text-input> --}}
                                    <input value="{{old('hire_date')}}" type="date" name="hire_date">
                                    @error('hire_date')
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
