@props(['wire','order'])
<section class="">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
                <div class="card card-stepper" style="border-radius: 10px;">
                    <div class="p-4 card-body">

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex flex-column">
                                <span class="lead fw-normal">Your order is {{$order->status}}</span>
                                <span class="text-muted small">by {{auth()->user()->name }} on {{ date_format($order->created_at, "d/y/m")}}</span>
                            </div>
                            <div>
                                <button class="btn btn-outline-primary" wire:click.prevent="{{ $wire }}">Track order details</button>
                            </div>
                        </div>
                        <hr class="my-4">

                        <div class="flex-row d-flex justify-content-between align-items-center align-content-center">
                            <span class="dot"></span>
                            <hr class="flex-fill track-line"><span class="dot"></span>
                            <hr class="flex-fill track-line"><span class="dot"></span>
                            <hr class="flex-fill track-line"><span class="dot"></span>
                            <hr class="flex-fill track-line"><span class="d-flex justify-content-center align-items-center big-dot dot">
                                <i class="text-white fa fa-check"></i></span>
                        </div>

                        <div class="flex-row d-flex justify-content-between align-items-center">
                            <div class="d-flex flex-column align-items-start"><span>{{ date_format($order->created_at, "d/y/m")}}</span><span>Order placed</span>
                            </div>
                     
                            @if($order->status == 'delivered')
                            <div class="d-flex flex-column align-items-end"><span>{{ date_format($order->updated_at, "d/y/m")}} </span><span>Delivered</span></div>
                            @else
                            <div class="d-flex flex-column align-items-end"><span>{{ date_format($order->updated_at, "d/y/m")}} </span><span>Out for
                                    delivery</span></div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
