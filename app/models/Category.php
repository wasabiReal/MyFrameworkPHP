<?php

namespace app\models;

use RedBeanPHP\R;
use wsb\App;

class Category extends AppModel
{

    public function get_category($slug, $lang): array
    {
        return R::getRow("SELECT c.*, cd.* FROM category c JOIN category_desc cd on c.id = cd.category_id WHERE c.slug = ? AND cd.language_id = ?", [$slug, $lang['id']]);
    }

    public function get_ids($id): string
    {
        $lang = App::$app->getProperty('language')['code'];
        $categories = App::$app->getProperty("categories_{$lang}");
        $ids = '';

        foreach ($categories as $k => $v) {
            if ($v['parent_id'] == $id) {
                $ids .= $k . ',';
                $ids .= $this->get_ids($k);
            }
        }
        return $ids;
    }

    public function get_products($ids, $lang, $start, $perpage): array
    {
        $sort_values = [
            'title_asc' => 'ORDER BY title ASC',
            'title_desc' => 'ORDER BY title DESC',
            'price_asc' => 'ORDER BY price ASC',
            'price_desc' => 'ORDER BY price DESC',
        ];

        $order_buy = '';
        if(isset($_GET['sort']) && array_key_exists($_GET['sort'], $sort_values)){
            $order_buy = $sort_values[$_GET['sort']];

        }

        return R::getAll("SELECT p.*, pd.* FROM product p JOIN product_description pd on p.id = pd.product_id WHERE p.status = 1 AND p.category_id IN ($ids) AND pd.language_id = ? $order_buy LIMIT $start, $perpage", [$lang['id']]);
    }

    public function get_count_products($ids): int
    {
        return R::count("product", "category_id IN ($ids) AND status = 1");
    }

}