<?php 
namespace App\Library;

class MatrixClass
{

	private $request;
	
	function __construct($request)
	{
		$this->request = $request;
	}

	public function CreateTestCases($size)
	{
		return $this->request->session()->put('TestCasesSize', $size);
	}
	public function CreateOperations($size)
	{
		return $this->request->session()->put('Operations', $size);
	}

	public function CreateMatrix($length)
	{

		$matrix = array();
		for ($i=0; $i < $length; $i++) { 
			
			for ($j=0; $j < $length; $j++) { 

				for ($k=0; $k < $length; $k++) { 
					$matrix[$i][$j][$k] = 0;
				}
			}
		}
		return $this->request->session()->put('matrix', $matrix);
	}

	public function Update($x,$y,$z,$value)
	{
		$matrix = $this->request->session()->get('matrix');
		$matrix[$x-1][$y-1][$z-1] = intval($value);
		$this->request->session()->put('matrix', $matrix);
		return " ";
	}

	public function Query($x,$y,$z)
	{
		$sum = 0;
		$matrix = $this->request->session()->get('matrix');
		for ($i=$x[0]-1; $i < $x[1]; $i++) { 
			for ($j=$y[0]-1; $j < $y[1]; $j++) { 
				for ($k=$z[0]-1; $k < $z[1]; $k++) { 
					$sum += $matrix[$i][$j][$k];
				}
			}
		}

		return $sum;
	}

	function getMatrix()
	{
		return $this->request->session()->get('key');
	}
}

 ?>