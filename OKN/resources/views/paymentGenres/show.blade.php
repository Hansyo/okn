@extends('home')
@section('content')
<div class="body-main">
    <table border="1">
    <tr><td>name  </td><td>{{ $item->name }}  </td></tr>
    <tr><td>memo  </td><td>{{ $item->memo }}  </td></tr>
    <tr><td>parent</td><td>
    @if($item->parent)<a href="{{ route('paymentGenres.show', $item->parent) }}">{{ $item->parent }}</a>@endif
</td></tr>
    <tr><td>child </td><td>@foreach ($childs as $child)
    <a href="{{ route('paymentGenres.show', $child) }}">{{ $child }}</a>
    @endforeach </td></tr>
</table>
<button type="button" onclick="location.href='{{ route('paymentGenres.edit', $item->id) }}'"> Edit </button>
{{-- 削除用コード --}}
<form id="delete" name="delete" method="POST" action="{{ route('paymentGenres.destroy', $item->id) }}">
@csrf
@method('DELETE')
<input type="button" onclick="((e)=>{if(window.confirm('本当に消す？')){document.delete.submit();}else{window.alert('キャンセルしました');}})()" value="削除">
</div>
@endsection
