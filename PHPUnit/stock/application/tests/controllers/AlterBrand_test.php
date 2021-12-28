<?php

class AlterBrand_test extends UnitTestCase
{
    public function setUp(): void
    {
        $this->resetInstance();        
        $this->CI->load->model('model_brands');
        $this->obj = $this->CI->model_brands;
    }

    //Casos de Teste: <(Nome da marca, status, Nome da marca, status), resultado>
    //CT01: <(“ufrrj”,””, ”N/A*”, “Inactive”), válido>
	public function test_CT01()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );
        
        $before_update = $this->obj->getBrandData(10); 
        
        $output01 = $this->request(
            'POST', ['Brands', 'update', '10'],
            [
                'edit_brand_name' => $before_update['name'],
                'edit_active' => '0'
            ]

        );

        $after_update = $this->obj->getBrandData(10);

       // print_r($before_update);
       // print_r($after_update);
       
        $this->assertEquals($before_update, $after_update);
	}

   public function test_CT01_validation()
	{    
        $after_update = $this->obj->getBrandData(10); 
        
        $data =
            [   
                'id' => '10',
                'name' => 'ufrrj',
                'active' => '0'
            ];

        //print_r($after_update);
       // print_r($data);
       
        $this->assertEquals($after_update, $data);
	}

    //Casos de Teste: <(Nome da marca, status, Nome da marca, status), resultado> FAZER A PARTIR DAQUI
    //CT02: <(“”,”Active”, ”ccomp”, "N/A*"), válido>
	public function test_CT02()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );
        
        $before_update = $this->obj->getActiveBrands(); 
        $before_update_first =  $before_update[0];
        $before_update_id =  $before_update[0]['id'];
        $before_update_status =  $before_update[0]['active'];
      
       $output01 = $this->request(
            'POST', ['Brands', 'update', '4'], // colocando o numero funciona
            [
                'edit_brand_name' => 'ccomp',
                'edit_active' => $before_update_status
            ]

        );

        $after_update = $this->obj->getBrandData($before_update_id);

        //print_r($before_update);
        //print_r($after_update);
    
        $this->assertEquals($before_update_first, $after_update);
	}

    public function test_CT02_validation()
	{    
        $after_update = $this->obj->getBrandData(4); 
        
        $data =
            [   
                'id' => '4',
                'name' => 'ccomp',
                'active' => '1'
            ];

        //print_r($after_update);
        //print_r($data);
       
        $this->assertEquals($after_update, $data);
	}

    //CT03: <(“ufrrj_ni”,””, “”, “N/A*”), inválido - informações obrigatórias não foram inseridas>
    public function test_CT03()
	{
        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );
        
        $before_update = $this->obj->getBrandData(13); 
        $before_update_id =  $before_update['id'];
        $before_update_status =  $before_update['active'];
        
        $output01 = $this->request(
            'POST', ['Brands', 'update', '13'],
            [
                'edit_brand_name' => '',
                'edit_active' => $before_update_status
            ]

        );

        $after_update = $this->obj->getBrandData(13);

        //print_r($before_update);
        //print_r($after_update);
       
        $this->assertEquals($before_update, $after_update);
	}

      public function test_CT03_validation()
	{    
        $after_update = $this->obj->getBrandData(13); 
        
        $data =
            [   
                'id' => '13',
                'name' => '',
                'active' => '1'
            ];

        //print_r($after_update);
       // print_r($data);
       
        $this->assertEquals($after_update, $data);
	}

    //CT04: <(“ccomp”, “”, ”ccomp2”, “Active”), válido>
    public function test_CT04()
	{
        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );
        
        $before_update = $this->obj->getBrandData(12); 
        $before_update_id =  $before_update['id'];
        $before_update_status =  $before_update['active'];
        
        $output01 = $this->request(
            'POST', ['Brands', 'update', '12'],
            [
                'edit_brand_name' => 'ccomp2',
                'edit_active' => '1'
            ]

        );

        $after_update = $this->obj->getBrandData(12);

        //print_r($before_update);
        //print_r($after_update);
       
        $this->assertEquals($before_update, $after_update);
	}

    //CT04: <(“ccomp”, “”, ”ccomp2”, “Active”), válido>
    public function test_CT04_validation()
	{    
        $after_update = $this->obj->getBrandData(12); 
        
        $data =
            [   
                'id' => '12',
                'name' => 'ccomp2',
                'active' => '1'
            ];

        //print_r($after_update);
       // print_r($data);
       
        $this->assertEquals($after_update, $data);
	}

}
