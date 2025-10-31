<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'amount' => 'required|numeric|min:0.01|max:1000000',
            'category' => 'required|string|max:255|min:3',
            'date' => 'required|date',
            'notes' => 'nullable|string|max:1000|min:3',
        ];
    }

    public function messages(): array
    {
        return [
            'amount.required' => 'Please enter the expense amount.',
            'amount.numeric' => 'Amount must be a valid number.',
            'amount.min' => 'Amount must be at least 0.01.',
            'amount.max' => 'Amount cannot exceed 1,000,000.',
            'category.required' => 'Please enter a category.',
            'category.min' => 'Category must be at least 3 characters long.',
            'category.max' => 'Category cannot exceed 255 characters.',
            'date.required' => 'Please select a date.',
            'date.date' => 'Please enter a valid date.',
            'notes.min' => 'Notes must be at least 3 characters long.',
            'notes.max' => 'Notes cannot exceed 1000 characters.',
        ];
    }
}
