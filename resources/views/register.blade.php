<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>
<body>
<form action="{{url('/register')}}" method="post">
    @csrf
    <input type="text" name="username" placeholder="username" required>
    <input type="text" name="name" placeholder="name">
    <input type="text" name="email" placeholder="email">
    <input type="tel" name="phone" placeholder="phone number">
    <input type="password" name="password" placeholder="password" required>
    <input type="submit" value="submit">
</form>
</body>
</html>
