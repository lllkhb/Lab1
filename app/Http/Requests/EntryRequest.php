<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class EntryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name'      => ['required', 'string', 'max:100', 'regex:/^[a-zA-Z\s\-]+$/'],
            'last_name'       => ['required', 'string', 'max:100', 'regex:/^[a-zA-Z\s\-]+$/'],
            'birth_date'      => ['required', 'date', 'before:today'],
            'citizenship'     => ['required', 'string', 'max:100'],
            'passport_number' => ['required', 'string', 'regex:/^[A-Z0-9]{6,12}$/i'],
            'passport_expiry' => ['required', 'date', 'after:today'],
            'email'           => ['required', 'email'],
            'phone'           => ['required', 'string', 'regex:/^\+?[0-9\s\-\(\)]{10,20}$/'],
            'baggage'         => ['required', 'in:hand_only,baggage_20kg,baggage_32kg'],
            'comment'         => ['required', 'string', 'max:500'],
        ];
    }
    public function messages(): array
    {
        return [
            'first_name.required'      => 'Поле «Ім\'я» є обов\'язковим.',
            'first_name.regex'         => 'Ім\'я має містити лише латинські літери.',
            'last_name.required'       => 'Поле «Прізвище» є обов\'язковим.',
            'last_name.regex'          => 'Прізвище має містити лише латинські літери.',
            'birth_date.required'      => 'Вкажіть дату народження.',
            'birth_date.before'        => 'Дата народження має бути в минулому.',
            'citizenship.required'     => 'Вкажіть громадянство пасажира.',
            'passport_number.required' => 'Введіть серію та номер паспорта.',
            'passport_number.regex'    => 'Номер паспорта має складатися з 6–12 латинських літер та цифр без пробілів.',
            'passport_expiry.required' => 'Вкажіть термін дії паспорта.',
            'passport_expiry.after'    => 'Паспорт має бути дійсним на момент поїздки.',
            'email.required'           => 'Поле «Email» не може бути порожнім.',
            'email.email'              => 'Email введено некоректно.',
            'phone.required'           => 'Вкажіть контактний номер телефону.',
            'phone.regex'              => 'Некоректний формат номера телефону.',
            'baggage.required'         => 'Оберіть норму багажу.',
            'comment.max'              => 'Коментар не може перевищувати 500 символів.',
        ];
    }

}
