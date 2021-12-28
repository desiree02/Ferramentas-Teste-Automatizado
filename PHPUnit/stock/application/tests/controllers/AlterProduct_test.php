<?php

class AlterProduct_test extends UnitTestCase
{
    public function setUp(): void
    {
        $this->resetInstance();        
        $this->CI->load->model('model_products');
		$this->CI->load->model('model_brands');
		$this->CI->load->model('model_category');
		$this->CI->load->model('model_stores');
		$this->CI->load->model('model_attributes');

        $this->obj = $this->CI->model_products;
        $this->obj1 = $this->CI->model_brands;
        $this->obj2 = $this->CI->model_category;
        $this->obj3 = $this->CI->model_stores;
        $this->obj4 = $this->CI->model_attributes;
    }

    //"Casos de Teste: <(Imagem, SKU, nome do produto, preço, quantidade, loja, disponibilidade,  
    //Imagem do produto, Nome do produto, SKU, preço, quantidade, descrição, marca, categoria, loja, disponibilidade), resultado>"
    //CT01: <(“”, “12345”, “”, “”, “”, “”,””, 
    //“N/A*”,”Mochila”, ”N/A*”, “30”, “N/A*”, “N/A*, “N/A*”, “N/A*”, “N/A*”, “N/A*”), válido>
	public function test_CT01()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'andre@andre',
                    'password'  => '1234567890'
                ]		
        );

        
        $before_update = $this->obj->getProductData(23); 
        $before_update_sku = $before_update['sku'];
        $before_update_qty = $before_update['qty'];
        $before_update_description = $before_update['description'];
        $before_update_image = $before_update['image'];
        $before_update_brand = $before_update['brand_id'];
        $before_update_category = $before_update['category_id'];
        $before_update_store = $before_update['store_id'];
        $before_update_availability = $before_update['availability'];
        $before_update_attribute_value_id = $before_update['attribute_value_id'];

        print_r($before_update);
        echo '--------------';

        $output01 = $this->request(
            'POST', ['products', 'update', '23'],
            [
                'name' => 'Mochila',
                'product_name' => 'Mochila',
                'sku' => $before_update_sku,
                'price' => '30,00',
                'qty' =>  $before_update_qty,
                'product_image' => $before_update_image,
                'image' =>  $before_update_image,
                'description' =>  $before_update_description,
                'attribute_value_id' => $before_update_attribute_value_id,
                'attributes_value_id' => $before_update_attribute_value_id,
                'attribute_value' => $before_update_attribute_value_id,
                'brand_id' =>  '17', // inseri o número, pois com a variável não reconhece
                'brands' =>  '17', // inseri o número, pois com a variável não reconhece
                'category_id' =>  '7', // inseri o número, pois com a variável não reconhece
                'category' =>  '7', // inseri o número, pois com a variável não reconhece
                'store_id' =>  '8', // inseri o número, pois com a variável não reconhece
                'store' =>  '8', // inseri o número, pois com a variável não reconhece
                'availability' => $before_update_availability            
            ]

        );

        $after_update = $this->obj->getProductData(23);

        //print_r($output01);
       //echo '--------------';
        print_r($after_update);
       
        $this->assertEquals($before_update, $after_update);
	}

    //verificando se esta igual ao dado que desejo
