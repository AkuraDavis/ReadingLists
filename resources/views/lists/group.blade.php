<div class="list-group">
    @if (count($lists) > 0)
        @if(isset($sort))
            @php
                $sort_string = $sort['order'] == "desc" ? 'asc' : 'desc';
                $sort_arrow = $sort['order'] == "desc" ? "&nbsp;<span data-feather=\"chevron-down\"></span>" : "&nbsp;<span data-feather=\"chevron-up\"></span>";
            @endphp
            <div class="btn-group align-middle pb-2">
                <span class="sort-by">Sort By</span>
                <a href="?sort=name&order={{ $sort_string }}" class="btn btn-sm btn{{ ($sort['field'] == 'name') ? null : '-outline'  }}-info">Name{!! ($sort['field'] == 'name') ? $sort_arrow : null !!}</a>
                <a href="?sort=books&order={{ $sort_string }}" class="btn btn-sm btn{{ ($sort['field'] == 'books') ? null : '-outline'  }}-info"># of Books{!! ($sort['field'] == 'books') ? $sort_arrow : null !!}</a>
            </div>
        @endif
        @foreach ($lists as $list)
            <a href="{{ url('/lists/' . $list->id) }}" class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{ $list->name }}</h5>
                    {{ !Request::is('my_lists') ? 'By '.$list->user->name.' - ' : null }} {{ count($list->books) }} books
                </div>
                <p class="mb-1 text-left">{{ $list->desc }}</p>
            </a>
        @endforeach
    @else
        <tr>
            <td>{{ Request::is('my_lists') ? 'You have no lists!' : 'There are no public reading lists.' }}
            </td>
        </tr>
    @endif
</div>