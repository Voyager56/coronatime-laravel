<div id="dropdown" {{ $attributes->merge(['class' => 'relative cursor-pointer']) }}>
    {{ __(ucfirst(app()->getLocale())) }}
    <div id="dropdown-menu" style="display: none;"
        class='absolute top-10 flex flex-col justify-center rounded-xl border bg-green-400 p-3'>
        <a href="{{ route('lang', 'en') }}" id='en' class="text-center text-white hover:text-blue-400">
            English
        </a>
        <a href="{{ route('lang', 'ka') }}" id='ka' class="text-center text-white hover:text-blue-400">
            ქართული
        </a>
    </div>
</div>

<script>
    let dropdown = document.getElementById('dropdown');
    let dropdownMenu = document.getElementById('dropdown-menu');

    dropdown.addEventListener('click', function() {
        dropdownMenu.style.display = dropdownMenu.style.display === 'flex' ? 'none' : 'flex';
    });

    document.addEventListener('click', function(event) {
        if (dropdownMenu.style.display === 'flex') {
            if (!event.target.matches('#dropdown, #dropdown *')) {
                dropdownMenu.style.display = 'none';
            }
        }
    });
</script>
