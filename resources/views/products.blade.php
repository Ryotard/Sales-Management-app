@include('partials.header')
@include('partials.sidebar')
@include('partials.links2')
<div class="p-8 ml-80">

    @include('partials.topbar')
    <div style="margin-top: -30px">
        <br>
        <br>
        <br>
        <!-- Modal toggle -->
        <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal"
            class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
            type="button">
            Add Products</button>

        <x-add-prod-modal />

        <div class="w-full  rounded-lg p-4">

            <div>
                <h4>Inventory</h4>
            </div>
            <hr>


            <div class="overflow-x-auto shadow-md sm:rounded-lg mt-6">


                {{-- Tabs --}}
                <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab"
                        data-tabs-toggle="#myTabContent" role="tablist">
                        {{-- Available Tab --}}
                        <li class="mr-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="available-tab"
                                data-tabs-target="#available" type="button" role="tab" aria-controls="available"
                                aria-selected="false">Available</button>
                        </li>
                        {{-- End of Available Tab --}}

                        <li class="mr-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="phased-out-tab"
                                data-tabs-target="#phase-out" type="button" role="tab" aria-controls="phase-out"
                                aria-selected="false">Unavailble</button>
                        </li>

                    </ul>
                </div>
                <div id="myTabContent">
                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="available" role="tabpanel"
                        aria-labelledby="available-tab">
                        {{-- Available Content --}}
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">

                            <thead>
                                <tr>
                                    <th class="p-4">Product Name</th>
                                    <th class="p-4">Batch Number</th>
                                    <th class="p-4">Date of Expiration</th>
                                    <th class="p-4">Price</th>
                                    <th class="p-4">Quantity</th>
                                    <th class="p-4">Availability</th>
                                    <th class="p-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach ($products as $product)
                                        @if ($product->availability !== 'Phase Out')
                                            <td class="p-4">{{ $product->product_name }}</td>
                                            <td class="p-4">{{ $product->batch_number }}</td>
                                            <td class="p-4">{{ $product->date_exp }}</td>
                                            <td class="p-4">{{ $product->price }}</td>
                                            <td class="p-4">{{ $product->quantity }}</td>
                                            <td class="p-4">{{ $product->availability }}</td>
                                            <td class="p-4">

                                                <button type="button"
                                                    data-modal-target="edit-modal_{{ $product->product_id }}"
                                                    data-modal-toggle="edit-modal_{{ $product->product_id }}"
                                                    class="text-white bg-indigo-500 hover:bg-indigo-500 focus:ring-4 focus:outline-none focus:ring-indigo-500 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-indigo-500 dark:hover:bg-indigo-500 dark:focus:ring-indigo-500">
                                                    <span>
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </span>
                                                </button>
                                                <button type="button"
                                                    data-modal-target="delete-modal_available_{{ $product->product_id }}"
                                                    data-modal-toggle="delete-modal_available_{{ $product->product_id }}"
                                                    class="text-white bg-pink-600 hover:bg-pink-600 focus:ring-4 focus:outline-none focus:ring-pink-600 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-pink-600 dark:hover:bg-pink-600 dark:focus:ring-pink-600">
                                                    <span>
                                                        <i class="fa-solid fa-trash"></i>
                                                    </span>
                                                </button>
                                                @include('components.edit_delete-products')

                                            </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                        {{-- End of Available Content --}}

                    </div>
                    <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="phase-out" role="tabpanel"
                        aria-labelledby="phased-out-tab">
                        {{-- Phased Out Content --}}
                        <br>
                        <div class="p-4 rounded-lg bg-gray-100 dark:bg-gray-800">

                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                <strong class="font-medium text-gray-800 dark:text-white">Unavailable Products Contain
                                    those that
                                    are already 15 days before expiration, Phased Out products, or is empty on stock.</strong>
                            </p>
                        </div>
                            <br>
                        <br>
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">

                            <thead>
                                <tr>
                                    <th class="p-4">Product Name</th>
                                    <th class="p-4">Batch Number</th>
                                    <th class="p-4">Date of Expiration</th>
                                    <th class="p-4">Price</th>
                                    <th class="p-4">Quantity</th>
                                    <th class="p-4">Availability</th>
                                    <th class="p-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach ($products as $product)
                                        @if ($product->availability == 'Phase Out')
                                            <td class="p-4">{{ $product->product_name }}</td>
                                            <td class="p-4">{{ $product->batch_number }}</td>
                                            <td class="p-4">{{ $product->date_exp }}</td>
                                            <td class="p-4">{{ $product->price }}</td>
                                            <td class="p-4">{{ $product->quantity }}</td>
                                            <td class="p-4">{{ $product->availability }}</td>
                                            <td class="p-4">

                                                <button type="button"
                                                    data-modal-target="edit-modal_{{ $product->product_id }}"
                                                    data-modal-toggle="edit-modal_{{ $product->product_id }}"
                                                    class="text-white bg-indigo-500 hover:bg-indigo-500 focus:ring-4 focus:outline-none focus:ring-indigo-500 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-indigo-500 dark:hover:bg-indigo-500 dark:focus:ring-indigo-500">
                                                    <span>
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </span>
                                                </button>
                                                <button type="button"
                                                    data-modal-target="delete-modal_phased_out_{{ $product->product_id }}"
                                                    data-modal-toggle="delete-modal_phased_out_{{ $product->product_id }}"
                                                    class="text-white bg-pink-600 hover:bg-pink-600 focus:ring-4 focus:outline-none focus:ring-pink-600 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-pink-600 dark:hover:bg-pink-600 dark:focus:ring-pink-600">
                                                    <span>
                                                        <i class="fa-solid fa-trash"></i>
                                                    </span>
                                                </button>
                                                @include('components.edit_delete-products')

                                            </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                        {{-- End of Phased Out Content --}}
                    </div>

                </div>
                {{-- End of Tabs --}}







            </div>
        </div>
    </div>
</div>



@include('partials.footer')
