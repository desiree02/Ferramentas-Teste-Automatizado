<?php

class CreateStore_test extends UnitTestCase
{
    public function setUp(): void
    {
        $this->resetInstance();        
        $this->CI->load->model('model_stores');
        $this->obj = $this->CI->model_stores;
    }

    //CT01: <(“Araujo Store”,”Active”), válido>
	public function test_CT01()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );
        
        $data = 
        [
            'id'  => '5',
            'name' => 'Araujo Store',
        	'active' => '1',
        ];

        $output01 = $this->request(
            'POST', 'Stores/create', 
                [
                    'store_name' => 'Araujo Store',
        	        'active' => '1'
                ]
        );

        $after_create = $this->obj->getStoresData(5);

        //print_r($after_create);
       // print_r($data);

        $this->assertEquals($after_create, $data);

	}

    //CT02: <(“Mc Donalds”,” ”), válido>
    public function test_CT02()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );
        
        $data = 
        [
            'id'  => '6',
            'name' => 'Mc Donalds',
        	'active' => '',
        ];

        $output01 = $this->request(
            'POST', 'Stores/create', 
                [
                    'store_name' => 'Mc Donalds',
        	        'active' => ''
                ]
        );

        $after_create = $this->obj->getStoresData(6);

        //print_r($after_create);
       // print_r($data);

        $this->assertEquals($after_create, $data);

	}


    //CT03: <(“Burguer King”,”Inactive”), válido>
    public function test_CT03()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );
        
        $data = 
        [
            'id'  => '6',
            'name' => 'Burguer King',
        	'active' => '0',
        ];

        $output01 = $this->request(
            'POST', 'Stores/create', 
                [
                    'store_name' => 'Burguer King',
        	        'active' => '0'
                ]
        );

        $after_create = $this->obj->getStoresData(6);

        //print_r($after_create);
       // print_r($data);

        $this->assertEquals($after_create, $data);

	}

    //CT04: <(“”,”Active”), inválido - informações obrigatórias não foram inseridas>
    public function test_CT04()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );
        
        $data = 
        [
            'id'  => '7',
            'name' => '',
        	'active' => '1',
        ];

        $output01 = $this->request(
            'POST', 'Stores/create', 
                [
                    'store_name' => '',
        	        'active' => '1'
                ]
        );

        $after_create = $this->obj->getStoresData(7);

        //print_r($after_create);
       // print_r($data);

        $this->assertEquals($after_create, $data);

	}
    
}
