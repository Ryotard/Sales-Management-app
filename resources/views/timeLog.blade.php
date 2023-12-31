@include('partials.header')

<nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 left-0 border-b border-gray-200 dark:border-gray-600">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <button class="flex items-center">
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 22 21">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                    d="M7.24 7.194a24.16 24.16 0 0 1 3.72-3.062m0 0c3.443-2.277 6.732-2.969 8.24-1.46 2.054 2.053.03 7.407-4.522 11.959-4.552 4.551-9.906 6.576-11.96 4.522C1.223 17.658 1.89 14.412 4.121 11m6.838-6.868c-3.443-2.277-6.732-2.969-8.24-1.46-2.054 2.053-.03 7.407 4.522 11.959m3.718-10.499a24.16 24.16 0 0 1 3.719 3.062M17.798 11c2.23 3.412 2.898 6.658 1.402 8.153-1.502 1.503-4.771.822-8.2-1.433m1-6.808a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z" />
            </svg>
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Sales Management</span>
        </button>
        <div class="flex md:order-2">
            <a href="/index" type="button"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Get
                started</a>

        </div>
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
            <button data-collapse-toggle="navbar-sticky" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="navbar-sticky" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
        </div>
    </div>
</nav>
<br>
<br>
<div class="mt-10">
    <h1
        class="flex justify-center mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
        Date: {{ date('m/d/Y') }} </h1>

</div>

<br>
<div class="flex justify-around mt-10">

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-2/5">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Employees
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                    @php
                        // Check if the employee has already clocked in for the current date
                        $timeInRecord = $time
                            ->where('employees_id', $employee->employees_id)
                            ->where('date_id', date('m/d/Y'))
                            ->first();
                    @endphp

                    @if(!$timeInRecord)
                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700 ">
                            <td class="px-6 py-4">
                                {{ $employee->name }}
                            </td>
                            <td class="px-6 py-4">
                                <button data-modal-target="small-modal"
                                    data-modal-toggle="small-modal_{{ $employee->employees_id }}" type="button"
                                    class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Time
                                    In</button>
                                @include('components.time-in-modal')
                            </td>
                        </tr>
                    @endif
                    @endforeach

            </tbody>
        </table>
    </div>




    <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-2/5">

        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Employees
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @if (isset($time))
                    @foreach ($time as $times)
                        @if (isset($times->date_id))
                            @if ($times->date_id == date('m/d/Y'))
                                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700 ">
                                    <td class="px-6 py-4">
                                        {{ $times->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <button data-modal-target="small-modal"
                                            data-modal-toggle="time_out_{{ $times->id }}" type="button"
                                            class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Time
                                            Out</button>
                                        @include('components.time-out-modal')
                                    </td>
                                </tr>
                            @endif
                        @endif
                    @endforeach
                @endif

            </tbody>
        </table>
    </div>

</div>

<div class="p-5 mt-10">

    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Employee
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Time in
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Time Out
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Total Time Rendered
                    </th>
                </tr>
            </thead>
            <tbody>
                @if (isset($time))

                    @foreach ($time as $times)
                        @if (isset($times->date_id))
                            @if ($times->date_id == date('m/d/Y'))
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $times->date_id }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $times->name }}

                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $times->time_in }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $times->time_out }}

                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $times->total_hours }} hours and {{ $times->total_minutes }} minutes

                                    </td>
                                </tr>
                            @endif
                        @endif
                    @endforeach
                @endif

            </tbody>
        </table>
    </div>

</div>


@include('partials.footer')
