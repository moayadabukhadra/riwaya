<div>

    <a data-toggle="modal" data-target="#emptyCartModal">
        <div class="py-3 text-sm font-semibold text-center text-white uppercase bg-indigo-500 xl:w-full hover:bg-indigo-600">Checkout</div>
    </a>
    <div wire:ignore.self class="modal fade" id="emptyCartModal" tabindex="-1" role="dialog" aria-labelledby="emptyCartModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="emptyCartModal">السلة فارغة</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    اضف اكتر من صنف
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">اغلق</button>
                    <a href="/dashboard" class="btn btn-primary">حسنا</a>
                </div>
            </div>
        </div>
    </div>
</div>
