@if(!$show)

<div class="w-full p-8 bg-white rounded-md">

    <div class="flex items-center justify-between pb-6 ">
        <div>
            <h2 class="font-semibold text-gray-600">Orders</h2>
            <span class="text-xs">All Orders</span>
        </div>
        <div class="flex items-center justify-between">
            <div class="flex items-center p-2 rounded-md bg-gray-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                </svg>
                <input class="block ml-1 outline-none bg-gray-50 " type="search" name="" id="" placeholder="search..."  wire:model="searchTerm">
            </div>
            <div class="ml-10 space-x-8 lg:ml-40">
                <button class="px-4 py-2 font-semibold tracking-wide text-white bg-indigo-600 rounded-md cursor-pointer">New Report</button>
                <button class="px-4 py-2 font-semibold tracking-wide text-white bg-indigo-600 rounded-md cursor-pointer">Create</button>
            </div>
        </div>
    </div>
    <div>
        <div class="px-4 py-4 -mx-4 overflow-x-auto sm:-mx-8 sm:px-8">
            <div class="inline-block min-w-full overflow-hidden rounded-lg shadow">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <x-table.th name="Name" />
                            <x-table.th name="products" />
                            <x-table.th name="Created" />
                            <x-table.th name="total" />
                            <x-table.th name="Status" />
                            <x-table.th name="city" />

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        <tr>
                            <x-table.td order="{{ $order->name }}" />
                            <x-table.td order="{{ $order->email }}" />
                            <x-table.td order="{{ $order->created_at->diffForHumans() }}" />
                            <x-table.td order="{{ $order->total }}" />
                            <x-table.td order="{{ $order->status }}" />
                            <x-table.td order="{{ $order->city }}" />
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <button class="px-4 py-2 font-semibold tracking-wide text-white bg-indigo-600 rounded-md cursor-pointer" wire:click.prevent="show({{$order->id}})">View</button>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="flex justify-center mt-4 mb-4">
            {{ $orders->links() }}
        </div>
            </div>
        </div>
    </div>
</div>
@else
<div>

    <x-order-show :selectedOrder="$selectedOrder" :selectedOrderItems="$selectedOrderItems" />
</div>
@endif
