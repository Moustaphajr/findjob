<x-layout>
    <x-card class=" max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Edit Gig
            </h2>
            <p class="mb-4">Edit : {{ $listing->title }}</p>
        </header>

        <form method="POST" action="/listings/{{ $listing->id }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <label for="company" class="inline-block text-lg mb-2">Company Name</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" value="{{ $listing->company }}"
                    name="company" />

                @error('company')
                    <div>
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    </div>
                @enderror
            </div>

            <div class="mb-6">
                <label for="title" class="inline-block text-lg mb-2">Job Title</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" value="{{ $listing->title }}"
                    name="title" placeholder="Example: Senior Laravel Developer" />

                @error('title')
                    <div>
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    </div>
                @enderror
            </div>

            <div class="mb-6">
                <label for="location" class="inline-block text-lg mb-2">Job Location</label>
                <input type="text" value="{{ $listing->location }}" class="border border-gray-200 rounded p-2 w-full"
                    name="location" placeholder="Example: Remote, Boston MA, etc" />

                @error('location')
                    <div>
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    </div>
                @enderror
            </div>

            <div class="mb-6">
                <label for="email" class="inline-block text-lg mb-2">Contact Email</label>
                <input type="text" class="border border-gray-200 rounded value="{{ $listing->email }}" p-2 w-full"
                    name="email" />

                @error('email')
                    <div>
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    </div>
                @enderror
            </div>

            <div class="mb-6">
                <label for="website" class="inline-block text-lg mb-2">
                    Website/Application URL
                </label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" value="{{ $listing->website }}"
                    name="website" />

                @error('website')
                    <div>
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    </div>
                @enderror
            </div>

            <div class="mb-6">
                <label for="tags" class="inline-block text-lg mb-2">
                    Tags (Comma Separated)
                </label>
                <input value="{{ $listing->tags }}" type="text" class="border border-gray-200 rounded p-2 w-full"
                    name="tags" placeholder="Example: Laravel, Backend, Postgres, etc" />

                @error('tags')
                    <div>
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    </div>
                @enderror
            </div>

            <div class="mb-6">
                <label for="logo" class="inline-block text-lg mb-2">
                    Company Logo
                </label>
                <input type="file" class="border border-gray-200 rounded p-2 w-full" name="logo" />

                <img class="w-48 mr-6 mb-6"
                    src="{{ $listing->logo ? asset('storage/' . $listing->logo) : asset('/images/no-image.png') }}"
                    alt="" />

                @error('logo')
                    <div>
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    </div>
                @enderror
            </div>

            <div class="mb-6">
                <label for="description" class="inline-block text-lg mb-2">
                    Job Description
                </label>
                <textarea class="border border-gray-200 rounded p-2 w-full" name="description" rows="10"
                    placeholder="Include tasks, requirements, salary, etc">{{ $listing->description }}</textarea>

                @error('description')
                    <div>
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    </div>
                @enderror
            </div>

            <div class="mb-6">
                <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
                    update
                </button>

                <a href="/" class="text-black ml-4"> Back </a>
            </div>
        </form>
        </div>
    </x-card>
</x-layout>
