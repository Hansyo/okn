@extends('home')
@section('content')
<div class="body-main">
    <table border="1">
    <tr><th>入金日</th><th>支払い方法</th><th>メモ</th></tr>
    @foreach ($items as $income)
    <tr>
<td><a href="{{route('incomes.show', $income->id)}}">{{ $income->amount }}</a></td>
<td><a href="{{route('payments.show', $income->payment)}}">{{ $income->payment }}</a></td>
<td>{{ $income->memo }}</td></tr>
    @endforeach
</table>
<button type="button" onclick="location.href='{{ route('incomes.create') }}'">新規追加</button>
</div>
@endsection
