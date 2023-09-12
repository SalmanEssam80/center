<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">edit Course</h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <fieldset class="p-5 border rounded-xl">
                        <legend class="p-2 text-lg font-bold">Add New Course</legend>
                        <form method="POST" action="{{ route('courses.update', $course->id) }}">
                            @method('patch')
                            @csrf
                            <div class="grid w-full grid-cols-2 gap-4">
                                <div class="w-full">
                                    <x-input-label>Name</x-input-label>
                                    <x-text-input value="{{old('name',$course->name)}}" name='name' class="w-full"></x-text-input>
                                    @error('name')
                                        <div class="font-bold text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <x-input-label>Hours</x-input-label>
                                    <x-text-input value="{{old('hours',$course->hours)}}" name='hours' class="w-full"></x-text-input>
                                    @error('hours')
                                        <div class="font-bold text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <x-input-label>Price</x-input-label>
                                    <x-text-input value="{{old('price',$course->price)}}" name='price' class="w-full"></x-text-input>
                                    @error('price')
                                        <div class="font-bold text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <x-input-label>Vendor</x-input-label>
                                    <select name="vendor_id">
                                        <option disabled selected value="">select Vendor</option>
                                        @foreach (App\models\Vendor::orderBy('name')->pluck('name','id')->toArray() as $id=>$name )
                                        <option value="{{ $id }}" {{ $id == old('vendor_id',$course->vendor_id)? 'selected':''}}>{{ $name}}</option>
                                        @endforeach
                                    </select>
                                    @error('vendor_id')
                                        <div class="font-bold text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <x-input-label>Category</x-input-label>
                                    <select name="category_id">
                                        <option disabled selected value="">select Category</option>
                                        @foreach (App\models\Category::orderBy('name')->pluck('name','id')->toArray() as $id=>$name )
                                        <option value="{{ $id }}" {{ $id == old('category_id',$course->category_id)? 'selected':''}}>{{ $name}}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="font-bold text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <x-input-label>User</x-input-label>
                                    <select name="user_id">
                                        <option disabled selected value="">select User</option>
                                        @foreach (App\models\User::orderBy('name')->pluck('name','id')->toArray() as $id=>$name )
                                        <option value="{{ $id }}" {{ $id == old('user_id',$course->user_id)? 'selected':''}}>{{ $name}}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <div class="font-bold text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="flex justify-end mt-7">
                                    <x-primary-button type="submit">EDIT</x-primary-button>
                                </div>
                            </div>
                        </form>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
