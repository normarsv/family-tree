@php
    $image = get_field('invite_friend_image','option');
    $title = get_field('invite_friend_title','option');
    $text = get_field('invite_friend_text','option');
@endphp
<div class="fixed z-10 inset-0 overflow-y-auto opacity-0 gt-modal" style="display: none" aria-labelledby="invite-modal"
     role="dialog" aria-modal="true" id="invite-friend-modal">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 md:pb-20 text-center sm:block sm:p-0">

        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-bottom bg-white shadow-accent rounded text-left overflow-hidden transform transition-all sm:my-8 sm:align-middle sm:max-w-900 sm:w-full relative">
            <button type="button" id="gt-close-modal" class="mt-3 absolute top-0 right-3" aria-label="Close modal">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <div class="bg-white p-10 flex flex-row">
                <div class="text-center w-full md:w-1/2 md:pr-10">
                    <h3 class="text-2xl font-semibold" id="invite-modal">
                        {{$title}}
                    </h3>
                    <p class="mt-5">
                        {{$text}}
                    </p>
                    <p class="form-error hidden pr-4 mt-4 pt-2 text-sm text-red-500"></p>
                    <input type="text" name="email" class="rounded mt-5 w-full" aria-label="Change your email"
                           placeholder="Email Address" required/>
                    <span class="text-xs text-center">Use commas to add multiple addresses.</span>

                    <textarea class="w-full rounded mt-5" name="body" id="" rows="8" aria-label="message copy">Hi!&#013;I joined Girl Talk, a safe space for women to give and get advice, and I thought you would love it, too!&#013;&#013;https://www.weneedtogirltalk.com/&#013;&#013;See you there!</textarea>
                    <button type="submit"
                            id="invite-friend-submit"
                            data-url="{{admin_url('admin-ajax.php')}}"
                            class="bg-white mt-10 w-72 m-auto block px-4 py-2 font-semibold w-full rounded border border-gray-500 disabled:opacity-40">
                        Send Email
                    </button>
                </div>

                <img class="w-1/2 hidden md:block" src="{{$image['sizes']['large']}}" alt="" aria-hidden="true">
            </div>
        </div>
    </div>
</div>
