@props(['wire','order','items'])
<section class="h-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-10 col-xl-8">
                <div class="card" style="border-radius: 10px;">
                    <div class="px-4 py-5 card-header">
                        <h5 class="mb-0 text-muted">Thanks for your Order, <span style="color: #a8729a;">{{ auth()->user()->name }}</span>!</h5>
                        <button wire:click.prevent="{{$wire}}" class="mt-3 btn btn-outline-primary btn-sm">
                            <i class="fas fa-arrow-left"></i>
                            Go Back
                        </button>
                    </div>

                    <div class="p-4 card-body">
                        <div class="mb-4 d-flex justify-content-between align-items-center">
                            <p class="mb-0 lead fw-normal" style="color: #a8729a;">Receipt</p>
                        </div>

                        @foreach($items as $item)
                        <div class="mb-4 border card shadow-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <img src="{{ $item['attributes']['image'] }} " class="img-fluid" alt="Phone">
                                    </div>
                                    <div class="text-center col-md-2 d-flex justify-content-center align-items-center">
                                        <p class="mb-0 text-muted"> {{ $item['name']}}</p>
                                    </div>

                                    <div class="text-center col-md-2 d-flex justify-content-center align-items-center">
                                        <p class="mb-0 text-muted small">{{ $item['quantity']}}</p>
                                    </div>
                                    <div class="text-center col-md-2 d-flex justify-content-center align-items-center">
                                        <p class="mb-0 text-muted small">{{ $item['price'] *  $item['quantity']}}jd </p>
                                    </div>
                                </div>
                                <hr class="mb-4" style="background-color: #e0e0e0; opacity: 1;">
                                <div class="row d-flex align-items-center">


                                </div>
                            </div>
                        </div>
                        @endforeach


                        <div class="pt-2 d-flex justify-content-between">
                            <p class="mb-0 fw-bold">Order Details</p>
                        </div>

                        <div class="pt-2 d-flex justify-content-between">
                            <p class="mb-0 text-muted">order Number : {{$order->id}}</p>

                        </div>



                        <div class="mb-5 d-flex justify-content-between">
                            <p class="mb-0 text-muted"><span class="fw-bold me-4">Delivery Charges </span>2jd</p>
                        </div>

                    </div>
                    <div class="px-4 py-5 border-0 card-footer" style="background-color: #a8729a; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                        <h5 class="mb-0 text-white d-flex align-items-center justify-content-start text-uppercase">Total  <span class="mb-0 h2 ms-2">{{$order->total +2}} jd</span>
                        </h5>

                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
