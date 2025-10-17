<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DestinationRequest extends FormRequest
{
    public function authorize(): bool
    {
        // SỬA LỖI: Trả về true để cho phép request.
        // Bạn có thể thêm logic xác thực phức tạp hơn ở đây,
        // ví dụ: return auth()->user()->isAdmin();
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug'  => ['required', 'string', 'max:255', 'unique:destinations,slug,' . optional($this->destination)->id],
            'province' => ['nullable', 'string', 'max:120'],
            'latitude'  => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
        ];
    }
}