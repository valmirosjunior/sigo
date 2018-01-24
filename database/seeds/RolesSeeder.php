<?php

use App\Models\Expensive\Expense;
use App\Models\Customer;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::updateOrCreate(
            [
                'id' => 1
            ],
            [
                'id' => 1,
                'name' => User::READ_USER,
                'display' => 'Regra possibilita usuários ter acesso aos usuários do sistema.',
                'sub_module_id' => 1
            ]
        );

        Role::updateOrCreate(
            [
                'id' => 2
            ],
            [
                'id' => 2,
                'name' => User::STORE_USER,
                'display' => 'Regra possibilita usuários criar novos usuários',
                'sub_module_id' => 1
            ]
        );

        Role::updateOrCreate(
            [
                'id' => 3
            ],
            [
                'id' => 3,
                'name' => User::UPDATE_USER,
                'display' => 'Regra possibilita usuários atualizar usuários existentes',
                'sub_module_id' => 1
            ]
        );

        Role::updateOrCreate(
            [
                'id' => 4
            ],
            [
                'id' => 4,
                'name' => User::DELETE_USER,
                'display' => 'Regra possibilita usuários removerem usuários existentes.',
                'sub_module_id' => 1
            ]
        );

        Role::updateOrCreate(
            [
                'id' => 5
            ],
            [
                'id' => 5,
                'name' => Expense::READ_EXPENSE,
                'display' => '',
                'sub_module_id' => 3
            ]
        );


        Role::updateOrCreate(
            [
                'id' => 6
            ],
            [
                'id' => 6,
                'name' => Expense::STORE_EXPENSE,
                'display' => '',
                'sub_module_id' => 3
            ]
        );

        Role::updateOrCreate(
            [
                'id' => 7
            ],
            [
                'id' => 7,
                'name' => Expense::UPDATE_EXPENSE,
                'display' => '',
                'sub_module_id' => 3
            ]
        );

        Role::updateOrCreate(
            [
                'id' => 8
            ],
            [
                'id' => 8,
                'name' => Expense::DELETE_EXPENSE,
                'display' => '',
                'sub_module_id' => 3
            ]
        );

        Role::updateOrCreate(
            [
                'id' => 9
            ],
            [
                'id' => 9,
                'name' => Customer::READ_CUSTOMER,
                'display' => 'Regra possibilita usuários ter acesso aos clientes do sistema.',
                'sub_module_id' => 2
            ]
        );

        Role::updateOrCreate(
            [
                'id' => 10
            ],
            [
                'id' => 10,
                'name' => Customer::STORE_CUSTOMER,
                'display' => 'Regra possibilita usuários criar novos clientes',
                'sub_module_id' => 2
            ]
        );

        Role::updateOrCreate(
            [
                'id' => 11
            ],
            [
                'id' => 11,
                'name' => Customer::UPDATE_CUSTOMER,
                'display' => 'Regra possibilita usuários atualizar novos clientes',
                'sub_module_id' => 2
            ]
        );

        Role::updateOrCreate(
            [
                'id' => 12
            ],
            [
                'id' => 12,
                'name' => Customer::DELETE_CUSTOMER,
                'display' => 'Regra possibilita usuários criar novos clientes',
                'sub_module_id' => 2
            ]
        );
    }
}
