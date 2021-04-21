<?php
require_once 'models/Image.php';
require_once 'models/Product.php';


if(isset($_GET['product_id'])){
    $product_id=$_GET['product_id'];
}
    if(isset($_GET['image_id'])){        
        $image=new Image();
        $image->find($_GET['image_id']);
        if($products=$image->getProductIdByImage()){
            foreach($products as $item){
            $product=new Product();
            $product->id=$item['product_id'];
            if(!$product->deleteImage($image)){
                return false;   
            }
            
        }
           
        }
        if($image->delete()){            
            header("Location: add_image.php".(($product_id)?"?product_id=".$product_id:false));
        }else{
            return false;
        }           
    }
       
    
    

?>