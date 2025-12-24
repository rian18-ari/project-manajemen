@section('title', 'Dashboard')
<div>
    <!-- Stats Grid -->
        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Card 1 -->
            <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200 transition duration-300 hover:shadow-xl">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-gray-500">Total Projects</p>
                    <span class="text-lg text-green-500 font-bold bg-green-100 p-1 rounded-full px-2">
                        <i class="fa-solid fa-list-check"></i>
                    </span>
                </div>
                <p class="mt-1 text-3xl font-bold text-gray-900">{{ $projects }}</p>
            </div>
            <!-- Card 2 -->
            <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200 transition duration-300 hover:shadow-xl">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-gray-500">Completed Projects</p>
                    <span class="text-lg text-primary-blue font-bold bg-indigo-100 p-1 rounded-full px-2">
                        <i class="fa-solid fa-list-check"></i>
                    </span>
                </div>
                <p class="mt-1 text-3xl font-bold text-gray-900">{{ $completedProjects }}</p>
            </div>
            <!-- Card 3 -->
            <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200 transition duration-300 hover:shadow-xl">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-gray-500">Not Completed Projects</p>
                    <span class="text-lg text-yellow-600 font-bold bg-yellow-100 p-1 rounded-full px-2">
                        <i class="fa-solid fa-list"></i>
                    </span>
                </div>
                <p class="mt-1 text-3xl font-bold text-gray-900">{{ $notCompletedProjects }}</p>
            </div>
            <!-- Card 4 -->
            <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200 transition duration-300 hover:shadow-xl">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-gray-500">Open Tickets</p>
                    <span class="text-lg text-red-500 font-bold bg-red-100 p-1 rounded-full px-2">
                        <svg class="w-5 h-5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.39 17c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </span>
                </div>
                <p class="mt-1 text-3xl font-bold text-gray-900">18</p>
            </div>
        </section>

        <!-- Main Content (Tables, Charts, etc.) -->
        <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column: Recent Activity (2/3 width on large screens) -->
            <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-lg border border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Recent Project Activity</h2>
                <ul class="space-y-4">
                    @forelse ($tasks as $task)
                    <li class="flex items-start space-x-3 border-b pb-4 last:border-b-0 last:pb-0">
                        <div class="flex-shrink-0 w-2 h-2 mt-2 rounded-full" style="background-color: {{ $task->color }}"></div>
                        <div>
                            <h3 class="text-gray-900"><span class="font-medium">{{ $task->title }}</span></h3>
                            <p>{{ $task->description }}</p>
                        </div>
                    </li>
                    @empty
                        <h1>you have no project yet...</h1>
                    @endforelse
                    <!-- Activity Item -->
                </ul>
            </div>

            <!-- Right Column: Quick Stats (1/3 width on large screens) -->
            <div class="lg:col-span-1 bg-white p-6 rounded-xl shadow-lg border border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Quick Insights</h2>
                <div class="space-y-4">
                    <!-- Insight 1 -->
                    <div class="p-3 bg-secondary-gray rounded-lg border border-gray-100">
                        <p class="text-sm font-medium text-gray-700">Completion Rate</p>
                        <div class="w-full bg-gray-200 rounded-full h-2.5 mt-1">
                            <div class="bg-primary-blue h-2.5 rounded-full" style="width: 75%"></div>
                        </div>
                        <p class="text-right text-xs text-gray-500 mt-1">75% Complete</p>
                    </div>
                    <!-- Insight 2 -->
                    <div class="p-3 bg-secondary-gray rounded-lg border border-gray-100">
                        <p class="text-sm font-medium text-gray-700">Server Load Average</p>
                        <p class="text-2xl font-bold text-red-500">92%</p>
                        <p class="text-xs text-gray-500">High usage spike detected</p>
                    </div>
                    <!-- Insight 3 -->
                    <div class="p-3 bg-secondary-gray rounded-lg border border-gray-100">
                        <p class="text-sm font-medium text-gray-700">Team Morale Score</p>
                        <p class="text-2xl font-bold text-green-600">8.9/10</p>
                        <p class="text-xs text-gray-500">Feedback score from last week</p>
                    </div>
                </div>
            </div>
        </section>
</div>
