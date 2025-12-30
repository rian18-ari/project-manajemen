@section('title', 'Setting')
<div>
    <section class="relative mb-8 bg-white rounded-xl shadow-lg border border-gray-200">
        <div class="absolute top-2 inset-x-2 h-1/3  pt-3 bg-gray-200 rounded-xl"></div>
        <!-- Card 1 -->
        <div class="relative z-10 p-10">
            <div
                class="bg-white shadow-lg border w-24 h-24 border-gray-200 rounded-full transition duration-300 hover:shadow-xl">
                <img src="{{ asset('asset/img/user_2787279.png') }}" alt="">
            </div>
            <div class="mt-6">
                @auth
                <h2 class="text-xl font-semibold text-gray-800 mb-4">{{ Auth::user()->name }}</h2>
                @endauth
                <ul>
                    <li>● Name: {{ $name->name }}</li>
                    <li>● Email: {{ $email->email }}</li>
                    <li>● Role: {{ $role->role }}</li>
                </ul>
            </div>
        </div>
    </section>

</div>