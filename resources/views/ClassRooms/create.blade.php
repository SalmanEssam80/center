<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Add new Class Room</h2>
    </x-slot>


    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <fieldset class="p-5 border rounded-xl">
                        <legend class="p-2 text-lg font-bold">Add New Class Room</legend>

                        <form method="POST" action="{{ route('classRooms.store') }}">
                            @csrf
                            <div class="grid w-full grid-cols-2 gap-4">
                                <div class="w-full">
                                    <x-input-label>Name</x-input-label>
                                    <x-text-input value="{{old('name')}}" name='name' class="w-full"></x-text-input>
                                    @error('name')
                                        <div class="font-bold text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <x-input-label>configration</x-input-label>
                                    <x-text-input value="{{old('configration')}}" name='configration' class="w-full"></x-text-input>
                                    @error('configration')
                                        <div class="font-bold text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <x-input-label>capacity</x-input-label>
                                    <x-text-input value="{{old('capacity')}}" name='capacity' class="w-full"></x-text-input>
                                    @error('capacity')
                                        <div class="font-bold text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <x-input-label>Branch</x-input-label>
                                    <select name="branch_id">
                                        <option disabled selected value="">select Branch</option>
                                        @foreach (App\models\Branch::orderBy('name')->pluck('name','id')->toArray() as $id=>$name )
                                        <option value="{{ $id }}">{{ $name}}</option>
                                        @endforeach
                                    </select>
                                    @error('branch_id')
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
