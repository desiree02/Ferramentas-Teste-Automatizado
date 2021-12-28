<?php

class DeleteOrder_test extends UnitTestCase
{
    public function setUp(): void
    {
        $this->resetInstance();        
        $this->CI->load->model('model_orders');
        $this->obj = $this->CI->model_orders;


    }
    
    //"Casos de Teste: <(BILL No, nome do cliente, telefone do cliente, data/Hora, Total de Produtos, Valor Total, status do pagamento, Opção Exclusão), resultado>"
    //CT01: <(“BILPR-5”,””, “”, “”, “”, “”, “”, ”Save Changes”), válido>
    public function test_CT01()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );        
       
        $before_remove = $this->obj->getOrdersData(47);        

        $output01 = $this->request(
            'POST', 'Orders/remove', 
                [
                    'order_id' => $before_remove['id'] 
                ]
        ); 

        $after_remove = $this->obj->getOrdersData();

        $this->assertContains($before_remove, $after_remove);

	}

    //"Casos de Teste: <(BILL No, nome do cliente, telefone do cliente, data/Hora, Total de Produtos, Valor Total, status do pagamento, Opção Exclusão), resultado>"
    //CT04: <(““”,””, “”, “”, “”, “”, “”, “Save Changes”), válido>
    public function test_CT04()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );        
       
        $before_remove = $this->obj->getOrdersData(43);        

        $output01 = $this->request(
            'POST', 'Orders/remove', 
                [
                    'order_id' => $before_remove['id'] 
                ]
        ); 

        $after_remove = $this->obj->getOrdersData();

        $this->assertContains($before_remove, $after_remove);

	}

}