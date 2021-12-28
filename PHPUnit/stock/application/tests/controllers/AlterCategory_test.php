<?php

class AlterCategory_test extends UnitTestCase
{
    public function setUp(): void
    {
        $this->resetInstance();        
        $this->CI->load->model('model_category');
        $this->obj = $this->CI->model_category;
    }

    //Casos de Teste: <(Nome da categoria, status, Nome da categoria, status), resultado>
    //CT01: <(“curso”,””, ”N/A*”, “Inactive”), válido>
 	public function test_CT01()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );
        
        $before_update = $this->obj->getCategoryData(6); 
        
        $output01 = $this->request(
            'POST', ['Category', 'update', '6'],
            [
                'edit_category_name' => $before_update['name'],
                'edit_active' => '0'
            ]

        );

        $after_update = $this->obj->getCategoryData(6);

       // print_r($before_update);
       // print_r($after_update);
       
        $this->assertEquals($before_update, $after_update);
	}

    public function test_CT01_validation()
	{    
        $after_update = $this->obj->getCategoryData(6); 
        
        $data =
            [   
                'id' => '6',
                'name' => 'curso',
                'active' => '0'
            ];

        //print_r($after_update);
       // print_r($data);
       
        $this->assertEquals($after_update, $data);
	}

    //CT02: <(“”,”Active”,”novos horarios”, “N/A*”), válido>
    public function test_CT02()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );
        
        $before_update = $this->obj->getActiveCategroy(); 
        $before_update_first =  $before_update[0];
        $before_update_id =  $before_update[0]['id'];
        $before_update_status =  $before_update[0]['active'];
        
        $output01 = $this->request(
            'POST', ['Category', 'update', '4'],
            [
                'edit_category_name' => 'novos horarios',
                'edit_active' => $before_update_status
            ]

        );

        $after_update = $this->obj->getCategoryData($before_update_id);

       // print_r($before_update);
       // print_r($after_update);
       
        $this->assertEquals($before_update_first, $after_update);
	}

    public function test_CT02_validation()
	{    
        $after_update = $this->obj->getCategoryData(4); 
        
        $data =
            [   
                'id' => '4',
                'name' => 'novos horarios',
                'active' => '1'
            ];

        //print_r($after_update);
       // print_r($data);
       
        $this->assertEquals($after_update, $data);
	}

    //CT03: <(“disciplina”,””, “”, “N/A*”), inválido - informações obrigatórias não foram inseridas>
    public function test_CT03()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );
        
        $before_update = $this->obj->getCategoryData(7); 
        
        $output01 = $this->request(
            'POST', ['Category', 'update', '7'],
            [
                'edit_category_name' => '',
                'edit_active' => $before_update['active']
            ]

        );

        $after_update = $this->obj->getCategoryData(7);

       // print_r($before_update);
       // print_r($after_update);
       
        $this->assertEquals($before_update, $after_update);
	}

    public function test_CT03_validation()
	{    
        $after_update = $this->obj->getCategoryData(7); 
        
        $data =
            [   
                'id' => '7',
                'name' => '',
                'active' => '1'
            ];

        //print_r($after_update);
       // print_r($data);
       
        $this->assertEquals($after_update, $data);
	}


    //CT04: <(“horario”, “”, ”N/A*”, “Active”), válido>
    public function test_CT04()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );
        
        $before_update = $this->obj->getCategoryData(9); 
        
        $output01 = $this->request(
            'POST', ['Category', 'update', '9'],
            [
                'edit_category_name' => $before_update['name'],
                'edit_active' => '1'
            ]

        );

        $after_update = $this->obj->getCategoryData(9);

       // print_r($before_update);
       // print_r($after_update);
       
        $this->assertEquals($before_update, $after_update);
	}

    public function test_CT04_validation()
	{    
        $after_update = $this->obj->getCategoryData(9); 
        
        $data =
            [   
                'id' => '9',
                'name' => 'horario',
                'active' => '1'
            ];

        //print_r($after_update);
       // print_r($data);
       
        $this->assertEquals($after_update, $data);
	}

}
