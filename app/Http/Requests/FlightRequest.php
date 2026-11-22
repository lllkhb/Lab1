<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FlightRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    // Приводимо коди до верхнього регістру до валідації
    protected function prepareForValidation(): void
    {
        $this->merge([
            'departure_airport' => trim((string) $this->departure_airport),
            'arrival_airport'   => trim((string) $this->arrival_airport),
        ]);
    }
    public function rules(): array
    {
        $rules = [
            'departure_airport' => ['required', 'string', 'min:3', 'max:150'],
            'arrival_airport'   => ['required', 'string', 'min:3', 'max:150', 'different:departure_airport'],
            'aircraft_model'    => ['required', 'string', 'max:100'],
            'departure_date'    => ['required', 'date'],
            'departure_time'    => ['required', 'date_format:H:i'],
            'arrival_date'      => ['required', 'date', 'after_or_equal:departure_date'],
            'arrival_time'      => ['required', 'date_format:H:i'],

            'departure_airport_en' => ['nullable', 'string', 'min:3', 'max:150'],
            'arrival_airport_en'   => ['nullable', 'string', 'min:3', 'max:150'],
            'aircraft_model_en'    => ['nullable', 'string', 'max:100'],

            'tariffs'   => ['nullable', 'array'],
            'tariffs.*' => ['integer', 'distinct', 'exists:tariffs,id'],
        ];
        // Ціна обов'язкова для кожного обраного тарифу
        foreach ((array) $this->input('tariffs', []) as $id) {
            $rules["prices.$id"] = ['required', 'numeric', 'min:0', 'max:99999999.99'];
        }

        return $rules;
    }

    public function attributes(): array
    {
        return [
            'departure_airport' => 'аеропорт вильоту',
            'arrival_airport'   => 'аеропорт прибуття',
            'aircraft_model'    => 'модель літака',
            'departure_date'    => 'дата вильоту',
            'departure_time'    => 'час вильоту',
            'arrival_date'      => 'дата прибуття',
            'arrival_time'      => 'час прибуття',
        ];
    }

    public function messages(): array
    {
        return [
            'arrival_airport.different'   => 'Аеропорт прибуття має відрізнятися від аеропорту вильоту.',
            'arrival_date.after_or_equal' => 'Дата прибуття не може бути раніше за дату вильоту.',

            'tariffs.array'      => 'Некоректний формат списку тарифів.',
            'tariffs.*.integer'  => 'Некоректний тариф.',
            'tariffs.*.exists'   => 'Обрано неіснуючий тариф.',
            'tariffs.*.distinct' => 'Тариф вказано більше одного разу.',
            'prices.*.required'  => 'Вкажіть ціну для кожного обраного тарифу.',
            'prices.*.numeric'   => 'Ціна має бути числом.',
            'prices.*.min'       => 'Ціна не може бути від’ємною.',
            'prices.*.max'       => 'Ціна завелика.',
        ];
    }
}
