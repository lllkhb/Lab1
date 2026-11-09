@php
    $enTranslation = isset($flight) ? $flight->translations->firstWhere('locale', 'en') : null;
@endphp

<fieldset style="margin-bottom: 15px; padding: 10px; border: 1px solid #ccc;">
    <legend><strong>Основна мова (Українська — обов'язково)</strong></legend>
    <div>
        <label for="departure_airport">Аеропорт вильоту (UK)</label>
        <input id="departure_airport" name="departure_airport" type="text" maxlength="150"
               placeholder="Наприклад: Бориспіль"
               value="{{ old('departure_airport', $flight->departure_airport ?? '') }}">
        @error('departure_airport')
        <p class="error" style="color: red;">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label for="arrival_airport">Аеропорт прибуття (UK)</label>
        <input id="arrival_airport" name="arrival_airport" type="text" maxlength="150"
               placeholder="Наприклад: Шопен"
               value="{{ old('arrival_airport', $flight->arrival_airport ?? '') }}">
        @error('arrival_airport')
        <p class="error" style="color: red;">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label for="aircraft_model">Модель літака (UK)</label>
        <input id="aircraft_model" name="aircraft_model" type="text" maxlength="100"
               placeholder="Наприклад: Боїнг 737-800"
               value="{{ old('aircraft_model', $flight->aircraft_model ?? '') }}">
        @error('aircraft_model')
        <p class="error" style="color: red;">{{ $message }}</p>
        @enderror
    </div>
</fieldset>

<fieldset style="margin-bottom: 15px; padding: 10px; border: 1px solid #ccc;">
    <legend><strong>Англійський переклад (EN — необов'язково)</strong></legend>
    <div>
        <label for="departure_airport_en">Departure Airport (EN)</label>
        <input id="departure_airport_en" name="departure_airport_en" type="text" maxlength="150"
               placeholder="Наприклад: Boryspil"
               value="{{ old('departure_airport_en', $enTranslation->departure_airport ?? '') }}">
        @error('departure_airport_en')
        <p class="error" style="color: red;">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label for="arrival_airport_en">Arrival Airport (EN)</label>
        <input id="arrival_airport_en" name="arrival_airport_en" type="text" maxlength="150"
               placeholder="Наприклад: Chopin"
               value="{{ old('arrival_airport_en', $enTranslation->arrival_airport ?? '') }}">
        @error('arrival_airport_en')
        <p class="error" style="color: red;">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label for="aircraft_model_en">Aircraft Model (EN)</label>
        <input id="aircraft_model_en" name="aircraft_model_en" type="text" maxlength="100"
               placeholder="Наприклад: Boeing 737-800"
               value="{{ old('aircraft_model_en', $enTranslation->aircraft_model ?? '') }}">
        @error('aircraft_model_en')
        <p class="error" style="color: red;">{{$message}}</p>
        @enderror
    </div>
</fieldset>

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
@php
    $selectedTariffs = old('tariffs', isset($flight) ? $flight->tariffs->pluck('id')->all() : []);
    $priceValues = old('prices', isset($flight)
        ? $flight->tariffs->mapWithKeys(fn ($t) => [$t->id => $t->pivot->price])->all()
        : []);
@endphp

<div style="margin: 15px 0;">
    <label for="tariffs"><strong>Тарифи рейсу</strong></label><br>
    <select id="tariffs" name="tariffs[]" multiple style="width:100%; max-width:500px;">
        @foreach ($tariffs as $tariff)
            <option value="{{ $tariff->id }}" @selected(in_array($tariff->id, $selectedTariffs))>
                {{ $tariff->name }} ({{ $tariff->class_name }}, {{ $tariff->baggage }})
            </option>
        @endforeach
    </select>

    @foreach ($errors->get('tariffs.*') as $messages)
        @foreach ($messages as $message)
            <p class="error" style="color: red;">{{ $message }}</p>
        @endforeach
    @endforeach
    @foreach ($errors->get('prices.*') as $messages)
        @foreach ($messages as $message)
            <p class="error" style="color: red;">{{ $message }}</p>
        @endforeach
    @endforeach

    <div id="price-fields" style="margin-top: 10px;"></div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const prices = @json((object) $priceValues);
            const $select = $('#tariffs').select2({ placeholder: 'Оберіть тарифи', closeOnSelect: false });

            function renderPrices() {
                const $box = $('#price-fields').empty();
                $select.find('option:selected').each(function () {
                    const id = this.value;
                    const name = $(this).text().trim().split(' (')[0];
                    const $label = $('<label style="display:block; margin-bottom:6px;"></label>')
                        .text('Ціна для «' + name + '», грн: ');
                    const $input = $('<input type="number" step="0.01" min="0" required>')
                        .attr('name', 'prices[' + id + ']')
                        .val(prices[id] ?? '');
                    $box.append($label.append($input));
                });
            }

            $select.on('change', function () {
                $('#price-fields input').each(function () {
                    const m = this.name.match(/\[(\d+)\]/);
                    if (m) prices[m[1]] = this.value;
                });
                renderPrices();
            });

            renderPrices();
        });
    </script>
@endpush
