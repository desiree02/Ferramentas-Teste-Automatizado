<?php

class CreateProduct_test extends UnitTestCase
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
    
    //Casos de Teste: <(Imagem do produto, Nome do produto, SKU, Preço, Quantidade, Descrição, Marca, Categoria, Loja e Disponibilidade), resultado
	//CT01: <(“”,”Bolsa”, “12345”, “20,00”, “20”, “”, “”, “”, “Mc Donalds”, “Yes”), válido>
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
            'id' => '6',
            'name' => 'Bolsa',
            'sku' => '12345',
            'price' => '20,00',
            'qty' => '20',
            'image' => '<p>You did not select a file to upload.</p>', //texto padrao
            'description' => '',
            'attribute_value_id' => 'null', //padrao
            'brand_id' => 'null', //padrao
            'category_id' => 'null', //padrao
            'store_id' => '8',
            'availability' => '1'
        ];

        $output01 = $this->request(
            'POST', 'Products/create', 
                [
                    'name' => 'Bolsa',
                    'product_name' => 'Bolsa',
                    'sku' => '12345',
                    'price' => '20,00',
                    'qty' => '20',
                    'image' => '',
                    'description' => '',
                    'attribute_value_id' => '',
                    'brand_id' => '',
                    'category_id' => '',
                    'store_id' => '8',
                    'store' => '8',
                    'availability' => '1'
                ]
        );

        $after_create = $this->obj->getProductData(7);

        print_r($after_create);
        //print_r($data);

        $this->assertEquals($after_create, $data);

	}

    //Verificando se foi associado a uma Loja existente
    //CT01: <(“”,”Bolsa”, “12345”, “20,00”, “20”, “”, “”, “”, “Mc Donalds”, “Yes”), válido>
    public function test_CT01_validation_store()
	{
        $after_create_product = $this->obj->getProductData(6);
        $after_create_productId = $after_create_product['store_id'];

        $after_creatStore = $this->obj3->getStoresData($after_create_productId);

        $data =
                [
                    'id' => '8',
                    'name' => 'Mc Donalds',
                    'active' => '1'
                ];

        $this->assertEquals($after_creatStore, $data);

	}

    //Casos de Teste: <(Imagem do produto, Nome do produto, SKU, Preço, Quantidade, Descrição, Marca, Categoria, Loja e Disponibilidade), resultado>
    //CT02: <(“”,””, “09876”, “12,00”, “2”, “mochila”, “”, “”, “Mc Donalds”, “Yes”), inválido - informações obrigatórias não foram inseridas>
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
            'id' => '7',
            'name' => '',
            'sku' => '09876',
            'price' => '12,00',
            'qty' => '2',
            'image' => '<p>You did not select a file to upload.</p>', //texto padrao
            'description' => 'mochila',
            'attribute_value_id' => 'null', //padrao
            'brand_id' => 'null', //padrao
            'category_id' => 'null', //padrao
            'store_id' => '8',
            'availability' => '1'
        ];

        $output01 = $this->request(
            'POST', 'Products/create', 
                [
                    'name' => '',
                    'sku' => '09876',
                    'price' => '12,00',
                    'qty' => '2',
                    'image' => '', 
                    'description' => 'mochila',
                    'attribute_value_id' => '', 
                    'brand_id' => '',
                    'category_id' => '',
                    'store_id' => '8',
                    'availability' => '1'
                ]
        );

        $after_create = $this->obj->getProductData(7);

        print_r($after_create);
        //print_r($data);

        $this->assertEquals($after_create, $data);

	}

    //Verificando se foi associado a uma Loja existente
    //CT02: <(“”,””, “09876”, “12,00”, “2”, “mochila”, “”, “”, “Mc Donalds”, “Yes”), inválido - informações obrigatórias não foram inseridas>
    public function test_CT02_validation_store()
	{
        $after_create_product = $this->obj->getProductData(7);
        $after_create_productId = $after_create_product['store_id'];

        $after_creatStore = $this->obj3->getStoresData($after_create_productId);

        $data =
                [
                    'id' => '8',
                    'name' => 'Mc Donalds',
                    'active' => '1'
                ];

        $this->assertEquals($after_creatStore, $data);

	}

    //Casos de Teste: <(Imagem do produto, Nome do produto, SKU, Preço, Quantidade, Descrição, Marca, Categoria, Loja e Disponibilidade), resultado>
    //CT03: <(“”,””, “”, “”, “”, “fone”, “”, “”, “Mc Donalds”, “Yes”), inválido - informações obrigatórias não foram inseridas>
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
            'id' => '7',
            'name' => '',
            'sku' => '',
            'price' => '',
            'qty' => '',
            'image' => '<p>You did not select a file to upload.</p>', //texto padrao
            'description' => 'fone',
            'attribute_value_id' => 'null', //padrao
            'brand_id' => 'null', //padrao
            'category_id' => 'null', //padrao
            'store_id' => '8',
            'availability' => '1'
        ];

        $output01 = $this->request(
            'POST', 'Products/create', 
                [
                    'name' => '',
                    'sku' => '',
                    'price' => '',
                    'qty' => '',
                    'image' => '', 
                    'description' => 'fone',
                    'attribute_value_id' => '', 
                    'brand_id' => '', 
                    'category_id' => '', 
                    'store_id' => '8',
                    'availability' => '1'
                ]
        );

        $after_create = $this->obj->getProductData(7);

        print_r($after_create);
        //print_r($data);

        $this->assertEquals($after_create, $data);

	}

    //Verificando se foi associado a uma Loja existente
   //CT03: <(“”,””, “”, “”, “”, “fone”, “”, “”, “Mc Donalds”, “Yes”), inválido - informações obrigatórias não foram inseridas>
    public function test_CT03_validation_store()
	{
        $after_create_product = $this->obj->getProductData(7);
        $after_create_productId = $after_create_product['store_id'];

        $after_creatStore = $this->obj3->getStoresData($after_create_productId);

        $data =
                [
                    'id' => '8',
                    'name' => 'Mc Donalds',
                    'active' => '1'
                ];

        $this->assertEquals($after_creatStore, $data);

	}

    //Casos de Teste: <(Imagem do produto, Nome do produto, SKU, Preço, Quantidade, Descrição, Marca, Categoria, Loja e Disponibilidade), resultado>
    //CT04: <(“”,”Hamburguer”, “5678”, “30”, “10”, “X-tudo”, “MC”, “Lanche”, “N/A”, “Yes”), válido>
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
            'id' => '15',
            'name' => 'Hamburguer',
            'sku' => '5678',
            'price' => '30',
            'qty' => '10',
            'image' => '<p>You did not select a file to upload.</p>', //texto padrao
            'description' => 'X-tudo',
            'attribute_value_id' => 'null', //padrao
            'brand_id' => '"20"', 
            'category_id' => '"15"',
            'store_id' => '7',
            'availability' => '1'
        ];

        $brand = $this->obj1->getBrandData(20);
        $brand_id = $brand['id'];
        $category = $this->obj2->getCategoryData(15);
        $category_id = $category['id'];

        $output01 = $this->request(
            'POST', 'Products/create', 
                [
                    'name' => 'Hamburguer',
                    'product_name' => 'Hamburguer',
                    'sku' => '5678',
                    'price' => '30',
                    'qty' => '10',
                    'image' => '', 
                    'description' => 'X-tudo',
                    'attribute_value_id' => '', 
                   // 'brand_id' => $brand_id, 
                    'brands' => $brand_id,
                   // 'category_id' => $category_id,
                    'category' =>$category_id,
                    'store_id' => '7',
                    'store' => '7',
                    'availability' => '1'
                ]
        );

        $after_create = $this->obj->getProductData(15);
        print_r($after_create);
        //print_r($data);

        $this->assertEquals($after_create, $data);

	}

    //Verificando se foi associado a uma Loja existente
    //CT04: <(“”,”Hamburguer”, “5678”, “30”, “10”, “X-tudo”, “MC”, “Lanche”, “N/A”, “Yes”), válido>
    public function test_CT04_validation_store()
	{
        $after_create_product = $this->obj->getProductData(15);
        $after_create_productId = $after_create_product['store_id'];

        $after_creatStore = $this->obj3->getStoresData($after_create_productId);

        $data =
                [
                    'id' => '7',
                    'name' => 'teste',
                    'active' => '1'
                ];

        $this->assertEquals($after_creatStore, $data);

	}

    //Verificando se foi associado a uma Marca existente
    //CT04: <(“”,”Hamburguer”, “5678”, “30”, “10”, “X-tudo”, “MC”, “Lanche”, “N/A”, “Yes”), válido>
    public function test_CT04_validation_store_new()
	{
        $after_create_product =  $this->obj1->getBrandData(20);
        $after_create_productId = $after_create_product['id'];

        $after_creatStore = $this->obj1->getBrandData($after_create_productId);

        $data =
                [
                    'id' => '20',
                    'name' => 'MC',
                    'active' => '1'
                ];

        $this->assertEquals($after_creatStore, $data);

	}

    //Verificando se foi associado a uma Categoria existente
    //CT04: <(“”,”Hamburguer”, “5678”, “30”, “10”, “X-tudo”, “MC”, “Lanche”, “N/A”, “Yes”), válido>
    public function test_CT04_validation_store_new2()
	{
        $after_create_product =  $this->obj2->getCategoryData(15);
        $after_create_productId = $after_create_product['id'];

        $after_creatStore = $this->obj2->getCategoryData($after_create_productId);

        $data =
                [
                    'id' => '15',
                    'name' => 'Lanche',
                    'active' => '1'
                ];

        $this->assertEquals($after_creatStore, $data);

	}
}