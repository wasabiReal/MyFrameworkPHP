<?php

namespace app\models;

use RedBeanPHP\R;

class Cart extends AppModel
{

    public function getProduct($id, $lang):array
    {
        return R::getRow("SELECT p.*, pd.* FROM product p JOIN product_description pd on p.id = pd.product_id 
        WHERE p.status = 1 AND p.id = ? AND pd.language_id = ?", [$id, $lang['id']]);

    }

    public function addtoCart($prod, $qty = 1)
    {
        $qty = abs($qty);

        if($prod['is_download'] && isset($_SESSION['cart'][$prod['id']])){
            return false;
        }

        if(isset($_SESSION['cart'][$prod['id']])){
            $_SESSION['cart'][$prod['id']]['qty'] += $qty;
        }else{
            if($prod['is_download']){
                $qty = 1;
            }
            $_SESSION['cart'][$prod['id']] = [
                'title' => $prod['title'],
                'slug' => $prod['slug'],
                'price' => $prod['price'],
                'qty' => $qty,
                'img' => $prod['img'],
                'is_download' => $prod['is_download'],
            ];
        }

        $_SESSION['cart.qty'] = !empty($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] + $qty : $qty;
        $_SESSION['cart.sum'] = !empty($_SESSION['cart.sum']) ? $_SESSION['cart.sum'] + $qty * $prod['price'] : $qty * $prod['price'];
    }

    public function deleteItem($id)
    {
        $qty_minus = $_SESSION['cart'][$id]['qty'];
        $sum_minus = $_SESSION['cart'][$id]['qty'] * $_SESSION['cart'][$id]['price'];
        $_SESSION['cart.qty'] -= $qty_minus;
        $_SESSION['cart.sum'] -= $sum_minus;
        unset($_SESSION['cart'][$id]);
    }

    public static function translateCart($lang)
    {
        if(empty($_SESSION['cart'])){
            return;
        }
        $ids = implode(',', array_keys($_SESSION['cart']));
        $products = R::getAll("SELECT p.id, pd.title FROM product p JOIN product_description pd on p.id = pd.product_id
        WHERE p.id IN ($ids) AND pd.language_id = ?", [$lang['id']]);
        foreach ($products as $product){
            $_SESSION['cart'][$product['id']]['title'] = $product['title'];
        }
    }
}