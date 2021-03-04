@extends('home')
@section('content')
<div class="body-main">
    <table border="1">
    <tr><td>date  </td><td>{{ $item->date }}  </td></tr>
    <tr><td>amount  </td><td>{{ $item->amount }}  </td></tr>
    <tr><td>credit</td><td>
    @if($item->credit)<a href="{{ route('credits.show', $item->credit) }}">{{ $item->credit }}</a>@endif
</td></tr>
    <tr><td>memo  </td><td>{{ $item->memo }}  </td></tr>
</table>
<button type="button" onclick="location.href='{{ route('payments.edit', $item->id) }}'"> Edit </button>
</div>
@endsection
