<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateProspectusRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {   
        \Validator::extend( 'composite_unique', function ( $attribute, $value, $parameters, $validator ) {
                
                // remove first parameter and assume it is the table name
                $table = array_shift( $parameters ); 

                // start building the conditions
                $con1 = [ $attribute => $value ];
                $con2 = [ $parameters[0] => $parameters[1] ];

                // query the table with all the conditions
                $result = \DB::table( $table )->select( \DB::raw( 1 ) )->where( $con1 )->where( $con2 )->count();

                return empty( $result ); // edited here
            }, 'The :attribute has already been taken.' );

        return [
            'catalog_no' => 'required|composite_unique:prospectus,curriculum,' . $this->request->get('curriculum'),
        ];
    }
}
