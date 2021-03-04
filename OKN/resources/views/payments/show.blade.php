@extends('home')
@section('content')
<div class="body-main">
    <table border="1">
    <tr><td>name  </td><td>{{ $item->name }}  </td></tr>
    <tr><td>credit  </td><td>@if($credit){{ $credit->credit }}@else 記録なし @endif</td></tr>
    <tr><td>memo  </td><td>{{ $item->memo }}  </td></tr>
    <tr><td>Genre</td><td>
    @if($item->paymentGenre)<a href="{{ route('paymentGenres.show', $item->paymentGenre) }}">{{ $item->paymentGenre }}</a>@endif
</td></tr>
</table>
<button type="button" onclick="location.href='{{ route('payments.edit', $item->id) }}'"> Edit </button>
{{-- 削除用コード --}}
<form id="delete" name="delete" method="POST" action="{{ route('payments.destroy', $item->id) }}">
@csrf
@method('DELETE')
<input type="button" onclick="((e)=>{if(window.confirm('本当に消す？')){document.delete.submit();}else{window.alert('キャンセルしました');}})()" value="削除">
</div>
@endsection
