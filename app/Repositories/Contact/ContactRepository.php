<?php

namespace App\Repositories\Contact;

use App\Repositories\AbstractBaseRepository;
use App\Models\Contact as Model;
use App\Models\ContactVideo as ContactVideo;
use DB;

class ContactRepository extends AbstractBaseRepository {

	protected $searchFields = [
        'fullname',
        'mobile_number',
        'email'
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
            			$query->where('contacts.'.$field, 'like', '%' . $request['keyword'] . '%');
            		}
            		else{
            			$query->orWhere('contacts.'.$field, 'like', '%' . $request['keyword'] . '%');
            		}
            	}
            });
        }
        
        return $this->model::paginate($items, $perpage, $page);
    }
    
}
