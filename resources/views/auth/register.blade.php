@if($errors->any())
    <h3 style="color: red;">Есть ошибки:</h3>
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
<form action="{{ route('register') }}" method="POST">
    @csrf
    <label>
        Имя:
        <input type="text" name="name" value="{{ old('name') }}">
    </label>
    <label>
        Email:
        <input type="text" name="email" value="{{ old('email') }}">
    </label>
    <label>
        Пароль:
        <input type="password" name="password">
    </label>
    <label>
        Подтверждение пароля:
        <input type="password" name="password_confirmation">
    </label>
    <button>Зарегистрироваться</button>
</form>
