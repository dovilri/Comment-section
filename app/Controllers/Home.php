<?php

namespace App\Controllers;

use Exception;

class Home extends BaseController
{
    public function index()
    {
        $homemodel = model('home');
        if($this->request->getMethod()== 'post'){
            

            $comment = [
                'rating' => $this->request->getPost('rating'),
                'username' => $this->request->getPost('username'),
                'comment' => $this->request->getPost('comment')
            ];

            if(  $homemodel->save($comment) ) {
                return redirect()->to('/home')->with('info', 'Successfully commented');
                
            }
            else{
                return redirect()->to('/home')->with('errors' , $homemodel->errors());
            }

        }

        $comments = $homemodel->findAll();
        helper('form');
        return view('/home/index' , ['comments' => $comments]);
        
    }
}

?>