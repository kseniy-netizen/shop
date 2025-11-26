<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class CategoryRequest extends FormRequest
{
public function authorize(): bool
{
// в учебном проекте можно разрешать всем авторизованным
return true;
}
protected function prepareForValidation(): void
{
if ($this->has('code')) {
$this->merge([
'code' => trim(strtolower($this->input('code'))),
]);
}
}
public function rules(): array
{
$id = $this->route('category')?->id;
return [
'code' => [
'required',
'string',
'min:3',
'max:255',
Rule::unique('categories', 'code')->ignore($id),
],
'name' => [
'required',
'string',
'min:3',
'max:255',
],
'description' => [
'nullable',
'string',
'min:5',
],
'image' => [
'nullable',
'image',
'max:2048',
],
];
}
public function messages(): array
{
return [
'code.required' => 'Поле код обязательно.',
'code.unique' => 'Категория с таким кодом уже существует.',
'code.min' => 'Код должен содержать минимум :min символа.',
'name.required' => 'Введите название категории.',
];
}
public function attributes(): array
{
return [
'code' => 'код категории',
'name' => 'название',
'description' => 'описание',
'image' => 'изображение',
];
}
}