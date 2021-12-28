<?php

class CreateOrder_test extends UnitTestCase
{
    public function setUp(): void
    {
        $this->resetInstance();        
        $this->CI->load->model('model_orders');
		$this->CI->load->model('model_products');
		$this->CI->load->model('model_company');

        $this->obj = $this->CI->model_orders;
        $this->obj1 = $this->CI->model_products;
        $this->obj2 = $this->CI->model_company;

    }
    
    //Casos de Teste: <(nome do cliente, endereço do cliente, telefone do cliente, produtos,quantidade, desconto), resultado>
    //CT01: <(“Desiree”,”Nilopolis”, “0219875422”, “Bolsa”, “2”, “”), válido>
    //VERIFICANDO SE O DADO QUE PASSEI FOI CRIADO
    public function test_CT01()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );        
       
        $product = $this->obj1->getProductData(17);        
        $product_id = $product['id']; 
        $product_qty = $product['qty'];
        $product_rate = $product['price'];

        $output01 = $this->request(
            'POST', 'Orders/create', 
                [
                    'product' => [$product_id], 
                    'customer_name' => 'Desiree', 
                    'customer_address' => 'Nilocity', 
                    'customer_phone' => '0219875422', 
                    'gross_amount_value' => $product_rate,
                    'service_charge_rate' => '',
                    'vat_charge_rate' => '',
                    'net_amount_value' => $product_rate,
                    'discount' => '',
                    'qty' => '2',
                    'rate' => $product_rate,
                    'rate_value' => $product_rate,
                    'amount' =>  $product_rate,
                    'amount_value' => $product_rate
                ]
        ); 

        $after_create = $this->obj->getOrdersData(47);
        $after_create_all = $this->obj->getOrdersData();

        $this->assertContains($after_create, $after_create_all);

	}

    //Casos de Teste: <(nome do cliente, endereço do cliente, telefone do cliente, produtos,quantidade, desconto), resultado>
    //CT01: <(“Desiree”,”Nilopolis”, “0219875422”, “Bolsa”, “2”, “”), válido>
    //VERIFICANDO SE A ORDEM CRIADA ESTÁ IGUAL AOS DADOS QUE PASSEI DO PRODUTO
    public function test_CT01_validation_product()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );        
       
        $after_create = $this->obj->getOrdersData(47);
        
        $dataProduct = 
        [   
            'id' => '47',
            'bill_no' => 'BILPR-5077',
            'customer_name' => 'Desiree',
            'customer_address' => 'Nilocity',
            'customer_phone' => '0219875422',
            'date_time' => '1631054502',
            'gross_amount' => '569.00',
            'service_charge_rate' => '73.97',
            'service_charge' => '73.97', //0 é padrão
            'vat_charge_rate' => '11.38',
            'vat_charge' => '11.38', //0 é padrão
            'net_amount' => '654.35',
            'discount' => '',
            'paid_status' => '2', //padrão
            'user_id'  =>  '1' //1 É PADRÃO
        ];

        $this->assertEquals($after_create, $dataProduct);
        //$this->assertContains($after_create, $after_create_all);

	}

    //Casos de Teste: <(nome do cliente, endereço do cliente, telefone do cliente, produtos,quantidade, desconto), resultado>
    //CT01: <(“Desiree”,”Nilopolis”, “0219875422”, “Bolsa”, “2”, “”), válido>
    //VERIFICANDO SE A INFORMAÇÃO DO ITEM DA ORDEM CRIADA ESTÁ IGUAL AOS DADOS QUE PASSEI 
    public function test_CT01_validation_order()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );        
              
        $data_orderItem = 
            [
                'id' => '23',
                'order_id' => '46',
                'product_id' => '17',
                'qty' => '1',
                'rate' => '569',
                'amount' => '569.00'
            ];

        $after_create = $this->obj->getOrdersItemData(46);

        $this->assertContains($data_orderItem, $after_create);

	}

    //Casos de Teste: <(nome do cliente, endereço do cliente, telefone do cliente, produtos,quantidade, desconto), resultado>
    //CT02: <(“”,””, “”, “hamburguer”, “1”, “”), válido>
    //VERIFICANDO SE O DADO QUE PASSEI FOI CRIADO
    public function test_CT02()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );        
       
        $product = $this->obj1->getProductData(19);        
        $product_id = $product['id']; 
        $product_qty = $product['qty'];
        $product_rate = $product['price'];

        $output01 = $this->request(
            'POST', 'Orders/create', 
                [
                    'product' => [$product_id], 
                    'customer_name' => '', 
                    'customer_address' => '', 
                    'customer_phone' => '', 
                    'gross_amount_value' => $product_rate,
                    'service_charge_rate' => '',
                    'vat_charge_rate' => '',
                    'net_amount_value' => $product_rate,
                    'discount' => '',
                    'qty' => '1',
                    'rate' => $product_rate,
                    'rate_value' => $product_rate,
                    'amount' =>  $product_rate,
                    'amount_value' => $product_rate
                ]
        ); 

        $after_create = $this->obj->getOrdersData(48);
        $after_create_all = $this->obj->getOrdersData();

        $this->assertContains($after_create, $after_create_all);

	}

    //Casos de Teste: <(nome do cliente, endereço do cliente, telefone do cliente, produtos,quantidade, desconto), resultado>
    //CT02: <(“”,””, “”, “hamburguer”, “1”, “”), válido>
    //VERIFICANDO SE A ORDEM CRIADA ESTÁ IGUAL AOS DADOS QUE PASSEI DO PRODUTO
    public function test_CT02_validation_product()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );        
       
        $after_create = $this->obj->getOrdersData(48);
        
        $dataProduct = 
        [   
            'id' => '48',
            'bill_no' => 'BILPR-F467',
            'customer_name' => '',
            'customer_address' => '',
            'customer_phone' => '',
            'date_time' => '1631056765',
            'gross_amount' => '25.00',
            'service_charge_rate' => '3.25',
            'service_charge' => '3.25', //0 é padrão
            'vat_charge_rate' => '0.50',
            'vat_charge' => '0.50', //0 é padrão
            'net_amount' => '654.35',
            'discount' => '',
            'paid_status' => '2', //padrão
            'user_id'  =>  '1' //1 É PADRÃO
        ];

        $this->assertEquals($after_create, $dataProduct);
        //$this->assertContains($after_create, $after_create_all);

	}

    //Casos de Teste: <(nome do cliente, endereço do cliente, telefone do cliente, produtos,quantidade, desconto), resultado>
    //CT02: <(“”,””, “”, “hamburguer”, “1”, “”), válido>
    //VERIFICANDO SE A INFORMAÇÃO DO ITEM DA ORDEM CRIADA ESTÁ IGUAL AOS DADOS QUE PASSEI 
    public function test_CT02_validation_order()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );        
              
        $data_orderItem = 
            [
                'id' => '25',
                'order_id' => '48',
                'product_id' => '19',
                'qty' => '1',
                'rate' => '25',
                'amount' => '25.00'
            ];

        $after_create = $this->obj->getOrdersItemData(48);

        $this->assertContains($data_orderItem, $after_create);

	}

    //Casos de Teste: <(nome do cliente, endereço do cliente, telefone do cliente, produtos,quantidade, desconto), resultado>
    //CT03: <(“”,””, “”, “Bolsa”, “N/a*”, “”), válido>
    //VERIFICANDO SE O DADO QUE PASSEI FOI CRIADO
    public function test_CT03()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );        
       
        $product = $this->obj1->getProductData(20);        
        $product_id = $product['id']; 
        $product_qty = $product['qty'];
        $product_rate = $product['price'];

        $output01 = $this->request(
            'POST', 'Orders/create', 
                [
                    'product' => [$product_id], 
                    'customer_name' => '', 
                    'customer_address' => '', 
                    'customer_phone' => '', 
                    'gross_amount_value' => $product_rate,
                    'service_charge_rate' => '',
                    'vat_charge_rate' => '',
                    'net_amount_value' => $product_rate,
                    'discount' => '',
                    'qty' => $product_qty,
                    'rate' => $product_rate,
                    'rate_value' => $product_rate,
                    'amount' =>  $product_rate,
                    'amount_value' => $product_rate
                ]
        ); 

        $after_create = $this->obj->getOrdersData(50);
        $after_create_all = $this->obj->getOrdersData();

        $this->assertContains($after_create, $after_create_all);

	}

    //Casos de Teste: <(nome do cliente, endereço do cliente, telefone do cliente, produtos,quantidade, desconto), resultado>
    //CT03: <(“”,””, “”, “Bolsa”, “N/a*”, “”), válido>
    //VERIFICANDO SE A ORDEM CRIADA ESTÁ IGUAL AOS DADOS QUE PASSEI DO PRODUTO
    public function test_CT03_validation_product()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );        
       
        $after_create = $this->obj->getOrdersData(50);
        
        $dataProduct = 
        [   
            'id' => '50',
            'bill_no' => 'BILPR-3253',
            'customer_name' => '',
            'customer_address' => '',
            'customer_phone' => '',
            'date_time' => '1631059543',
            'gross_amount' => '24.00',
            'service_charge_rate' => '3.12',
            'service_charge' => '3.12', //0 é padrão
            'vat_charge_rate' => '0.48',
            'vat_charge' => '0.48', //0 é padrão
            'net_amount' => '27.60',
            'discount' => '',
            'paid_status' => '2', //padrão
            'user_id'  =>  '1' //1 É PADRÃO
        ];

        $this->assertEquals($after_create, $dataProduct);
        //$this->assertContains($after_create, $after_create_all);

	}

    //Casos de Teste: <(nome do cliente, endereço do cliente, telefone do cliente, produtos,quantidade, desconto), resultado>
    //CT02: <(“”,””, “”, “hamburguer”, “1”, “”), válido>
    //VERIFICANDO SE A INFORMAÇÃO DO ITEM DA ORDEM CRIADA ESTÁ IGUAL AOS DADOS QUE PASSEI 
    public function test_CT03_validation_order()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );        
              
        $data_orderItem = 
            [
                'id' => '27',
                'order_id' => '50',
                'product_id' => '20',
                'qty' => '1',
                'rate' => '24',
                'amount' => '24.00'
            ];

        $after_create = $this->obj->getOrdersItemData(50);

        $this->assertContains($data_orderItem, $after_create);

	}

    //Casos de Teste: <(nome do cliente, endereço do cliente, telefone do cliente, produtos,quantidade, desconto), resultado>
    //CT04: <(“Andress”,”NI”, “0219875422”, “”, “2”, “”), inválido - informações obrigatórias não foram inseridas> (produto não inserido)
    public function test_CT04()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );        
       
       // $product = $this->obj1->getProductData();        
       // $product_id = $product['id']; 
       // $product_qty = $product['qty'];
       // $product_rate = $product['price'];

        $output01 = $this->request(
            'POST', 'Orders/create', 
                [
                    'product' => '', 
                    'customer_name' => 'Andress', 
                    'customer_address' => 'NI', 
                    'customer_phone' => '0219875422', 
                    'gross_amount_value' => '',
                    'service_charge_rate' => '',
                    'vat_charge_rate' => '',
                    'net_amount_value' => '',
                    'discount' => '',
                    'qty' => '2',
                    'rate' =>'',
                    'rate_value' => '',
                    'amount' =>  '',
                    'amount_value' => ''
                ]
        ); 

        $after_create = $this->obj->getOrdersData(51);
        $after_create_all = $this->obj->getOrdersData();

        $this->assertContains($after_create, $after_create_all);

	}
}