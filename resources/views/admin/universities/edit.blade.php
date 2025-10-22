@extends('layouts.admin')

@section('title', 'Edit University')

@section('header', 'Edit University')

@section('content')
<div class="bg-white shadow rounded-lg">
    <form action="{{ route('admin.universities.update', $university) }}" method="POST" class="p-6">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">University Name *</label>
                <input type="text" name="name" id="name" value="{{ old('name', $university->name) }}" required
                    class="mt-1 px-3 py-2 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="country" class="block text-sm font-medium text-gray-700">Country *</label>
                <input type="text" name="country" id="country" value="{{ old('country', $university->country) }}" required
                    class="mt-1 px-3 py-2 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md">
                @error('country')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="city" class="block text-sm font-medium text-gray-700">City *</label>
                <input type="text" name="city" id="city" value="{{ old('city', $university->city) }}" required
                    class="mt-1 px-3 py-2 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md">
                @error('city')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="region" class="block text-sm font-medium text-gray-700">Region *</label>
                <select name="region" id="region" required
                    class="mt-1 px-3 py-2 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md">
                    <option value="">Select Region</option>
                    <option value="North America" {{ old('region', $university->region) == 'North America' ? 'selected' : '' }}>North America</option>
                    <option value="Europe" {{ old('region', $university->region) == 'Europe' ? 'selected' : '' }}>Europe</option>
                    <option value="Asia" {{ old('region', $university->region) == 'Asia' ? 'selected' : '' }}>Asia</option>
                    <option value="Oceania" {{ old('region', $university->region) == 'Oceania' ? 'selected' : '' }}>Oceania</option>
                    <option value="Latin America" {{ old('region', $university->region) == 'Latin America' ? 'selected' : '' }}>Latin America</option>
                    <option value="Africa" {{ old('region', $university->region) == 'Africa' ? 'selected' : '' }}>Africa</option>
                </select>
                @error('region')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="website" class="block text-sm font-medium text-gray-700">Website URL</label>
                <input type="url" name="website" id="website" value="{{ old('website', $university->website) }}"
                    class="mt-1 px-3 py-2 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md">
                @error('website')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="slug" class="block text-sm font-medium text-gray-700">Slug (URL-friendly name) *</label>
                <input type="text" name="slug" id="slug" value="{{ old('slug', $university->slug) }}" required
                    class="mt-1 px-3 py-2 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md">
                @error('slug')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description *</label>
            <textarea name="description" id="description" rows="4" required
                class="mt-1 px-3 py-2 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md">{{ old('description', $university->description) }}</textarea>
            @error('description')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.universities.index') }}" 
                class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded">
                Cancel
            </a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Update University
            </button>
        </div>
    </form>
</div>
@endsection