@props(['book','wire'])

<div tabindex="0" class="mx-2 mb-8 focus:outline-none w-72 xl:mb-0">
                        <div>
                            <img alt="person capturing an image" src="{{ asset('storage/'.$book->image) }}" tabindex="0" class="w-full focus:outline-none h-44" />
                        </div>
                        <div class="bg-white dark:bg-gray-800">
                            <div class="flex items-center justify-between px-4 pt-4">
                                <div>
                                    <img class="dark:bg-white focus:outline-none " src="https://tuk-cdn.s3.amazonaws.com/can-uploader/4-by-2-col-grid-svg1.svg" alt="bookmark" />
                                </div>
                                <div class="bg-yellow-200 py-1.5 px-6 rounded-full">
                                    <button wire:click.prevent="{{ $wire }}"><p tabindex="0" class="text-xs text-yellow-700 focus:outline-none">Read more</p></button>
                                </div>
                            </div>
                            <div class="p-4">
                                <div class="flex items-center">
                                    <h2 tabindex="0" class="text-lg font-semibold focus:outline-none dark:text-white">{{ $book->title }}</h2>

                                </div>
                                <p tabindex="0" class="mt-2 text-xs text-gray-600 focus:outline-none dark:text-gray-200"></p>
                                <div class="flex mt-4">
                                    <div>
                                        <p tabindex="0" class="px-2 py-1 text-xs text-gray-600 bg-gray-200 focus:outline-none dark:text-gray-200 dark:bg-gray-700">12 months warranty</p>
                                    </div>
                                    <div class="pl-2">
                                        <p tabindex="0" class="px-2 py-1 text-xs text-gray-600 bg-gray-200 focus:outline-none dark:text-gray-200 dark:bg-gray-700">Complete box</p>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between py-4">
                                    <h2 tabindex="0" class="text-xs font-semibold text-indigo-700 focus:outline-none">{{ $book->author}}</h2>
                                    <h3 tabindex="0" class="text-xl font-semibold text-indigo-700 focus:outline-none">{{ $book->price }}jd</h3>
                                </div>
                            </div>
                        </div>
                    </div>
