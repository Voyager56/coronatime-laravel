@extends('components.dashboard')
@section('content')
    @php
    $lang = app()->getlocale();
    @endphp

    <div class="ml-5 pb-10 md:ml-[8rem]">
        <h1 class="mt-20 text-4xl font-bold">{{ __('country') . ' ' . __('statistics') }}</h1>
        <x-dashboardrouting class="pt-5" active="country" />
    </div>
    <div class="px-5 md:px-[8rem]">


        <form action="{{ route('show') }}" method="GET">
            <input class="mb-5 rounded-xl border border-gray-400 p-3" type="text" name="search"
                placeholder="🔍 {{ __('search') }}" required />
            <button class="hidden" type="submit"></button>
        </form>



        <table class="w-full rounded-xl text-left">
            <thead class="flex w-full rounded-xl bg-gray-200 text-black">
                <tr class="mb-4 flex w-full">
                    <th class="flex w-1/4 items-center justify-center md:p-4" id="location" data-asc=false>
                        {{ __('location') }}
                        <x-arrows />
                    </th>
                    <th class="flex w-1/4 items-center justify-center md:p-4" id="newcases" data-asc=false>
                        {{ __('new-cases') }}
                        <x-arrows />

                    </th>
                    <th class="flex w-1/4 items-center justify-center md:p-4" id="deaths" data-asc=false>
                        {{ __('deaths') }}
                        <x-arrows />

                    </th>
                    <th class="flex w-1/4 items-center justify-center md:p-4" id="recovered" data-asc=false>
                        {{ __('recovered') }}
                        <x-arrows />
                    </th>
                </tr>
            </thead>
            <tbody class="bg-grey-light flex h-[30rem] w-full flex-col items-center justify-between overflow-y-scroll">
                @foreach ($countries as $country)
                    <tr class="mb-4 flex w-full" id='data_table'>
                        <td class="w-1/4 p-4" id="location-table"> {{ $country->$lang }}
                        </td>
                        <td class="w-1/4 p-4" id="newcases-table"> {{ $country->statistics->confirmed }}
                        </td>
                        <td class="w-1/4 p-4" id="deaths-table"> {{ $country->statistics->deaths }}
                        </td>
                        <td class="w-1/4 p-4" id="recovered-table"> {{ $country->statistics->recovered }}
                        </td>
                    </tr>
                @endforeach
            </tbody>

    </div>


    <script>
        // get tableRow and the index of tableHead and return child of tableRow with the index 
        const getText = (tableRow, index) => tableRow.children[index].innerText || tableRow.children[index].textContent;


        //get tableHead's index and sort direction -> call function with to tableRows and compare their children with tableHeads index
        const sortingFunc = (index, asc) => (tableRowA, tableRowB) => ((textA, textB) =>
            textA !== '' && textB !== '' && !isNaN(textA) && !isNaN(textB) ? textA - textB : textA.toString()
            .localeCompare(textB)
        )(getText(asc ? tableRowA : tableRowB, index), getText(asc ? tableRowB : tableRowA, index));

        document.querySelectorAll('th').forEach(tableHead => tableHead.addEventListener('click', (() => {
            // get table and arrows
            const table = tableHead.closest('table');
            let arrows = tableHead.querySelector('#arrows');

            // select all tableRows and sort all it schildren on place of tableHeads index
            Array.from(table.querySelectorAll('#data_table'))
                .sort(sortingFunc(Array.from(tableHead.parentNode.children).indexOf(tableHead),
                    // if tableHead has data-attribute of asc -> sort in ascending order else sort in descending order
                    tableHead.dataset.asc === "false" ? tableHead.dataset.asc = true : tableHead.dataset
                    .asc = false))
                .forEach(tabkeRow => {
                    // re-render table
                    document.querySelector('tbody').appendChild(tabkeRow);
                    // rotate arrows for good illusion ;)
                    arrows.style.transform =
                        `rotate(${tableHead.dataset.asc === "false" ? '0' : '180'}deg)`;
                });
        })));
    </script>
@endsection
