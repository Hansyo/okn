@extends('home')
@section('content')
<div class="body-main">
    <table border="1">
    <tr><td>purchase  </td><td>{{ $item->purchase }}  </td></tr>
    <tr><td>amount  </td><td>{{ $item->amount }}  </td></tr>
    <tr><td>genre  </td><td><a href="{{ route('genres.show', $item->genre_id) }}">{{ $item->genre_id }}</a></td></tr>
{{--
    <tr><td>store  </td><td><a href="{{ route('stores.show', $item->store_id) }}">{{ $item->store_id }}</a></td></tr>
    <tr><td>payment  </td><td><a href="{{ route('payments.show', $item->payment_id) }}">{{ $item->payment_id }}</a></td></tr>
    <tr><td>Credit History  </td><td><a href="{{ route('creditHistories.show', $item->creditHisory_id) }}">{{ $item->creditHistory_id }}</a></td></tr>
--}}
    <tr><td>memo  </td><td>{{ $item->memo }}</td></tr>
</table>
<button type="button" onclick="location.href='{{ route('receipts.edit', $item->id) }}'"> Edit </button>
{{-- 削除用コード --}}
<form id="delete" name="delete" method="POST" action="{{ route('receipts.destroy', $item->id) }}">
@csrf
@method('DELETE')
<input type="button" onclick="((e)=>{if(window.confirm('本当に消す？')){document.delete.submit();}else{window.alert('キャンセルしました');}})()" value="削除">
</div>
@endsection
