<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class FormValidationService
{
    public function validateStoreRequest($data)
    {
        $rules = [
            'fecha' => 'required|date|before_or_equal:today',
            'hotel' => 'required|string|max:100',
            'semana' => 'required|integer|min:1|max:7',

            // Validaciones para generación de residuos
            'rali_kg' => 'required|numeric|min:0',
            'rcom_kg' => 'required|numeric|min:0',
            'rino_kg' => 'required|numeric|min:0',
            'rnva_kg' => 'required|numeric|min:0',

            // Validaciones para habitaciones y áreas comunes
            'hino_kg' => 'required|numeric|min:0',
            'hotr_kg' => 'required|numeric|min:0',
            'asan_kg' => 'required|numeric|min:0',
            'ajar_kg' => 'required|numeric|min:0',
            'aino_kg' => 'required|numeric|min:0',

            // Validaciones para subproductos
            'bs_car' => 'nullable|numeric|min:0',
            'bs_pap' => 'nullable|numeric|min:0',
            'bs_alu' => 'nullable|numeric|min:0',
            'bs_met' => 'nullable|numeric|min:0',
            'bs_pet' => 'nullable|numeric|min:0',
            'bs_pla' => 'nullable|numeric|min:0',
            'bs_jar' => 'nullable|numeric|min:0',
            'bs_ali' => 'nullable|numeric|min:0',
            'bs_com' => 'nullable|numeric|min:0',
            'bs_san' => 'nullable|numeric|min:0',
            'bs_nv' => 'nullable|numeric|min:0',
            'bs_ms' => 'nullable|numeric|min:0',
            'bs_pel' => 'nullable|numeric|min:0',

            // Validaciones para valorizables
            'vol_r2' => 'required|numeric|min:0',
            'peso_net2' => 'required|numeric|min:0',

            // Validaciones para no valorizables
            'vol_r1' => 'required|numeric|min:0',
            'peso_net1' => 'required|numeric|min:0',
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
