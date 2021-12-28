<?php

class DeleteBrand_test extends UnitTestCase
{
    public function setUp(): void
    {
        $this->resetInstance();        
        $this->CI->load->model('model_brands');
        $this->obj = $this->CI->model_brands;
    }

    //Casos de Teste: <(Nome da marca, status, Opção Exclusão), resultado>
   // CT01: <(“ufrrj”, “”, ”Save Changes”), válido>
	public function test_CT01()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );
        
        $before_remove = $this->obj->getBrandData(10); 
        
        $output01 = $this->request(
            'POST', 'Brands/remove', 
                [
                    'brand_id' => $before_remove['id'] 
                ]
        );

        $after_remove = $this->obj->getBrandData();

       // print_r($before_remove);
       // print_r($after_remove);
       
        $this->assertContains($before_remove, $after_remove);
	}

   // CT04: <(“”, “Active”, Save Changes”), válido>
    public function test_CT04()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );
        
        $before_remove = $this->obj->getActiveBrands(); 
        $before_remove_first =  $before_remove[0];
        $before_remove_id =  $before_remove[0]['id'];
        $before_remove_status =  $before_remove[0]['active'];
        
        $output01 = $this->request(
            'POST', 'Brands/remove', 
                [
                    'brand_id' => $before_remove[0]['id']
                ]
        );

        $after_remove = $this->obj->getBrandData();

        //print_r($before_remove_first);
        //print_r($after_remove);
       
        $this->assertContains($before_remove_first, $after_remove);
	}

}
