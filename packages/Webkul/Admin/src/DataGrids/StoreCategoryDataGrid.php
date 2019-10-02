<?php

namespace Webkul\Admin\DataGrids;

use Webkul\Ui\DataGrid\DataGrid;
use DB;

/**
 * StoreDataGrid Class
 *
 * @author Khaled Badenjki <m.k.badenjki@gmail.com>
 * @copyright 2019 Doukank Pvt Ltd (https://www.doukank.com)
 */
class StoreCategoryDataGrid extends DataGrid
{
    protected $sortOrder = 'desc'; //asc or desc

    protected $index = 'id';

    protected $itemsPerPage = 20;

    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('store_categories')
            ->leftJoin('store_category_translations', 'store_category_translations.store_category_id', '=', 'store_categories.id')
            ->select('store_categories.id as id', 'store_category_translations.name as name', 'store_categories.code as code')
            ->where('locale', app()->getLocale());

        $this->setQueryBuilder($queryBuilder);
    }

    public function addColumns()
    {
        $this->addColumn([
            'index' => 'id',
            'label' => trans('admin::app.datagrid.id'),
            'type' => 'number',
            'searchable' => false,
            'sortable' => true,
            'filterable' => true
        ]);

        $this->addColumn([
            'index' => 'name',
            'label' => trans('admin::app.datagrid.category-name'),
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true
        ]);

        $this->addColumn([
            'index' => 'code',
            'label' => trans('admin::app.datagrid.code'),
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true
        ]);

    }

    public function prepareActions() {
        $this->addAction([
            'type' => 'Edit',
            'method' => 'GET', // use GET request only for redirect purposes
            'route' => 'admin.marketplace.categories.edit',
            'icon' => 'icon pencil-lg-icon'
        ]);

        $this->addAction([
            'type' => 'Delete',
            'method' => 'POST', // use GET request only for redirect purposes
            'route' => 'admin.marketplace.categories.delete',
            'confirm_text' => trans('ui::app.datagrid.massaction.delete', ['resource' => 'seller']),
            'icon' => 'icon trash-icon'
        ]);

        $this->enableAction = true;
    }

//    public function prepareMassActions() {
//        $this->addMassAction([
//            'type' => 'delete',
//            'label' => 'Delete',
//            'action' => route('admin.catalog.products.massdelete'),
//            'method' => 'DELETE'
//        ]);
//
//        $this->addMassAction([
//            'type' => 'update',
//            'label' => 'Update Status',
//            'action' => route('admin.catalog.products.massupdate'),
//            'method' => 'PUT',
//            'options' => [
//                'Active' => 1,
//                'Inactive' => 0
//            ]
//        ]);
//
//        $this->enableMassAction = true;
//    }
}