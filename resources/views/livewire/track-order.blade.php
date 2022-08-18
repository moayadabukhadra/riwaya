<div>
    @if($orders->isEmpty())
    <div class="text-center" style="height:60vh; margin-top:30vh ; ">
        <h1>
            You have no orders yet.
        </h1>

        <a href="/dashboard" class="btn btn-primary">
            Shop Now
        </a>
    </div>
    @else

    @if($show)
    <x-track-order-details :order="$order" wire="all" :items="$selectedOrderItems" />
    @else

    @foreach($orders as $order)
    <x-cards.track-order-card :order="$order" wire="showOrder({{ $order->id }})" />
    @endforeach

    @endif
    @endif


</div>
