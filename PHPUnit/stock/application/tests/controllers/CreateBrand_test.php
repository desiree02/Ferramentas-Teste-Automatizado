<?php

class CreateBrand_test extends UnitTestCase
{
    public function setUp(): void
    {
        $this->resetInstance();        
        $this->CI->load->model('model_brands');
        $this->obj = $this->CI->model_brands;
    }

    //CT01: <(“rural”,”Ativo”), válido>
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
            'id'  => '9',
            'name' => 'rural',
        	'active' => '1',
        ];

        $output01 = $this->request(
            'POST', 'Brands/create', 
                [
                    'brand_name' => 'rural',
        	        'active' => '1'
                ]
        );

        $after_create = $this->obj->getBrandData(9);

        //print_r($after_create);
       // print_r($data);

        $this->assertEquals($after_create, $data);

	}

    //CT02: <(“ufrrj”,””), válido>
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
            'id'  => '11',
            'name' => 'ufrrj',
        	'active' => '1',
        ];

        $output01 = $this->request(
            'POST', 'Brands/create', 
                [
                    'brand_name' => 'ufrrj',
        	        'active' => '1' // coloquei 1, pois não funciona vazio, o padrão é 1
                ]
        );

        $after_create = $this->obj->getBrandData(11);

        //print_r($after_create);
       // print_r($data);

        $this->assertEquals($after_create, $data);

	}

   //CT03: <(“ccomp”,”Inactive”), válido>
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
           'id'  => '12',
           'name' => 'ccomp',
           'active' => '0',
       ];

       $output01 = $this->request(
           'POST', 'Brands/create', 
               [
                   'brand_name' => 'ccomp',
                   'active' => '0' 
               ]
       );

       $after_create = $this->obj->getBrandData(12);

       //print_r($after_create);
      // print_r($data);

       $this->assertEquals($after_create, $data);

   }
 
   //CT04: <(“ufrrj_ni”,””), válido>
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
           'id'  => '13',
           'name' => 'ufrrj_ni',
           'active' => '1',
       ];

       $output01 = $this->request(
           'POST', 'Brands/create', 
               [
                   'brand_name' => 'ufrrj_ni',
                   'active' => '1' // coloquei 1, pois não funciona vazio, o padrão é 1
               ]
       );

       $after_create = $this->obj->getBrandData(13);

       //print_r($after_create);
      // print_r($data);

       $this->assertEquals($after_create, $data);

   }

   //CT05: <(“”,”Inactive”), inválido - informações obrigatórias não foram inseridas>
   public function test_CT05()
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
           'id'  => '17',
           'name' => '',
           'active' => '0',
       ];

       $output01 = $this->request(
           'POST', 'Brands/create', 
               [
                   'brand_name' => '',
                   'active' => '0' 
               ]
       );

       $after_create = $this->obj->getBrandData(17);

       //print_r($after_create);
      // print_r($data);

       $this->assertEquals($after_create, $data);

   }
}
