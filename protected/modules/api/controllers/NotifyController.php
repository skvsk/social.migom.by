<?php

/**
 * Notifycation
 * @package api
 */
class NotifyController extends ApiController
{

    const CONTENT_IS_UPDATE = 'update';

    /**
     * Subscription renewal price
     * @param int $id Product id
     * @param float $cost Product cost
     * @param int $user_id User id
     */
    public function actionPostProductCost($id)
    {
        $model = new NotifyProductCost();
        $model->product_id = $id;
        $model->cost = (float)$_POST['cost'];
        $model->user_id = $_POST['user_id'];
        $model->save();
    }

    /**
     * Subscription to the appearance of the product on sale
     * @param int $id Product id
     * @param float $cost Product cost
     * @param int $user_id User id
     */
    public function actionPostProduct($id)
    {
        $model = new NotifyProductCost();
        $model->product_id = $id;
        $model->user_id = $_POST['user_id'];
        $model->save();
    }

}