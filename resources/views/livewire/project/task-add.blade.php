@section('title', 'Task Create')
<div>
    <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-lg border-2 border-gray-200">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-800">Recent Project Activity</h2>
        </div>
        <form wire:submit.prevent="store">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="">Task Name</label>
                    <input type="text" wire:model="title" id="" placeholder="Enter Task Name"
                        class="block w-full border-2 border-gray-400 rounded-lg p-2">
                </div>
            </div>
            <div>
                <label for="">Task Description</label>
                <textarea wire:model="description" id="" placeholder="Enter Task Description"
                    class="block w-full border-2 border-gray-400 rounded-lg p-2"></textarea>
            </div>

            <div class="flex justify-end mt-4 gap-2">
                <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-lg">Add Project</button>
                <a href="{{ route('project.show', $projectId) }}" class="bg-red-800 text-white px-4 py-2 rounded-lg">Back</a>
            </div>
        </form>
    </div>
</div>
