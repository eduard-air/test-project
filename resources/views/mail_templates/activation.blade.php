<!DOCTYPE html>
<html>
<body>

<h1>Hello {{ $data->name }}</h1>
<p>
	Your temporary password: {{ $data->temp_password }}
</p>
<p>
	Your activation <a href="{{ route('profile.activation', ['token'=> $data->activation_token, 'user' => $data->id ]) }}">link</a>
</p>

</body>
</html>