/*    public function test_CT01_validation()
	{    
        $after_update = $this->obj->getProductData(23); 
        
        $data =
            [   
                'id' => '23',
                'name' => 'Mochila',
                'sku' => '12345',
                'price' => '30,00',
                'qty' => '2',
                'image' => '<p>You did not select a file to upload.</p>', // txto padrão quando não tem imagem
                'description' => '<p>Bolsa</p>',
                'attribute_value_id' => '"null"',
                'brand_id' => '"17"',
                'category_id' => '"7"',
                'store_id' => '8',
                'availability' => '1'
            ];

        //print_r($after_update);
       // print_r($data);
       
        $this->assertEquals($after_update, $data);
	}

    //"Casos de Teste: <(Imagem, SKU, nome do produto, preço, quantidade, loja, disponibilidade,  
    //Imagem do produto, Nome do produto, SKU, preço, quantidade, descrição, marca, categoria, loja, disponibilidade), resultado>"
    //CT03: <(“”, “”, “”, “20”, “”, “”, “”, 
    //“”,””, ””, “30”, “N/A*”, “N/A*, “N/A*”, “N/A*”, “N/A*”, “N/A*”), inválido - informações obrigatórias não foram inseridas (produto e SKU nao inseridos>
    public function test_CT03()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'andre@andre',
                    'password'  => '1234567890'
                ]		
        );

        
        $before_update = $this->obj->getProductData(2); 
        $before_update_name = $before_update['name'];
        $before_update_sku = $before_update['sku'];
        $before_update_qty = $before_update['qty'];
        $before_update_description = $before_update['description'];
        $before_update_image = $before_update['image'];
        $before_update_brand = $before_update['brand_id'];
        $before_update_category = $before_update['category_id'];
        $before_update_store = $before_update['store_id'];
        $before_update_availability = $before_update['availability'];
        $before_update_attribute_value_id = $before_update['attribute_value_id'];

        print_r($before_update);
        echo '--------------';

        $output01 = $this->request(
            'POST', ['products', 'update', '2'],
            [
                'name' => $before_update_name,
                'product_name' => $before_update_name,
                'sku' => $before_update_sku,
                'price' => '30',
                'qty' =>  $before_update_qty,
                'product_image' => $before_update_image,
                'image' =>  $before_update_image,
                'description' =>  $before_update_description,
                'attribute_value_id' => $before_update_attribute_value_id,
                'attributes_value_id' => $before_update_attribute_value_id,
                'attribute_value' => $before_update_attribute_value_id,
                'brand_id' =>  '16', // inseri o número, pois com a variável não reconhece
                'brands' =>  '16', // inseri o número, pois com a variável não reconhece
                'category_id' =>  '7', // inseri o número, pois com a variável não reconhece
                'category' =>  '7', // inseri o número, pois com a variável não reconhece
                'store_id' =>  '7', // inseri o número, pois com a variável não reconhece
                'store' =>  '7', // inseri o número, pois com a variável não reconhece
                'availability' => $before_update_availability            
            ]

        );

        $after_update = $this->obj->getProductData(2);

        //print_r($output01);
       //echo '--------------';
        print_r($after_update);
       
        $this->assertEquals($before_update, $after_update);
	}

    //verificando se esta igual ao dado que desejo
    public function test_CT03_validation()
	{    
        $after_update = $this->obj->getProductData(2); 
        
        $data =
            [   
                'id' => '2',
                'name' => 'Mochila_New',
                'sku' => '1236',
                'price' => '30',
                'qty' => '88',
                'image' => '<p>You did not select a file to upload.</p>', // txto padrão quando não tem imagem
                'description' => '<p>teste</p>',
                'attribute_value_id' => '"null"',
                'brand_id' => '"16"',
                'category_id' => '"7"',
                'store_id' => '7',
                'availability' => '1'
            ];

        //print_r($after_update);
       // print_r($data);
       
        $this->assertEquals($after_update, $data);
	}

    //"Casos de Teste: <(Imagem, SKU, nome do produto, preço, quantidade, loja, disponibilidade,  
    //Imagem do produto, Nome do produto, SKU, preço, quantidade, descrição, marca, categoria, loja, disponibilidade), resultado>"
    //CT04: <(“”, “”, “”, “”, “”, “”, “”, 
    //“”,””, ””, “”, “N/A*”, “Janela”, “N/A*”, “N/A*”, “N/A*”, “N/A*”), inválido, info nece nao inserida (nome, sku e preço)>
    public function test_CT04()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'andre@andre',
                    'password'  => '1234567890'
                ]		
        );

        
        $before_update = $this->obj->getProductData(19); 
        $before_update_name = $before_update['name'];
        $before_update_sku = $before_update['sku'];
        $before_update_qty = $before_update['qty'];
        $before_update_description = $before_update['description'];
        $before_update_image = $before_update['image'];
        $before_update_brand = $before_update['brand_id'];
        $before_update_category = $before_update['category_id'];
        $before_update_store = $before_update['store_id'];
        $before_update_availability = $before_update['availability'];
        $before_update_attribute_value_id = $before_update['attribute_value_id'];

        print_r($before_update);
        echo '--------------';

        $output01 = $this->request(
            'POST', ['products', 'update', '19'],
            [
                'name' => '',
                'product_name' => '',
                'sku' => '',
                'price' => '',
                'qty' =>  $before_update_qty,
                'product_image' => '',
                'image' => '',
                'description' =>  'Janela',
                'attribute_value_id' => $before_update_attribute_value_id,
                'attributes_value_id' => $before_update_attribute_value_id,
                'attribute_value' => $before_update_attribute_value_id,
                'brand_id' =>  $before_update_brand, 
                'brands' =>  $before_update_brand, 
                'category_id' =>  $before_update_category, 
                'category' =>  $before_update_category, 
                'store_id' =>  $before_update_store, 
                'store' =>  $before_update_store, 
                'availability' => $before_update_availability            
            ]

        );

        $after_update = $this->obj->getProductData(19);

        //print_r($output01);
       //echo '--------------';
        print_r($after_update);
       
        $this->assertEquals($before_update, $after_update);
	}
    
    //"Casos de Teste: <(Imagem, SKU, nome do produto, preço, quantidade, loja, disponibilidade,  
    //Imagem do produto, Nome do produto, SKU, preço, quantidade, descrição, marca, categoria, loja, disponibilidade), resultado>"
    //CT04: <(“”, “”, “”, “”, “”, “”, “”, 
    //“”,””, ””, “”, “N/A*”, “Janela”, “N/A*”, “N/A*”, “N/A*”, “N/A*”), inválido, info nece nao inserida
    //verificando se esta igual ao dado que desejo
    public function test_CT04_validation()
	{    
        $after_update = $this->obj->getProductData(2); 
        
        $data =
            [   
                'id' => '19',
                'name' => '',
                'sku' => '',
                'price' => '',
                'qty' => '2',
                'image' => '<p>You did not select a file to upload.</p>', // txto padrão quando não tem imagem
                'description' => '<p>Janela</p>',
                'attribute_value_id' => '"null"',
                'brand_id' => '"20"',
                'category_id' => '"15"',
                'store_id' => '7',
                'availability' => '1'
            ];

        //print_r($after_update);
       // print_r($data);
       
        $this->assertEquals($after_update, $data);
	}

    //"Casos de Teste: <(Imagem, SKU, nome do produto, preço, quantidade, loja, disponibilidade,  
    //Imagem do produto, Nome do produto, SKU, preço, quantidade, descrição, marca, categoria, loja, disponibilidade), resultado>"
    //CT04: <(“”, “”, “”, “”, “”, “”, “”, 
    //“”,””, ””, “”, “N/A*”, “Janela”, “N/A*”, “N/A*”, “N/A*”, “N/A*”), inválido, info nece nao inserida
    //verificando se esta igual ao dado que desejo
    public function test_CT04_validation_productName()
	{           
        $data = strlen('');   // nome inserido    

        //print_r($data);
        if($data > 0){
            $qtd = 100;
        }
        else{
            $qtd = 0;
        }
  
        //print_r($data);
        //echo '--------------------';
        print_r($qtd);
        
        $this->assertSame($qtd, $data);
	}*/
}