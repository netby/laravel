<?php

namespace App\Http\Sections;

use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Section;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use SleepingOwl\Admin\Contracts\Initializable;
/**
 * Class PayLog
 *
 * @property \App\Admin\Model\PayLog $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class PayLog extends Section implements Initializable
{
    /**
     * @see http://sleepingowladmin.ru/docs/model_configuration#ограничение-прав-доступа
     *
     * @var bool
     */
    protected $model = '\App\Admin\Model\PayLog';

    public function initialize()
    {
        // Добавление пункта меню и счетчика кол-ва записей в разделе
        $this->addToNavigation($priority = 500);


    }

    public function getIcon()
    {
        return 'fa fa-history';
    }

    protected $checkAccess = false;

    /**
     * @var string
     */
    protected $title = 'PayLogs';

    /**
     * @var string
     */
    protected $alias = 'paylog';

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        return AdminDisplay::table()
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns(
                AdminColumn::text('id', '#')->setWidth('30px'),
                AdminColumn::link('user_name', 'Name')->setWidth('200px'),
                AdminColumn::text('pay_metod', 'Metod'),
                AdminColumn::text('sum', 'Sum'),
                AdminColumn::text('created_at', 'Create'),
                AdminColumn::text('updated_at', 'Update')
            )->paginate(20);
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        return AdminForm::panel()->addBody([
            AdminFormElement::text('name', 'Name')->setReadonly(1),
            AdminFormElement::text('sum', 'Sum'),
            AdminFormElement::text('id', 'ID')->setReadonly(1),

        ]);
    }

    /**
     * @return FormInterface
     */
    public function onCreate()
    {
        return $this->onEdit(null);
    }

    /**
     * @return void
     */
    public function onDelete($id)
    {
        // remove if unused
    }

    /**
     * @return void
     */
    public function onRestore($id)
    {
        // remove if unused
    }
}
