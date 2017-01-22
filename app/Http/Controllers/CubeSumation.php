<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\library\MatrixClass;

class CubeSumation extends Controller
{
	private $matrix;

	function __construct(Request $request)
	{
		$this->matrix = new MatrixClass($request);
	}

    function index(Request $request)
    {
    	return '';
    }
    public function CreateMatrix($value='')
    {
    	$size = Input::get('size');
    	$operations = Input::get('operations');
    	$this->matrix->CreateOperations($operations);
    	return $this->matrix->CreateMatrix($size);
    }
    public function CreateTestCases($value='')
    {
    	$size = Input::get('size');
    	return $this->matrix->CreateTestCases($size);
    }
    public function executeQuery($value='')
    {
    	$query = Input::get('query');
    	$x = Input::get('x');
    	$y = Input::get('y');
    	$z = Input::get('z');
    	$value = Input::get('value');
    	if ($query == 'UPDATE') {
    		$result = $this->matrix->Update($x,$y,$z,$value);
    	}else if ($query == 'QUERY') {
    		$result  = $this->matrix->Query($x,$y,$z);
    	}	
    	return $result;
    }
}
