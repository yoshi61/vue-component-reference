<?php


namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponser
{
    // success response
    public function success( $message, $code = Response::HTTP_OK )
    {
        return response()->json([ 'data' => $message, 'code' => $code ], $code);
    }

    // Error Response
    public function errorResponse( $message, $code )
    {
        return response()->json([ 'error' => $message, 'code' => $code ], $code);
    }

    // USED WHEN RENDERING RESULT
    public function successRes( $data, $data_attributes = [], $code = Response::HTTP_OK )
    {
        if( !empty($data_attributes)){
            return response()->json([ 'data' => $data, 'attributes' => $data_attributes ],  $code);
        }
        return response()->json([ 'data' => $data ],  $code);
    }

    // Resource created
    public function createdResponse($data, $code = Response::HTTP_CREATED){
        return response()->json([ 'data' => $data, 'code' => $code ], $code);
    }

    // No content response
    public function emptyResponse(){
        $code = Response::HTTP_NO_CONTENT;
        return response()->json([ 'error' => 'No matching content found.', 'code' => $code ], $code);
    }

}
