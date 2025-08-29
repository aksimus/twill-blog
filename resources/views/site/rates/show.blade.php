@extends('layouts.blog-layout')

@section('title', __('Exchange Rates for :year Q:quarter', ['year' => $year, 'quarter' => $quarter]))

@section('seo')
{{-- SEO meta tags are now handled by the controller via SeoMetaService --}}
<x-seo-meta />
@endsection

@section('content')
<div class="rates">
    <h4>{{ __('Rates') }}</h4>

    <div class="rates__control">
        <div class="rates__link-list">
            @foreach($navigation['available_years'] as $availableYear)
                <div class="rates__link {{ $availableYear == $year ? 'rates__link--selected' : '' }}">
                    <a href="{{ route('rates.show', ['year' => $availableYear, 'quarter' => $quarter]) }}" class="c-link">{{ $availableYear }}</a>
                </div>
            @endforeach
        </div>
        <div class="rates__link-list">
            @foreach($navigation['quarters'] as $q)
                <div class="rates__link {{ $q == $quarter ? 'rates__link--selected' : '' }}">
                    <a href="{{ route('rates.show', ['year' => $year, 'quarter' => $q]) }}" class="c-link">
                        @switch($q)
                            @case(1)
                                1 ({{ __('January to March') }})
                                @break
                            @case(2)
                                2 ({{ __('April to June') }})
                                @break
                            @case(3)
                                3 ({{ __('July to September') }})
                                @break
                            @case(4)
                                4 ({{ __('October to December') }})
                                @break
                        @endswitch
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <table class="c-table">
        <thead>
            <tr>
                <th class="c-table__th"><span>{{ __('Country') }}</span></th>
                <th class="c-table__th"><span>{{ __('State') }}</span></th>
                <th class="c-table__th"><span>{{ __('Year') }}</span></th>
                <th class="c-table__th"><span>{{ __('Quarter') }}</span></th>
                <th class="c-table__th"><span>{{ __('Rate') }}</span></th>
                <th class="c-table__th"><span>{{ __('Surcharge Rate') }}</span></th>
            </tr>
        </thead>
        <tfoot>
            <tr></tr>
        </tfoot>
        <tbody>
            @if(empty($rateList))
                <tr class="c-table__tdrow c-table__tdrow--striped">
                    <td colspan="6" class="c-table__td text-center">
                        <div class="text-muted">
                            <p>{{ __('No rates available') }}</p>
                            <small>{{ __('Rates are being loaded from external source. Please try again in a moment.') }}</small>
                        </div>
                    </td>
                </tr>
            @else
                @foreach($rateList as $rate)
                    <tr class="c-table__tdrow c-table__tdrow--striped">
                        <td class="c-table__td">{{ $rate['country'] }}</td>
                        <td class="c-table__td">{{ $rate['jurisdiction'] }}</td>
                        <td class="c-table__td">{{ $rate['year'] }}</td>
                        <td class="c-table__td">{{ $rate['quarter'] }}</td>
                        <td class="c-table__td">{{ $rate['value'] }}</td>
                        <td class="c-table__td">{{ $rate['surcharge_value'] }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>

<style lang="scss">
.rates {
    padding: 50px 16px;

    & > * + * {
        margin-top: 16px;
    }
}

.rates__control {
    display: flex;

    & > * + * {
        margin-left: 4px;
    }
}

.rates__link-list {
    display: flex;
    flex-direction: column;

    & > * + * {
        margin-top: 4px;
    }
}

.rates__link {
    padding: 6px 12px;
    border-radius: 3px;

    &:hover {
        cursor: pointer;
        background-color: hsl(0, 0%, 95%);

        .c-link {
            color: hsl(210, 82%, 36%);
        }
    }
}

.rates__link--selected {
    background-color: hsl(0, 0%, 95%);
}

.c-link {
    text-decoration: none;
    color: inherit;
}

.c-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 16px;
}

.c-table__th {
    background-color: hsl(0, 0%, 95%);
    padding: 12px;
    text-align: left;
    font-weight: bold;
    border: 1px solid hsl(0, 0%, 80%);
}

.c-table__td {
    padding: 12px;
    border: 1px solid hsl(0, 0%, 80%);
}

.c-table__tdrow--striped:nth-child(even) {
    background-color: hsl(0, 0%, 98%);
}

@media (min-width: 768px) {
    .rates__control {
        flex-direction: column;

        & > * + * {
            margin-left: 0;
            margin-top: 4px;
        }
    }

    .rates__link-list {
        display: flex;
        flex-direction: row;

        & > * + * {
            margin-top: 0;
            margin-left: 4px;
        }
    }
}
</style>
@endsection
