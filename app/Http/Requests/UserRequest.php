<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Facade\Tenant;
use App\Models\Service;
use App\Services\AvilableService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Auth\Access\AuthorizationException;

class UserRequest extends FormRequest
{
    use AvilableService;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        return  $this->checkIfAvilableCreateUser();
    }



    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */


    public $rules = [
        'name' => ['required', 'min:3'],
        'email' => ['required', 'unique:users,email'],
        'password' => ['required', 'min:6', 'max:30'],
        'image' => ['image', 'max:300']
    ];

    public function rules()
    {
        return $this->rules;
    }
}
