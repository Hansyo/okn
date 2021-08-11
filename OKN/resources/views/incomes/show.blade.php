@extends('base')
@section('main-section')
<div class="body-main">
    <table border="1">
    <tr><td>date  </td><td>{{ $item->date }}  </td></tr>
    <tr><td>amount  </td><td>{{ $item->amount }}  </td></tr>
    <tr><td>genre  </td><td>@if($item->incomeGenre)<a href="{{ route('incomeGenres.show', $item->incomeGenre) }}">{{ $item->incomeGenre }}</a>@endif</td></tr>
    <tr><td>payment  </td><td>@if($item->payment)<a href="{{ route('payments.show', $item->payment) }}">{{ $item->payment }}</a>@endif</td></tr>
    <tr><td>memo  </td><td>{{ $item->memo }}</td></tr>
</table>
<button type="button" onclick="location.href='{{ route('incomes.edit', $item->id) }}'"> Edit </button>
{{-- 削除用コード --}}
<form id="delete" name="delete" method="POST" action="{{ route('incomes.destroy', $item->id) }}">
@csrf
@method('DELETE')
<input type="button" onclick="((e)=>{if(window.confirm('本当に消す？')){document.delete.submit();}else{window.alert('キャンセルしました');}})()" value="削除">
</div>
@endsection
