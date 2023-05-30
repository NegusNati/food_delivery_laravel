<?php

namespace App\Admin\Controllers;

use App\Models\Order;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Food;
// use App\Models\OrderDetails;


use Encore\Admin\Layout\Content;


class OrderAdmin extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'orders';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {



        $grid = new Grid(new Order());
        $grid->model()->latest();
        $grid->column('id', __('Id'));
        $grid->column('user_id', __('User Id'));
        $grid->column('order_amount', __('Order Amount'));
        $grid->column('order_status', __('Order Status'));
        $grid->column('delivered', __('Delivered'));
        $grid->column('accepted', __('Customer Name'));
        $grid->column('schduled', __('Customer Number'));
        $grid->column('processing', __('Customer Address'));
        $grid->column('handover', __('Customer Longitude'));
        $grid->column('pending', __('Customer Latitude'));
        $grid->column('delivery_address', __('delivery_address'))->style('max-width:200px;word-break:break-all;')->display(function ($val){
            return substr($val,0,30);
        });


        $grid->column('created_at', __('Created_At'));
        $grid->column('updated_at', __('Updated_at'));


        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        //might put Table= order in the moel
        $show = new Show(Order::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {

        $form = new Form(new Order());
        $form->text('order_status', __('Order Status'));

        $form->text('delivered', __('Delivered'));




        return $form;
    }
}
