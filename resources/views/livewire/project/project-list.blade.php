@section('title', 'Projects')
<div>
    <div wire:ignore class="flex justify-between items-center lg:w-1/4 w-full mb-6 bg-gray-200 h-7 rounded-xl">
        <a wire:navigate href="{{ route('project') }}" class=" lg:w-1/2 w-full text-center rounded-xl h-full nav-link {{ request()->routeIs('project') ? 'active bg-gray-800 text-white' : ''}}">Not Completed</a>
        <a wire:navigate href="{{ route('project.not-completed') }}" class=" lg:w-1/2 w-full text-center rounded-xl h-full nav-link {{ request()->routeIs('project.not-completed') ? 'active bg-gray-800 text-white' : ''}}">Completed</a>
    </div>
    <section class="grid grid-cols-4 grid-flow-row gap-6">
        @foreach ($projects as $project)
        <div class="w-60 h-80 p-6 rounded-xl shadow-lg border-2 border-gray-200 flex flex-col justify-center items-center align-middle" style="background-color: {{ $project->color }}">
            <h2 class="text-xl font-semibold text-gray-800">{{ $project->title }}</h2>
            <div class="rounded-xl items-center align-middle justify-center flex w-12 h-12 bg-gray-200 p-2 ring-2 ring-gray-200 mt-10">
                <h2>A</h2>
            </div>
            <div class="mt-32 w-full items-center align-middle justify-center flex gap-4">
                <a href="{{ route('project.show',['id'=>$project->id]) }}" class="bg-gray-800 w-2/3 text-white px-4 py-2 text-center rounded-lg">Details</a>
                <button wire:click.prevent="delete({{ $projectId = $project->id }})"><i class="fa-solid fa-trash hover:text-white"></i></button>
                <button wire:click.prevent="checkList({{ $projectId = $project->id }})"><i class="fa-solid fa-circle-check hover:text-white"></i></button>
            </div>
        </div>
        @endforeach
        <div class="w-60 h-80 bg-white p-6 rounded-xl shadow-lg border-2 border-gray-200 flex flex-col justify-center items-center align-middle">
            <div class="m-2">
                <a href="{{ route('project.create') }}" class="rounded-xl items-center align-middle justify-center flex w-auto h-12 bg-gray-200 p-2 ring-2 ring-gray-200">
                    <h1 class="text-xl font-semibold text-gray-800">project</h1>
                    <i class="fa-solid fa-plus"></i>
                </a>
            </div>
            
        </div>
    </section>
</div>
