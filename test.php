<?php
function strengthPlanOrig( $data ) {
	
	$data = ( int ) $data;
	switch( $data ) {
    	case 0:
    		$result = 'standard strength';
    		break;
    		$result
    	case( $data < 20 ):
        	$result = 'standard strength';
        	break;
    	case( $data > 20 ):
        	$result = 'advanced strength';
        	break;
	}
	return $result;
	
}

function strengthPlan( $data ) {
	
	$data = ( int ) $data;
	if( $data < 10 ) return '';
	if( $data >= 11 && $data <= 20 ) return '';
	 	
}