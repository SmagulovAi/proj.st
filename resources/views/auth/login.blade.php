@if($errors->any())
    <h3 style="color: red;">Есть ошибки:</h3>
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
<form action="{{ route('login') }}" method="POST">
    @csrf
    <label>
        Email:
        <input type="text" name="email" value="{{ old('email') }}">
        @error('email')
            {{ $message }}
        @enderror
    </label>
    <label>
        Пароль:
        <input type="password" name="password">
    </label>
    <label>
        <input type="checkbox" name="remember">
        запомнить меня
    </label>
    <button>Войти</button>
</form>