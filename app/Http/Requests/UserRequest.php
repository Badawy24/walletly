<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_name' => 'required|string|max:255|regex:/^[a-zA-Z0-9._-]+$/|min:3',
            'daily_limit' => 'nullable|numeric|min:0|max:100000',
            'weekly_limit' => 'nullable|numeric|min:0|max:100000',
            'monthly_limit' => 'nullable|numeric|min:0|max:100000',
        ];
    }
    public function messages(): array
    {
        return [
            'user_name.required' => 'Please enter your user name.',
            'user_name.regex' => 'User name can only contain letters, numbers, dots, underscores, and hyphens.',
            'user_name.max' => 'User name cannot exceed 255 characters.',
            'user_name.min' => 'User name must be at least 3 characters long.',
            'daily_limit.numeric' => 'Daily limit must be a valid number.',
            'daily_limit.min' => 'Daily limit cannot be negative.',
            'daily_limit.max' => 'Daily limit cannot exceed 1,000,000.',
            'weekly_limit.numeric' => 'Weekly limit must be a valid number.',
            'weekly_limit.min' => 'Weekly limit cannot be negative.',
            'weekly_limit.max' => 'Weekly limit cannot exceed 1,000,000.',
            'monthly_limit.numeric' => 'Monthly limit must be a valid number.',
            'monthly_limit.min' => 'Monthly limit cannot be negative.',
            'monthly_limit.max' => 'Monthly limit cannot exceed 1,000,000.',
        ];
    }
}
