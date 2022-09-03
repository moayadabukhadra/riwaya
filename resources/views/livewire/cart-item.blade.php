<div class="ibox-content">
    <div class="table-responsive">
        <table class="table shoping-cart-table">
            <tbody>
                <tr>

                    <td width="90">
                        <div class="cart-product-imitation">
                            <img src="{{$item['attributes']['image']}}"
                        </div>
                    </td>
                    <td class="desc">
                        <h3>
                            <a href="#" class="text-navy">
                                {{ $item['name']}}
                            </a>
                        </h3>
                        

                        <div class="m-t-sm">

                            <a href="#" class="text-muted" wire:click.prevent="removeCart('{{$item['id']}}')"><i class="fa fa-trash"></i> Remove item</a>
                        </div>
                    </td>

                    <td>
                        {{ $item['price']}}jd
                        <s class="small text-muted"> </s>
                    </td>
                    <td width="65">
                        <input type="number" class="w-12 " wire:model="quantity" type="number" min="1" max="100" wire:change="updateCart" value="{{ $item['quantity']}}" placeholder="{{ $item['quantity']}}">
                    </td>
                    <td>
                        <h4>
                        {{ $item['price'] * $item['quantity']}}jd
                        </h4>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
