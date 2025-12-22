@section('title', 'Projects ')
<div>
    @php
        use Illuminate\Support\Str;
    @endphp
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column: Recent Activity (2/3 width on large screens) -->
        <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-lg border-2 border-gray-200">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800"><span style="background-color: {{ $projectTitlw->color }}"
                        class="rounded-lg w-2 h-2"></span>{{ $projectTitlw->title }}</h2>
                <a href="{{ route('task.add', ['id' => $projectId]) }}"
                    class="bg-gray-800 text-white px-4 py-2 rounded-lg">Add Task</a>
            </div>
            <table class="divide-y divide-gray-200 w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Title
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Description
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Start Date
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Labels
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($tasks as $task)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $task->title }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ Str::limit($task->description, 10) }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($task->is_completed)
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Completed
                                    </span>
                                @else
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Not Completed
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-xl text-gray-500">
                                @if ($task->is_completed)
                                    <button><i class="fa-solid fa-circle-check text-green-500"></i></button>
                                @else
                                    <button wire:click="updateTaskStatus({{ $taskId = $task->id }})"><i
                                            class="fa-solid fa-check hover:text-green-500"></i></button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">No tasks found <a
                                    href="{{ route('task.add', ['id' => $projectId]) }}" class="text-blue-500">Add Task</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Right Column: Quick Stats (1/3 width on large screens) -->
        <div class="lg:col-span-1 bg-white p-6 rounded-xl shadow-lg border-2 border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Quick Insights</h2>
            <div class="space-y-4">
                {{-- date --}}
                <div class="p-3 bg-secondary-gray rounded-lg border-2 border-gray-100">
                    <p class="text-sm font-medium text-gray-700">Date</p>
                    <p class="text-left text-md text-gray-500 mt-1">
                        @if (!$projectDate)
                            <span>Date Not Found</span>
                        @else
                            <span class="text-green-400 font-bold">{{ $projectDate->start_date }}</span>
                            sampai
                            <span class="text-red-400 font-bold">{{ $projectDate->end_date }}</span>
                        @endif
                    </p>
                </div>
                <!-- Insight 1 -->
                <div class="p-3 bg-secondary-gray rounded-lg border-2 border-gray-100">
                    <p class="text-sm font-medium text-gray-700">Completion Rate</p>
                    <div class="w-full bg-gray-200 rounded-full h-2.5 mt-1">
                        <div class="bg-blue-500 h-2.5 rounded-full" style="width: {{ $totalTasks ?? 0 }}%"></div>
                    </div>
                    <p class="text-right text-xs text-gray-500 mt-1">{{ number_format($totalTasks ?? 0, 0) }}% Complete
                    </p>
                </div>
                <!-- Insight 2 (pomodoro) -->
                <div class="p-3 bg-secondary-gray rounded-lg border-2 border-gray-100">
                    <div class="flex items-center flex-col">
                        <h1>Pomodoro Timer</h1>
                        <div class="flex gap-2 mb-4 text-2xl font-bold">
                            <span id="minutes">25</span>:<span id="seconds">00</span>
                        </div>
                        <div class="flex gap-2">
                            <button class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600" id="start-btn">Mulai</button>
                            <button class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600" id="pause-btn">Jeda</button>
                            <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600" id="reset-btn">Ulang</button>
                        </div>
                    </div>
                </div>
                <!-- Insight 3 -->
                <div class="p-3 bg-secondary-gray rounded-lg border-2 border-gray-100">
                    <p class="text-sm font-medium text-gray-700">Team Morale Score</p>
                    <p class="text-2xl font-bold text-green-600">8.9/10</p>
                    <p class="text-xs text-gray-500">Feedback score from last week</p>
                </div>
            </div>
        </div>
    </section>
</div>
