<section class="text-center text-lg-start ">
    <style>
        .cascading-right {
            margin-right: -50px;
        }

        @media (max-width: 991.98px) {
            .cascading-right {
                margin-right: 0;
            }
        }
    </style>


    <div class="container flex justify-center py-4 mt-20">
        <div class="row">

            <div class="row g-0 align-items-center">
                <div class="mb-5 col-lg-6 mb-lg-0">
                    <div class="card cascading-right" style="
            background: hsla(0, 0%, 100%, 0.55);
            backdrop-filter: blur(30px);
            ">
                        <div class="p-5 text-center card-body shadow-5">
                            <x-session-message />

                            @if ($registerForm)
                            <form>
                                <div class="mb-4 form-outline">
                                    <div class="form-outline">
                                        <label class="form-label" for="form3Example1">Name</label>

                                        <input type="text" wire:model="name" class="form-control" />
                                        @error('name') <span class="text-danger error">{{ $message }}</span>@enderror

                                    </div>
                                </div>
                                <!-- Email input -->
                                <div class="mb-4 form-outline">
                                    <label class="form-label">Email address</label>

                                    <input type="email" wire:model="email" class="form-control" />
                                    @error('email') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <!-- Password input -->
                                <div class="mb-4 form-outline">
                                    <label class="form-label">Password</label>

                                    <input type="password" wire:model="password" class="form-control" />
                                    @error('password') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>



                                <!-- Submit button -->
                                <button type="submit" class="mb-4 btn btn-primary btn-block" wire:click.prevent="store">
                                    Sign up
                                </button>


                                <div class="col-md-12">
                                    Already have acoount? <a class="text-white btn btn-primary" wire:click.prevent="register"><strong>Login</strong></a>
                                </div>
                            </form>
                            @else
                            <form>


                                <!-- Email input -->
                                <div class="mb-4 form-outline">
                                    <label class="form-label" for="form3Example3">Email address</label>

                                    <input type="email" id="form3Example3" class="form-control" wire:model="email" />
                                    @error('email') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>

                                <!-- Password input -->
                                <div class="mb-4 form-outline">
                                    <label class="form-label" for="form3Example4">Password</label>

                                    <input type="password" id="form3Example4" class="form-control" wire:model="password" />
                                    @error('password') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>



                                <!-- Submit button -->
                                <button type="submit" class="mb-4 btn btn-primary btn-block" wire:click.prevent="login">
                                    Sign in
                                </button>
                                <div class="col-md-12">
                                    Don't have account? <a class="text-white btn btn-primary" wire:click.prevent="register"><strong>Register Here</strong></a>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="mb-5 col-lg-6 mb-lg-0">
                    <img src="{{ asset('images/riwaya.jpg') }}" class="mb-16 border-2 rounded-lg w-100 shadow-4 " alt="" />
                </div>
            </div>
        </div>
    </div>
</section>
