<x-app-layout>
    <div class="container mx-auto py-8">

        <x-alert type="success" :message="session('success')"/>
        <x-alert type="error" :errors="$errors->all()"/>
        <form action="{{ route('project.pdf') }}" method="POST" class="bg-component  shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h1 class="text-2xl font-semibold text-text mb-6">
                {{ __('Choose Criteria for Project Report') }}
            </h1>
            @csrf
            <div class="md:grid-cols-2 grid md:gap-4 ">
                <div class="mb-4">
                    <label for="project_name" class="block text-text text-sm font-bold mb-2">
                        {{ __('Project Name ') }}:
                    </label>
                    <select id="project_name" name="project_name"
                            class="shadow appearance-none border border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">{{ __('Select Project') }}</option>
                        @foreach ($projectNames as $name)
                            <option value="{{ $name }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="status" class="block text-text text-sm font-bold mb-2">
                        {{ __('Status') }}:
                    </label>
                    <select id="status" name="status"
                            class="shadow appearance-none border border-black  rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">{{ __('Select Status ') }}</option>
                        @foreach ($statuses as $status)
                            <option value="{{ $status }}">{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="md:grid-cols-2 grid md:gap-4 ">
                <div class="mb-4">
                    <label for="start_date" class="block text-text text-sm font-bold mb-2">
                        {{ __('Start Date ') }}:
                    </label>
                    <input type="date" id="start_date" name="start_date"
                           class="shadow appearance-none border border-black  rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="mb-4">
                    <label for="deadline" class="block text-text text-sm font-bold mb-2">
                        {{ __('Deadline ') }}:
                    </label>
                    <input type="date" id="deadline" name="deadline"
                           class="shadow appearance-none border  border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">

                </div>
            </div>
            <div class="md:grid-cols-2 grid md:gap-4 ">
                <div class="mb-4">
                    <label for="from_date" class="block text-text text-sm font-bold mb-2">
                        {{ __('From Date') }}:
                    </label>
                    <input type="date" id="from_date" name="from_date"
                           class="shadow appearance-none border border-black  rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="to_date" class="block text-text text-sm font-bold mb-2">
                        {{ __('To Date') }}:
                    </label>
                    <input type="date" id="to_date" name="to_date"
                           class="shadow appearance-none border  border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
            </div>
            <div class="md:grid-cols-2 grid md:gap-4 ">
                <div class="mb-4">
                    <label for="cost" class="block text-text text-sm font-bold mb-2">
                        {{ __('Cost') }}:
                    </label>
                    <select id="cost" name="cost"
                            class="shadow appearance-none border  border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">{{ __('Select Cost ') }}</option>
                        @foreach ($costs as $cost)
                            <option value="{{ $cost }}">{{ $cost }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="created_by" class="block text-text text-sm font-bold mb-2">
                        {{ __('Created By ') }}:
                    </label>
                    <select id="created_by" name="created_by"
                            class="shadow appearance-none border  border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">{{ __('Select Creator ') }}</option>
                        @foreach ($createdBys as $createdBy)
                            <option value="{{ $createdBy }}">{{ $createdBy }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="md:grid-cols-2 grid md:gap-4 ">
                <div class="flex items-center justify-between">
                    <button type="submit"
                            class="bg-button text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        {{ __('Generate Report') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
