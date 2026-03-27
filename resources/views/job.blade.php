<x-layouts.app>
    <x-slot:heading>
    Jobs Available
    </x-slot:heading>

<h1 class="text-lg"><strong>{{$job['title']}}</strong></h1>
<p>{{$job['salary']}}</p>
<p>Location: {{$job['location']}}</p>
<button>Click Me to Apply</button>
</x-layouts.app>