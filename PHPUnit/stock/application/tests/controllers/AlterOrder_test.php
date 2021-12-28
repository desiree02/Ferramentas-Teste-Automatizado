<?php

class AlterOrder_test extends UnitTestCase
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
    
    //"Casos de Teste: <(Número BILL, nome do cliente, telefone do cliente, data/Hora, Total de Produtos, Valor Total, status do pagamento, 
    //nome do cliente, endereço do cliente, telefone do cliente, produos, quantidade, desconto, status do pagamento), resultado>"	Tipo de teste(Análise)
    //CT01: <(“BILPR-3”,””, “”, “”, “”, “”, “”, 
    //”N/A*”, “N/A*”, “N/A*”, “N/A*”, “55”, “”, “N/A”), válido>	Funcional
    public function test_CT01()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );        
       
        $before_order_update = $this->obj->getOrdersData(50);        
        $order_id = $before_order_update['id']; 

        $product = $this->obj1->getProductData(20);        
        $product_id = $product['id']; 
        $product_qty = $product['qty'];
        $product_rate = $product['price'];


        $output01 = $this->request(
            'POST', ['Orders', 'update', '50'], 
                [
                    'product' => [$product_id], 
                    'qty' => '55',
                    'rate' => $product_rate,
                    'rate_value' => $product_rate,
                    'amount' =>  $product_rate,
                    'amount_value' => $product_rate
                ]
        ); 

        $after_update = $this->obj->getOrdersData(50);

       // print_r($before_order_update);
       // echo('--------------------');
       // print_r($after_update );

       $this->assertEquals($before_order_update, $after_update);

	}

    public function test_CT01_validation()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );        
       
        $order_update = $this->obj->getOrdersData(50);        
        
        $data = 
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

        print_r($order_update);
        echo('--------------------');
        print_r($data);

      $this->assertEquals($before_order_update, $after_update);

	}

    //"Casos de Teste: <(Número BILL, nome do cliente, telefone do cliente, data/Hora, Total de Produtos, Valor Total, status do pagamento, 
    //nome do cliente, endereço do cliente, telefone do cliente, produos, quantidade, desconto, status do pagamento), resultado>
    //CT02: <(““”,”Desiree”, “”, “”, “”, “”, “”, 
    //”N/A*”, “N/A*”, “N/A*”, “n/a”, “55”, “”, “n/a”), válido> É IGUAL, SÓ MUDA O ID


    //"Casos de Teste: <(Número BILL, nome do cliente, telefone do cliente, data/Hora, Total de Produtos, Valor Total, status do pagamento, 
    //nome do cliente, endereço do cliente, telefone do cliente, produos, quantidade, desconto, status do pagamento), resultado>
    //CT03: <(““”,””, “”, “”, “”, “”, “paid”, 
    //”N/A*”, “Paris”, “N/A*”, “N/A*”, “10”, “”, “n/a”), válido>
    public function test_CT03()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );        
       
        $before_order_update = $this->obj->getOrdersData(51);        
        $order_id = $before_order_update['id']; 
        $order_customer_name = $before_order_update['customer_name']; 
        $order_customer_phone = $before_order_update['customer_phone']; 

        $product = $this->obj1->getProductData(12);        
        $product_id = $product['id']; 
        $product_qty = $product['qty'];
        $product_rate = $product['price'];


        $output01 = $this->request(
            'POST', ['Orders', 'update', '51'], 
                [
                    'product' => [$product_id], 
                    'customer_name' => $order_customer_name,
                    'customer_address' => 'Paris',
                    'customer_phone' => $order_customer_phone, 
                    'gross_amount_value' => $product_rate,
                    'service_charge_rate' => '',
                    'vat_charge_rate' => '',
                    'net_amount_value' => $product_rate,
                    'discount' => '',
                    'qty' => '10',
                    'rate' => $product_rate,
                    'rate_value' => $product_rate,
                    'amount' =>  $product_rate,
                    'amount_value' => $product_rate
                ]
        ); 

        $after_update = $this->obj->getOrdersData(51);

       // print_r($before_order_update);
       // echo('--------------------');
       // print_r($after_update );

       $this->assertEquals($before_order_update, $after_update);

	}
    public function test_CT03_validation()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );        
       
        $order_update = $this->obj->getOrdersData(51);    
        $order_id = $order_update['id']; 
        $order_customer_name = $order_update['customer_name']; 
        $order_customer_phone = $order_update['customer_phone'];     
        
        $data = 
        [   
            'id' => '51',
            'bill_no' => 'BILPR-34CD',
            'customer_name' => 'Teste010921',
            'customer_address' => 'Paris',
            'customer_phone' => '021',
            'date_time' => '1631142798',
            'gross_amount' => '30.00',
            'service_charge_rate' => '3.90',
            'service_charge' => '3.90', //0 é padrão
            'vat_charge_rate' => '0.60',
            'vat_charge' => '0.60', //0 é padrão
            'net_amount' => '34.50',
            'discount' => '',
            'paid_status' => '2', //padrão
            'user_id'  =>  '1' //1 É PADRÃO
        ];

      //  print_r($order_update);
        echo('--------------------');
       // print_r($data);

      $this->assertEquals($order_update, $data);

	}


    //"Casos de Teste: <(Número BILL, nome do cliente, telefone do cliente, data/Hora, Total de Produtos, Valor Total, status do pagamento, 
    //nome do cliente, endereço do cliente, telefone do cliente, produos, quantidade, desconto, status do pagamento), resultado>
    //CT04: <(““”,””, “”, “16-10-2020”, “”, “”, “”, 
    //”renata”, “N/A*”, “02134567809”, “n/a”, “”, “”, “n/a”), inválido - informações obrigatórias não foram inseridas>
    public function test_CT04()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );        
       
        $before_order_update = $this->obj->getOrdersData(51);        
        $order_id = $before_order_update['id']; 
        $order_customer_name = $before_order_update['customer_name']; 
        $order_customer_address = $before_order_update['customer_address']; 

        $product = $this->obj1->getProductData(12);        
        $product_id = $product['id']; 
        $product_qty = $product['qty'];
        $product_rate = $product['price'];


        $output01 = $this->request(
            'POST', ['Orders', 'update', '51'], 
                [
                    'product' => [$product_id], 
                    'customer_name' => 'renata',
                    'customer_address' => $order_customer_address,
                    'customer_phone' => '02134567809', 
                    'gross_amount_value' => $product_rate,
                    'service_charge_rate' => '',
                    'vat_charge_rate' => '',
                    'net_amount_value' => $product_rate,
                    'discount' => '',
                    'qty' => '',
                    'rate' => $product_rate,
                    'rate_value' => $product_rate,
                    'amount' =>  $product_rate,
                    'amount_value' => $product_rate
                ]
        ); 

        $after_update = $this->obj->getOrdersData(51);

       // print_r($before_order_update);
       // echo('--------------------');
       // print_r($after_update );

       $this->assertEquals($before_order_update, $after_update);

	}
}