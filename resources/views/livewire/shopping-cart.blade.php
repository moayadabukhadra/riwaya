<div class="container mt-24 mb-24 h-screen">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-md-9">
                <div class="ibox">
                    <div class="ibox-title">
                        <span class="pull-right"><strong>{{ Cart::getTotalQuantity()}}</strong> items</span>
                        <h5>Items in your cart</h5>
                    </div>
                    @if(!empty($cartItems))
                    @foreach($cartItems as $item)
                    <livewire:cart-item :item="$item" :key="$item['id']" />
                    @endforeach
                    @else
                    <div class="items-center mt-12 space-y-20 text-center">
                        <h1 class="mb-4 text-xl text-gray-500">سلة المشتريات فارغة</h1>
                        <a href="/dashboard" class="px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700">
                            اضف اكتر من صنف
                        </a>
                    </div>
                    @endif


                    <div class="ibox-content">
                        <a href="/dashboard" class="btn btn-white"><i class="fa fa-arrow-left"></i> Continue shopping</a>

                    </div>
                </div>

            </div>
            <div class="col-md-3">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Cart Summary</h5>
                    </div>
                    <div class="ibox-content">
                        <span>
                            Total
                        </span>
                        <h2 class="font-bold">
                            {{Cart::getTotal() +2}} jd
                        </h2>

                        <hr>

                        <div class="m-t-sm">
                            <div class="btn-group">
                                @if(!empty($cartItems))
                                <a href="/check-out">
                                    <a href="/check-out" class="btn btn-primary btn-sm"><i class="fa fa-shopping-cart"></i> Checkout</a>
                                </a>

                                @else
                                @livewire('modal')
                                @endif

                                <a href="#" class="btn btn-white btn-sm"> Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 ibox">
                    <div class="ibox-title">
                        <h5>Support</h5>
                    </div>
                    <div class="text-center ibox-content">
                        <h3><i class="fa fa-phone"></i> +962786317708</h3>
                        <span class="small">
                            Please contact with us if you have any questions. We are avalible 24h.
                        </span>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
