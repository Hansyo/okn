@extends('base')
@section('main-section')
<div class="body-main">
    <table border="1">
    <tr><td>name  </td><td>{{ $item->name }}  </td></tr>
    <tr><td>price  </td><td>{{ $item->price }}  </td></tr>
    <tr><td>memo  </td><td>{{ $item->memo }}  </td></tr>
    <tr><td>genre</td><td>
    @if($item->genre)<a href="{{ route('genres.show', $item->genre) }}">{{ $item->genre }}</a>@endif
</td></tr>
    <tr><td>store</td><td>
    @if($item->store)<a href="{{ route('stores.show', $item->store) }}">{{ $item->store }}</a>@endif
</td></tr>
    <tr><td>payment</td><td>
    @if($item->payment)<a href="{{ route('payments.show', $item->payment) }}">{{ $item->payment }}</a>@endif
</td></tr>
    </table>
<button type="button" onclick="location.href='{{ route('presets.edit', $item->id) }}'"> Edit </button>
{{-- 削除用コード --}}
<form id="delete" name="delete" method="POST" action="{{ route('presets.destroy', $item->id) }}">
@csrf
@method('DELETE')
<input type="button" onclick="((e)=>{if(window.confirm('本当に消す？')){document.delete.submit();}else{window.alert('キャンセルしました');}})()" value="削除">
</div>
@endsection
