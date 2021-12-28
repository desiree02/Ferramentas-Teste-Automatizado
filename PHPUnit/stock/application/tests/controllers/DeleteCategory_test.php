<?php

class DeleteCategory_test extends UnitTestCase
{
    public function setUp(): void
    {
        $this->resetInstance();        
        $this->CI->load->model('model_category');
        $this->obj = $this->CI->model_category;
    }

    //CT01: <(“novos horarios”, “”, ”Save Changes”), válido>
	public function test_CT01()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );
        
        $before_remove = $this->obj->getCategoryData(4); 
        
        $output01 = $this->request(
            'POST', 'Category/remove', 
                [
                    'category_id' => $before_remove['id'] 
                ]
        );

        $after_remove = $this->obj->getCategoryData();

       // print_r($before_remove);
       // print_r($after_remove);
       
        $this->assertContains($before_remove, $after_remove);
	}

    //CT04: <(“”, “Active”, Save Changes”), válido>
    public function test_CT04()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );
        
        $before_remove = $this->obj->getActiveCategroy(); 
        $before_remove_first =  $before_remove[0];
        $before_remove_id =  $before_remove[0]['id'];
        $before_remove_status =  $before_remove[0]['active'];
        
        $output01 = $this->request(
            'POST', 'Category/remove', 
                [
                    'category_id' => $before_remove_id
                ]
        );

        $after_remove = $this->obj->getCategoryData();

       // print_r($before_remove);
       // print_r($after_remove);
       
        $this->assertContains($before_remove_first, $after_remove);
	}

}
