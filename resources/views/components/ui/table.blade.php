@props(['columns'])

<div class="table-wrapper">
    <table {{ $attributes->merge(['class' => 'table']) }}>
        <thead>
            <tr>
                @foreach($columns as $column)
                    <th>{{ $column }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            {{ $slot }}
        </tbody>
    </table>
</div>
