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
 * Class Users
 *
 * @property \App\User $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Users extends Section implements Initializable
{
    /**
     * @var \App\User
     */
    protected $model = '\App\User';
    /**
     * @see http://sleepingowladmin.ru/docs/model_configuration#ограничение-прав-доступа
     *
     * @var bool
     */
    public function initialize()
    {
        // Добавление пункта меню и счетчика кол-ва записей в разделе
        $this->addToNavigation($priority = 500);


    }
    protected $checkAccess = false;

    /**
     * @var string
     */
    protected $title = 'Users';

    /**
     * @var string
     */

    protected $alias = 'user';
    /**
     * @return string
     */
    public function getIcon()
    {
        return 'fa fa-users';
    }
    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        return AdminDisplay::table('users')
        ->setHtmlAttribute('class', 'table-primary')
            ->setColumns(
                AdminColumn::text('id', '#')->setWidth('30px'),
                AdminColumn::link('name', 'Name')->setWidth('200px'),
                AdminColumn::text('email', 'Email'),
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
            AdminFormElement::text('name', 'Name')->required(),
            AdminFormElement::text('email', 'Email')->required(),
            AdminFormElement::text('id', 'ID')->setReadonly(1),

        ]);
    }

    /**
     * @return FormInterface
     */
    public function onCreate()
    {
        return AdminForm::panel()->addBody([
            AdminFormElement::text('name', 'Name')->required(),
            AdminFormElement::text('email', 'Email')->required(),
            AdminFormElement::text('password', 'Password')->required(),

        ]);
    }

    /**
     * @return void
     */
    public function onDelete($id)
    {
        // remove if unused
    }

}
