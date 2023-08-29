<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">edit branch</h2>
    </x-slot>


    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <fieldset class="p-5 border rounded-xl">
                        <legend class="p-2 text-lg font-bold">edit branch</legend>
                        {{-- @if ($errors->any())
                            <div>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li class="text-red-600">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif --}}
                        <form method="POST" action="{{ route('branch.update', $branch->id) }}">
                            @method('patch')
                            @csrf
                            <div class="grid w-full grid-cols-2 gap-4">
                                <div class="w-full">
                                    <x-input-label>Name</x-input-label>
                                    <x-text-input value="{{ old('name', $branch->name) }}" name='name'
                                        class="w-full"></x-text-input>
                                    @error('name')
                                        <div class="font-bold text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <x-input-label>location</x-input-label>
                                    <x-text-input value="{{ old('location', $branch->location) }}" name='location'
                                        class="w-full"></x-text-input>
                                    @error('location')
                                        <div class="font-bold text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <x-input-label>Company</x-input-label>
                                    <select name="company_id">
                                        <option selected value="{{ old('company_id',$branch->company_id) }}">{{ $branch->company->name}}</option>
                                        @foreach (App\models\Company::orderBy('name')->pluck('name', 'id')->toArray() as $id => $name)
                                        <option value="{{ old('company_id',$branch->company_id) }}">{{ $name}}</option>
                                        @endforeach
                                    </select>
                                    @error('company_id')
                                        <div class="font-bold text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="flex justify-end mt-7">
                                    <x-primary-button type="submit">Update</x-primary-button>
                                </div>
                            </div>
                        </form>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
