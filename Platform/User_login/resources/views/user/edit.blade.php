<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="/user/{{ Auth::id() }}">
    @csrf
    @method('PUT')
        old password: <input type="text" id="oldPass" name="oldPass"><br>
        new password: <input type="text" id="newPass" name="newPass"><br>
        confirm new password: <input type="text" id="newPassConfirm" name="newPassConfirm"><br>

        <button type="submit">ok</button>
    </form>
</body>
</html>