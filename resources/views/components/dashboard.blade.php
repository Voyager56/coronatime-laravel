<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <title>Dashboard</title>
</head>
<body>

    <div class="flex items-center justify-between mx-20 my-5">
        <img src="{{asset('images/coronatimelogo.svg')}}" alt="">
        <div class="flex items-center justify-evenly w-[20em]">
            <div id="dropdown" class="cursor-pointer relative">
                {{ucfirst(app()->getLocale())}}
                <div id="dropdown-menu" style="display: none;" class="flex flex-col absolute bg-green-400 p-3 border rounded-xl top-10 right-[-3em] justify-center">
                    <a href="locale/en" id='en' class="hover:text-blue-400 text-white text-center">
                        English
                    </a>
                    <a href="locale/ka" id='ka' class="hover:text-blue-400 text-white text-center" >
                        ქართული
                    </a>
                </div>
            </div>
            <p class="font-bold text-black">
                {{auth()->user()->username}}
            </p>
            <form method="POST" action="/logout">
                @csrf
                <button type="submit" class="bg-green-400 text-white rounded-xl py-2 px-4 hover:bg-red-500">
                    Logout
                </button>
            </form>
        </div>


        
    </div>



    <script>
        let dropdown = document.getElementById('dropdown');
        let dropdownMenu = document.getElementById('dropdown-menu');

        dropdown.addEventListener('click', function() {
            dropdownMenu.style.display =  dropdownMenu.style.display === 'flex'? 'none': 'flex';
        });

    </script>

    
</body>
</html>