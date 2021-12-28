<?php

class DeleteProduct_test extends UnitTestCase
{
    public function setUp(): void
    {
        $this->resetInstance();        
        $this->CI->load->model('model_products');
		$this->obj = $this->CI->model_products;

    }

    //Casos de Teste: <(Imagem, SKU, nome do produto, preço, quantidade, loja, Disponibilidade, Opção Exclusão), resultado>
    //CT01: <(“”, “12345”, “”, “”, “”, “”,””, ”Save Changes”), válido>
	public function test_CT01()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );
        
        $before_remove = $this->obj->getProductData(4); 
        
        $output01 = $this->request(
            'POST', 'Products/remove', 
                [
                    'product_id' => $before_remove['id'] 
                ]
        );

        $after_remove = $this->obj->getProductData();

       // print_r($before_remove);
       // print_r($after_remove);
       
        $this->assertContains($before_remove, $after_remove);
	}


    //CT03: <(“”, “”, “”, “”, “”, “”, “”, “”,””, ”Active”, ”Save Changes”), válido>
    public function test_CT03()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );
        
        $before_remove = $this->obj->getActiveProductData(); 
        $before_remove_first =  $before_remove[0];
        $before_remove_id = $before_remove[0]['id']; 
        
        $output01 = $this->request(
            'POST', 'Products/remove', 
                [
                    'product_id' => $before_remove_id
                ]
        );

        $after_remove = $this->obj->getProductData();

       // print_r($before_remove);
       // print_r($after_remove);
       
        $this->assertContains($before_remove_first, $after_remove);
	}

    //CT04: <(“”, “”, “”, “”, “”, “”, “”, “”,””, “”, “Save Changes”), válido>
    public function test_CT04()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );
        
        $before_remove = $this->obj->getProductData(); 
        $before_remove_first =  $before_remove[0];
        $before_remove_id = $before_remove[0]['id']; 
        
        $output01 = $this->request(
            'POST', 'Products/remove', 
                [
                    'product_id' => $before_remove_id
                ]
        );

        $after_remove = $this->obj->getProductData();

       // print_r($before_remove);
       // print_r($after_remove);
       
        $this->assertContains($before_remove_first, $after_remove);
	}

}