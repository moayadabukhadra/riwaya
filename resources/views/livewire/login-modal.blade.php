<div>

    <div class="flex mt-4">

        <button class="flex px-6 py-2 ml-auto text-white bg-red-500 border-0 rounded focus:outline-none hover:bg-red-600" data-toggle="modal" data-target="#modalLoginForm">Add To Cart</button>
        <button class="inline-flex items-center justify-center w-10 h-10 p-0 ml-4 text-gray-500 bg-gray-200 border-0 rounded-full">
            <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"></path>
            </svg>
        </button>
    </div>

    <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="text-center modal-header">
                    <h4 class="modal-title w-100 font-weight-bold">You Need To be logged in first</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="mx-3 modal-body">
                    <div class="mb-2 md-form">

                        <input class="form-control" wire:model="email">
                        <label data-success="right">Your email</label>
                    </div>

                    <div class="mb-4 md-form">

                        <input class="form-control" wire:model="password">
                        <label data-success="right">Your password</label>
                    </div>

                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button class="bg-blue-400 btn btn-default hover:bg-blue-500" wire:click.prevent="login">Login</button>
                </div>
                <div class="text-center">
                    <p> have account?<a href="/login-register" class="text-blue-500 "><strong>Register</strong></a></p>
                </div>
            </div>
        </div>
    </div>


</div>
