<x-guest-layout>
    <div class=" sm:px-6 lg:px-8">
        <div class="flex bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="basis-1/2 p-2 bg-white border-b border-gray-200">
                <div class="p-2">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if ($message = Session::get('errorsCreate'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                </div>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @else

                <form method="POST" action="/entry">
                    @csrf

                    <div class="p-2 flex items-center">
                        <input id="title" name="title" type="text"
                               placeholder="Title"
                               class="rounded-md border-gray-300 hover:border-gray-600 flex-1 @error('title') is-invalid @enderror"
                        >
                    </div>

                    <div class="p-2 flex items-center">
                        <input id="body" name="body" type="text"
                               placeholder="body"
                               class="rounded-md border-gray-300 hover:border-gray-600 flex-1 @error('body') is-invalid @enderror">
                    </div>

                    <div class="m-2">
                        <x-primary-button class="ml-3">
                            Submit
                        </x-primary-button>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</x-guest-layout>
