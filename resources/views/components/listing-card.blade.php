@props(['listing'])

<x-card>
    <div class="flex">
        <img
        {{-- images/no-image.png --}}
            class="hidden w-48 mr-6 md:block"
            src="{{$listing->logo ? asset('storage/' .$listing->logo) : 'images/no-image.png'}}"
            alt=""
        />
        <div>
            <h3 class="text-2xl">
                <a href="/listing/{{$listing->id}}">{{$listing->title}}</a>
            </h3>
            <div class="text-xl font-bold mb-4">{{$listing->Company}}</div>
            <x-listing-tags :tagsCSV="$listing->tags" />
            <div class="text-lg mt-4">
                <i class="fa-solid fa-location-dot"></i> {{$listing->Location}}
            </div>
        </div>
    </div>
</x-card>
