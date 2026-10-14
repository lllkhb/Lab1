@extends('layouts.app')
@section('title', 'Дані пасажира')
@section('content')
    <h1>Оформлення авіаквитка</h1>
    <p>Будь ласка, заповніть дані пасажира латиницею</p>
    <form method="POST" action="{{ route('entry.store')}}">
        @csrf
        <fieldset style="margin-bottom: 20px; padding: 15px;">
            <legend><strong>Особисті дані пасажира</strong></legend>

            <div style="margin-bottom: 12px;">
                <label for="last_name">Прізвище</label><br>
                <input
                    type="text"
                    id="last_name"
                    name="last_name"
                    placeholder="Наприклад: SYDORUK"
                    value="{{ old('last_name') }}"
                >
                @error('last_name')
                <p class="error" style="color: red; margin: 4px 0;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom: 12px;">
                <label for="first_name">Ім'я</label><br>
                <input
                    type="text"
                    id="first_name"
                    name="first_name"
                    placeholder="Наприклад: OLHA"
                    value="{{ old('first_name') }}"
                >
                @error('first_name')
                <p class="error" style="color: red; margin: 4px 0;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom: 12px;">
                <label for="birth_date">Дата народження</label><br>
                <input
                    type="date"
                    id="birth_date"
                    name="birth_date"
                    value="{{ old('birth_date') }}"
                >
                @error('birth_date')
                <p class="error" style="color: red; margin: 4px 0;">{{ $message }}</p>
                @enderror
            </div>
        </fieldset>

        <fieldset style="margin-bottom: 20px; padding: 15px;">
            <legend><strong>Паспортні дані</strong></legend>

            <div style="margin-bottom: 12px;">
                <label for="citizenship">Громадянство</label><br>
                <select id="citizenship" name="citizenship">
                    <option value="">-- Оберіть країну --</option>
                    <option value="Україна" {{ old('citizenship') == 'Україна' ? 'selected' : '' }}>Україна</option>
                    <option value="Польща" {{ old('citizenship') == 'Польща' ? 'selected' : '' }}>Польща</option>
                    <option value="Німеччина" {{ old('citizenship') == 'Німеччина' ? 'selected' : '' }}>Німеччина</option>
                    <option value="США" {{ old('citizenship') == 'США' ? 'selected' : '' }}>США</option>
                    <option value="Інше" {{ old('citizenship') == 'Інше' ? 'selected' : '' }}>Інша країна</option>
                </select>
                @error('citizenship')
                <p class="error" style="color: red; margin: 4px 0;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom: 12px;">
                <label for="passport_number">Серія та номер паспорта</label><br>
                <input
                    type="text"
                    id="passport_number"
                    name="passport_number"
                    placeholder="Наприклад: FE123456"
                    value="{{ old('passport_number') }}"
                >
                @error('passport_number')
                <p class="error" style="color: red; margin: 4px 0;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom: 12px;">
                <label for="passport_expiry">Термін дії паспорта</label><br>
                <input
                    type="date"
                    id="passport_expiry"
                    name="passport_expiry"
                    value="{{ old('passport_expiry') }}"
                >
                @error('passport_expiry')
                <p class="error" style="color: red; margin: 4px 0;">{{ $message }}</p>
                @enderror
            </div>
        </fieldset>

        <fieldset style="margin-bottom: 20px; padding: 15px;">
            <legend><strong>Контактні дані та багаж</strong></legend>

            <div style="margin-bottom: 12px;">
                <label for="email">Email</label><br>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="passenger@example.com"
                    value="{{ old('email') }}"
                >
                @error('email')
                <p class="error" style="color: red; margin: 4px 0;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom: 12px;">
                <label for="phone">Номер телефону</label><br>
                <input
                    type="tel"
                    id="phone"
                    name="phone"
                    placeholder="+380 99 123 45 67"
                    value="{{ old('phone') }}"
                >
                @error('phone')
                <p class="error" style="color: red; margin: 4px 0;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom: 12px;">
                <label for="baggage">Оберіть норму багажу</label><br>
                <select id="baggage" name="baggage">
                    <option value="hand_only" {{ old('baggage') == 'hand_only' ? 'selected' : '' }}>
                        Тільки ручна поклажа (до 7 кг) — Безкоштовно
                    </option>
                    <option value="baggage_20kg" {{ old('baggage') == 'baggage_20kg' ? 'selected' : '' }}>
                        Зареєстрований багаж до 20 кг (+1200 грн)
                    </option>
                    <option value="baggage_32kg" {{ old('baggage') == 'baggage_32kg' ? 'selected' : '' }}>
                        Зареєстрований багаж до 32 кг (+2000 грн)
                    </option>
                </select>
                @error('baggage')
                <p class="error" style="color: red; margin: 4px 0;">{{ $message }}</p>
                @enderror
            </div>
            <div style="margin-bottom: 12px;">
                <label for="comment">Коментар або додаткові побажання</label><br>
                <textarea
                    id="comment"
                    name="comment"
                    rows="4"
                    cols="50"
                    placeholder="Наприклад: місце біля вікна, переліт із домашньою твариною..."
                >{{ old('comment') }}</textarea>
                @error('comment')
                <p class="error" style="color: red; margin: 4px 0;">{{ $message }}</p>
                @enderror
            </div>
        </fieldset>
        <button type="submit">Надіслати</button>
    </form>
@endsection
