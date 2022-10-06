@props(['selectedOrder', 'selectedOrderItems'])

<div class="px-4 py-14 md:px-6 2xl:px-20 2xl:container 2xl:mx-auto">

    <div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">Edit Order Details</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/edit-order/{{ $selectedOrder }}" method="POST">
                    @csrf
                    <div class="modal-body mx-3">
                        <div class="md-form mb-5">
                            <input type="text" id="orangeForm-name" name="address" class="form-control validate" wire:model="address">
                            <label data-error="wrong" data-success="right" for="orangeForm-name">address</label>
                        </div>
                        <div class="md-form mb-5">
                            <input type="text" name="phone" id="orangeForm-email" class="form-control validate" wire:model="phone">
                            <label data-error="wrong" data-success="right" for="orangeForm-email">phone</label>
                        </div>

                        <div class="md-form mb-4">
                            <input type="text" name="customer_note" id="orangeForm-pass" class="form-control validate" wire:model="customer_note">
                            <label data-error="wrong" data-success="right" for="orangeForm-pass">Notes</label>
                        </div>

                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary" data-dismiss="modal" wire:click.prevent="edit()">Edit</button>
                    </div>
                </form>

            </div>
        </div>


    </div>


    <div class="flex flex-col justify-start space-y-2 item-start">

        <h1 class="text-3xl font-semibold leading-7 text-gray-800 dark:text-white lg:text-4xl lg:leading-9">Order
            #{{$selectedOrder['id']}}</h1>
        <p class="text-base font-medium leading-6 text-gray-600 dark:text-gray-300">{{ $selectedOrder['created_at']->diffForHumans()}}</p>
    </div>

    <div
        class="flex flex-col items-stretch w-full mt-10 space-y-4 xl:flex-row jusitfy-center xl:space-x-8 md:space-y-6 xl:space-y-0">
        <div class="flex flex-col items-start justify-start w-full space-y-4 md:space-y-6 xl:space-y-8">
            <div
                class="flex flex-col items-start justify-start w-full px-4 py-4 dark:bg-gray-800 bg-gray-50 md:py-6 md:p-6 xl:p-8">
                <p class="mb-4 text-lg font-semibold leading-6 text-gray-800 md:text-xl dark:text-white xl:leading-5">
                    سلة المشتريات</p>
                @foreach($selectedOrderItems as $item)
                    <x-order-item :item="$item"/>
                @endforeach
            </div>
            <div
                class="flex flex-col items-stretch justify-center w-full space-y-4 md:flex-row md:space-y-0 md:space-x-6 xl:space-x-8">
                <div class="flex flex-col w-full px-4 py-6 space-y-6 md:p-6 xl:p-8 bg-gray-50 dark:bg-gray-800">
                    <h3 class="text-xl font-semibold leading-5 text-gray-800 dark:text-white">Summary</h3>
                    <div
                        class="flex flex-col items-center justify-center w-full pb-4 space-y-4 border-b border-gray-200">
                        <div class="flex justify-between w-full">
                            <p class="text-base leading-4 text-gray-800 dark:text-white">المجموع</p>
                            <p class="text-base leading-4 text-gray-600 dark:text-gray-300">{{$selectedOrder['total']}}
                                jd</p>
                        </div>

                        <div class="flex items-center justify-between w-full">
                            <p class="text-base leading-4 text-gray-800 dark:text-white">خدمة التوصيل</p>
                            <p class="text-base leading-4 text-gray-600 dark:text-gray-300">2jd</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between w-full">
                        <p class="text-base font-semibold leading-4 text-gray-800 dark:text-white"> المجموع الكلي</p>
                        <p class="text-base font-semibold leading-4 text-gray-600 dark:text-gray-300">{{$selectedOrder['total'] +2}}
                            jd</p>
                    </div>
                </div>

            </div>
        </div>
        <div
            class="flex flex-col items-center justify-between w-full px-4 py-6 bg-gray-50 dark:bg-gray-800 xl:w-96 md:items-start md:p-6 xl:p-8">
            <h3 class="text-xl font-semibold leading-5 text-gray-800 dark:text-white">العميل</h3>
            <div
                class="flex flex-col items-stretch justify-start w-full h-full md:flex-row xl:flex-col md:space-x-6 lg:space-x-8 xl:space-x-0">
                <div class="flex flex-col items-start justify-start flex-shrink-0">
                    <div
                        class="flex items-center justify-center w-full py-8 space-x-4 border-b border-gray-200 md:justify-start">
                        <img src="https://i.ibb.co/5TSg7f6/Rectangle-18.png" alt="avatar"/>
                        <div class="flex flex-col items-start justify-start space-y-2">
                            <p class="text-base font-semibold leading-4 text-left text-gray-800 dark:text-white">{{ $selectedOrder['name']}}</p>
                        </div>
                    </div>

                    <div
                        class="flex items-center justify-center w-full py-4 space-x-4 text-gray-800 border-b border-gray-200 dark:text-white md:justify-start">
                        <img class="dark:hidden"
                             src="https://tuk-cdn.s3.amazonaws.com/can-uploader/order-summary-3-svg1.svg" alt="email">
                        <p class="text-sm leading-5 cursor-pointer ">{{ $selectedOrder['email']}}</p>
                    </div>
                    <div
                        class="flex items-center justify-center w-full py-4 space-x-4 text-gray-800 border-b border-gray-200 dark:text-white md:justify-start">
                        <img class="dark:block" src="https://img.icons8.com/windows/32/000000/phone.png" alt="email">
                        <p class="text-sm leading-5 cursor-pointer ">{{ $selectedOrder['phone']}}</p>
                    </div>
                </div>
                <div class="flex flex-col items-stretch justify-between w-full mt-6 xl:h-full md:mt-0">
                    <div
                        class="flex flex-col items-center justify-center space-y-4 md:justify-start xl:flex-col md:space-x-6 lg:space-x-8 xl:space-x-0 xl:space-y-12 md:space-y-0 md:flex-row md:items-start">
                        <div
                            class="flex flex-col items-center justify-center space-y-4 md:justify-start md:items-start xl:mt-8">
                            <p class="text-base font-semibold leading-4 text-center text-gray-800 dark:text-white md:text-left">
                                الموقع</p>
                            <p class="w-48 text-sm leading-5 text-center text-gray-600 lg:w-full dark:text-gray-300 xl:w-48 md:text-left">{{ $selectedOrder['city']}}
                                , {{ $selectedOrder['address'] }}</p>
                        </div>

                    </div>
                    <div class="flex items-center justify-center w-full md:justify-start md:items-start">
                        <button data-toggle="modal" data-target="#modalRegisterForm"
                                class="py-5 mt-6 text-base font-medium leading-4 text-gray-800 border border-gray-800 md:mt-0 dark:border-white dark:hover:bg-gray-900 dark:bg-transparent dark:text-white hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 w-96 2xl:w-full">
                            Edit Details
                        </button>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <div class="flex space-x-4 justify-stretch justify-items-center">

        <button type="button"
                class=" text-white bg-blue-700 hover:bg-blue-800  focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mt-4 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 "
                wire:click.prevent="updateToInProgress({{$selectedOrder['id']}})">Mark as InProgress
        </button>


        <button type="button"
                class=" text-white bg-green-500 hover:bg-green-600  focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mt-4 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 "
                wire:click.prevent="updateToDone({{$selectedOrder['id']}})">Mark as done
        </button>

    </div>
</div>
