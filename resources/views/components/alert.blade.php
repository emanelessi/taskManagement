@if ($type === 'success' && $message)
    <div id="success-alert"
         class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
         role="alert">
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline">{{ $message }}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer"
              onclick="document.getElementById('success-alert').style.display='none'">
            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 20 20">
                <path
                    d="M14.348 5.652a1 1 0 111.414 1.414l-7 7a1 1 0 01-1.414 0l-3.5-3.5a1 1 0 111.414-1.414l2.793 2.793 6.293-6.293z"/>
            </svg>
        </span>
    </div>
@endif

@if ($type === 'error' && count($errors) > 0)
    <div id="error-alert" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
         role="alert">
        <strong class="font-bold">Error!</strong>
        <ul>
            @foreach ($errors as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer"
              onclick="document.getElementById('error-alert').style.display='none'">
            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 20 20">
                <path
                    d="M5.293 4.293a1 1 0 011.414 0L10 8.586l3.293-4.293a1 1 0 011.414 1.414L11.414 10l3.293 3.293a1 1 0 01-1.414 1.414L10 11.414l-3.293 3.293a1 1 0 01-1.414-1.414L8.586 10 5.293 6.707a1 1 0 010-1.414z"/>
            </svg>
        </span>
    </div>
@endif
