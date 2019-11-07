<?php

namespace App\Repositories\User;

use App\Repositories\AbstractBaseRepository;
use App\Models\User as Model;
use DB;

class UserRepository extends AbstractBaseRepository {

	protected $searchFields = [
        'firstname',
        'lastname',
        'mobile_number',
        'email',
        'birthdate',
        'gender'
	];

    public function __construct(Model $model) {
        parent::__construct($model);
    }

    public function paginate($request, $perpage, $page) {
        
        $items = $this->model;

        //check keyword
        if (isset($request['keyword']) && $request['keyword'] !== null && $request['keyword'] !== '') {
            $items = $items->where(function ($query) use ($request) {
            	foreach( $this->searchFields as $key => $field ){
            		if( $key == 0 ){
            			$query->where('users.'.$field, 'like', '%' . $request['keyword'] . '%');
            		}
            		else{
            			$query->orWhere('users.'.$field, 'like', '%' . $request['keyword'] . '%');
            		}
            	}
            });
        }
        
        return $this->model::paginate($items, $perpage, $page);
    }
    
}
