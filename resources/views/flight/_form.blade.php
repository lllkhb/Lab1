<div>
    <label for="departure_airport">Аеропорт вильоту</label>
    <input id="departure_airport" name="departure_airport" type="text" maxlength="150"
           placeholder="Наприклад: Бориспіль"
           value="{{ old('departure_airport', $flight->departure_airport ?? '') }}">
    @error('departure_airport')
    <p class="error" style="color: red;">{{ $message }}</p>
    @enderror
</div>
<div>
    <label for="arrival_airport">Аеропорт прибуття</label>
    <input id="arrival_airport" name="arrival_airport" type="text" maxlength="150"
           placeholder="Наприклад: Шопен"
           value="{{ old('arrival_airport', $flight->arrival_airport ?? '') }}">
    @error('arrival_airport')
    <p class="error" style="color: red;">{{ $message }}</p>
    @enderror
</div>
<div>
    <label for="aircraft_model">Модель літака</label>
    <input id="aircraft_model" name="aircraft_model" type="text" maxlength="100"
           placeholder="Наприклад: Boeing 737-800"
           value="{{ old('aircraft_model', $flight->aircraft_model ?? '') }}">
    @error('aircraft_model')
    <p class="error" style="color: red;">{{ $message }}</p>
    @enderror
</div>
<div>
    <label for="departure_date">Дата вильоту</label>
    <input id="departure_date" name="departure_date" type="date"
           value="{{ old('departure_date', isset($flight) ? $flight->departure_date->format('Y-m-d') : '') }}">
    @error('departure_date')
    <p class="error" style="color: red;">{{ $message }}</p>
    @enderror
</div>
<div>
    <label for="departure_time">Час вильоту</label>
    <input id="departure_time" name="departure_time" type="time"
           value="{{ old('departure_time', isset($flight) ? substr($flight->departure_time, 0, 5) : '') }}">
    @error('departure_time')
    <p class="error" style="color: red;">{{ $message }}</p>
    @enderror
</div>
<div>
    <label for="arrival_date">Дата прибуття</label>
    <input id="arrival_date" name="arrival_date" type="date"
           value="{{ old('arrival_date', isset($flight) ? $flight->arrival_date->format('Y-m-d') : '') }}">
    @error('arrival_date')
    <p class="error" style="color: red;">{{ $message }}</p>
    @enderror
</div>
<div>
    <label for="arrival_time">Час прибуття</label>
    <input id="arrival_time" name="arrival_time" type="time"
           value="{{ old('arrival_time', isset($flight) ? substr($flight->arrival_time, 0, 5) : '') }}">
    @error('arrival_time')
    <p class="error" style="color: red;">{{ $message }}</p>
    @enderror
</div>
