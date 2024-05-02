<?php

namespace App\Http\Middleware;

use Closure;

class ConvertToEnglishNumbers
{
    public function handle($request, Closure $next)
    {
        $input = $request->all();
        $convertedInput = $this->convertToEnglish($input);
        $request->merge($convertedInput);

        return $next($request);
    }

    private function convertToEnglish($input)
    {
        array_walk_recursive($input, function (&$value) {
            if (is_string($value)) {
                $persianNumbers = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
                $arabicNumbers = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
                $hindiNumbers = ['०', '१', '२', '३', '४', '५', '६', '७', '८', '९'];
                $englishNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

                $value = str_replace($persianNumbers, $englishNumbers, $value);
                $value = str_replace($arabicNumbers, $englishNumbers, $value);
                $value = str_replace($hindiNumbers, $englishNumbers, $value);
            }
        });

        return $input;
    }
}
