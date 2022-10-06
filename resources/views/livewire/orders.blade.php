@if(!$show)
    <div class="container d-flex gap-5 flex-column">
        <x-admin.admin-nav name="Orders"/>
        <div>
            <table class="table text-center">
                <thead class="table-dark">
                <tr>
                    <x-table.th name="Name"/>
                    <x-table.th name="products"/>
                    <x-table.th name="Created"/>
                    <x-table.th name="total"/>
                    <x-table.th name="Status"/>
                    <x-table.th name="city"/>

                </tr>
                </thead>
                <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <x-table.td order="{{ $order->name }}"/>
                        <x-table.td order="{{ $order->email }}"/>
                        <x-table.td order="{{ $order->created_at->diffForHumans() }}"/>
                        <x-table.td order="{{ $order->total }}"/>
                        <x-table.td order="{{ $order->status }}"/>
                        <x-table.td order="{{ $order->city }}"/>
                        <td class="px-5 py-5 text-sm border-b border-gray-200">
                            <button
                                class="px-4 py-2 font-semibold tracking-wide text-white bg-indigo-600 rounded-md cursor-pointer"
                                wire:click.prevent="show({{$order->id}})">View
                            </button>
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

@else
    <div>
        <x-order-show :selectedOrder="$selectedOrder" :selectedOrderItems="$selectedOrderItems"/>
    </div>
@endif
