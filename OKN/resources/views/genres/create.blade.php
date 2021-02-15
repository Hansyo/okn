<html>
<body>
Hello.
<form method="POST" action="/genres">
@csrf
<label>name</label><input id="name" type="text" name="name" /><br>
<label>memo</label><input id="memo" type="text" name="memo" /><br>
<button type="submit"> 登録 </button>
</form>
</body>
</html>
