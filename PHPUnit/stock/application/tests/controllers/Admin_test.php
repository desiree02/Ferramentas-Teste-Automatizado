<?php

class Admin_test extends UnitTestCase
{
    public function setUp(): void
    {
        $this->resetInstance();        
        $this->CI->load->model('model_users');
        $this->obj = $this->CI->model_users;
    }

    //CT01: <(“desireearaujo”, “dee@gmail.com”, “Desiree”’, “N/A*”, “N/A*”, “N/A*”, “”), válido>
    public function test_CT01()
	{
        $before_update = $this->obj->getUserData(1); 

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );
    
        $output01 = $this->request(
            'POST', 'users\setting',
                [
                    'username' => 'desireearaujo',
                    'password' => 'testando',
                    'email' => 'dee@gmail.com',
                    'firstname' => 'Desiree',
                    'lastname' => '',
                    'phone' => '',
                    'gender' => ''
                ]		
        );

        $after_update = $this->obj->getUserData(1); 

      //  print_r($before_update);
      //  print_r($after_update);

        $this->assertEquals($before_update, $after_update);

        return $after_update;

	} 

    //CT01: <(“desireearaujo”, “dee@gmail.com”, “Desiree”’, “N/A*”, “N/A*”, “N/A*”, “”), válido>
	public function test_CT01_validation()
	{
        $result_ct01 = $this->test_CT01();

        $data = 
            [
                //'id' => '1',
                'username' => 'desireearaujo',
                'password' => 'testando',
                'email' => 'dee@gmail.com',
                'firstname' => 'Desiree',
                'lastname' => '',
                'phone' => '',
                'gender' => ''
            ];

        print_r($result_ct01);
        print_r($data);

        $this->assertEquals($result_ct01, $data);

	} 

    //CT02: <(“Araujo Store”,”13”, “2”, “RJ”, “021”,”Brasil”, “Loja de Bolsa”, “USD”), válido>
    public function test_CT02()
	{
        $before_update = $this->obj->getCompanyData(1); 

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );
     
        $output01 = $this->request(
            'POST', 'company/index',
                [
                    'company_name' => 'Araujo Store',
                    'service_charge_value' => '13',
                    'vat_charge_value' =>'2',
                    'address' => 'RJ',
                    'phone' => '021',
                    'country' => 'Brasil',
                    'message' => 'Loja de Bolsa',
                    'currency' => 'USD'
                ]		
        );

        $after_update = $this->obj->getCompanyData(1); 

       // print_r($before_update);
      //  print_r($after_update);

        $this->assertEquals($before_update, $after_update);

        return $after_update;
	} 

    public function test_CT02_validation()
	{
        $result_ct01 = $this->test_CT02();

        $data = 
            [
                'id' => '1',
                'company_name' => 'Araujo Store',
                'service_charge_value' => '13',
                'vat_charge_value' =>'2',
                'address' => 'RJ',
                'phone' => '021',
                'country' => 'Brasil',
                'message' => 'Loja de Bolsa',
                'currency' => 'USD'
            ];

       print_r($result_ct01);
       print_r($data);

        $this->assertEquals($result_ct01, $data);

	} 

    //CT03: <(“Araujo Store”,””, “”, “”, “”,””, “Loja de Bolsa”, “”), inválido - informações obrigatórias não foram inseridas>
    public function test_CT03()
	{
        $before_update = $this->obj->getCompanyData(1); 

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );
     
        $output01 = $this->request(
            'POST', 'company/index',
                [
                    'company_name' => 'Araujo Store',
                    'service_charge_value' => '',
                    'vat_charge_value' =>'',
                    'address' => '',
                    'phone' => '',
                    'country' => '',
                    'message' => 'Loja de Bolsa',
                    'currency' => ''
                ]		
        );

        $after_update = $this->obj->getCompanyData(1); 

        //print_r($before_update);
        //print_r($after_update);

        $this->assertEquals($before_update, $after_update);

        return $after_update;
	} 

    public function test_CT03_validation()
	{
        $result_ct01 = $this->test_CT03();

        $data = 
            [
                'id' => '1',
                'company_name' => 'Araujo Store',
                'service_charge_value' => '',
                'vat_charge_value' =>'',
                'address' => '',
                'phone' => '',
                'country' => '',
                'message' => 'Loja de Bolsa',
                'currency' => ''
            ];

       print_r($result_ct01);
       print_r($data);

        $this->assertEquals($result_ct01, $data);

	}

    //CT04: <(“Araujo Store”,””, “”, “”, “”,””, “”, “”), inválido - informações obrigatórias não foram inseridas>
    public function test_CT04()
	{
        $before_update = $this->obj->getCompanyData(1); 

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );
     
        $output01 = $this->request(
            'POST', 'company/index',
                [
                    'company_name' => 'Araujo Store',
                    'service_charge_value' => '',
                    'vat_charge_value' =>'',
                    'address' => '',
                    'phone' => '',
                    'country' => '',
                    'message' => '',
                    'currency' => ''
                ]		
        );

        $after_update = $this->obj->getCompanyData(1); 

        print_r($before_update);
        print_r($after_update);

        $this->assertEquals($before_update, $after_update);

        return $after_update;
	} 

    public function test_CT04_validation()
	{
        $result_ct01 = $this->test_CT04();

        $data = 
            [
                'id' => '1',
                'company_name' => 'Araujo Store',
                'service_charge_value' => '',
                'vat_charge_value' =>'',
                'address' => '',
                'phone' => '',
                'country' => '',
                'message' => '',
                'currency' => ''
            ];

       print_r($result_ct01);
       print_r($data);

        $this->assertEquals($result_ct01, $data);

	}

    
    //CT05: <(“UFRRJ”,”N/A*”, “N/A*”, “RJ”, “N/A*”,”N/A*”, “olá ruralinos”, “N/A*”), válido>
    public function test_CT05()
	{
        $before_update = $this->obj->getCompanyData(1); 

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );
     
        $output01 = $this->request(
            'POST', 'company/index',
                [
                    'company_name' => 'UFRRJ',
                    'service_charge_value' => $before_update[service_charge_value],
                    'vat_charge_value' => $before_update[vat_charge_value],
                    'address' => 'RJ',
                    'phone' => $before_update[phone],
                    'country' => $before_update[country],
                    'message' => 'ola ruralinos',
                    'currency' => $before_update[currency]
                ]		
        );

        $after_update = $this->obj->getCompanyData(1); 

        //print_r($before_update);
        //print_r($after_update);

        $this->assertEquals($before_update, $after_update);

        return $after_update;
	} 

    public function test_CT05_validation()
	{
        $result_ct01 = $this->test_CT05();

        $data = 
            [
                'id' => '1',
                'company_name' => 'UFRRJ',
                'service_charge_value' => $result_ct01[service_charge_value],
                'vat_charge_value' => $result_ct01[vat_charge_value],
                'address' => 'RJ',
                'phone' => $result_ct01[phone],
                'country' => $result_ct01[country],
                'message' => 'ola ruralinos',
                'currency' => $result_ct01[currency]
            ];

       print_r($result_ct01);
       print_r($data);

        $this->assertEquals($result_ct01, $data);

	}
}
