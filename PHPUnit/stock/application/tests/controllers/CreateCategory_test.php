<?php

class CreateCategory_test extends UnitTestCase
{
    public function setUp(): void
    {
        $this->resetInstance();        
        $this->CI->load->model('model_category');
        $this->obj = $this->CI->model_category;
    }

    //Casos de Teste: <(Nome da categoria, Status), resultado>
    //CT01: <(“curso”,”Active”), válido>
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
            'id'  => '6',
            'name' => 'curso',
        	'active' => '1',
        ];

        $output01 = $this->request(
            'POST', 'Category/create', 
                [
                    'category_name' => 'curso',
        	        'active' => '1'
                ]
        );

        $after_create = $this->obj->getCategoryData(6);

        //print_r($after_create);
       // print_r($data);

        $this->assertEquals($after_create, $data);

	}

    //CT02: <(“disciplina”,” ”), válido>
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
            'id'  => '7',
            'name' => 'disciplina',
        	'active' => '1', 
        ];

        $output01 = $this->request(
            'POST', 'Category/create', 
                [
                    'category_name' => 'disciplina',
        	        'active' => '1' // 1 é o padrão
                ]
        );

        $after_create = $this->obj->getCategoryData(7);

        //print_r($after_create);
       // print_r($data);

        $this->assertEquals($after_create, $data);

	}

    //CT03: <(“horario”,”Inactive”), válido>
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
            'id'  => '13',
            'name' => 'horario',
        	'active' => '0', 
        ];

        $output01 = $this->request(
            'POST', 'Category/create', 
                [
                    'category_name' => 'horario',
        	        'active' => '0' 
                ]
        );

        $after_create = $this->obj->getCategoryData(13);

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
            'id'  => '15',
            'name' => 'horario',
        	'active' => '0', 
        ];

        $output01 = $this->request(
            'POST', 'Category/create', 
                [
                    'category_name' => '',
        	        'active' => '1' 
                ]
        );

        $after_create = $this->obj->getCategoryData(15);

        //print_r($after_create);
       // print_r($data);

        $this->assertEquals($after_create, $data);

	}

}
