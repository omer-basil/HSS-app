<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'item-upload']);
        Permission::create(['name' => 'item-update']); //soft delete
        Permission::create(['name' => 'item-view']);
        Permission::create(['name' => 'item-view-list']);
        Permission::create(['name' => 'item-review-create']);
        Permission::create(['name' => 'item-review-update']);
        Permission::create(['name' => 'item-review-view']);
        Permission::create(['name' => 'item-review-delete']);
        Permission::create(['name' => 'item-order']); //this will includ the subtraction of the quantity column in "sizes" table.
        Permission::create(['name' => 'stock-update']); //update both colours and sizes
        Permission::create(['name' => 'stock-view']);
        Permission::create(['name' => 'stock-view']);
        Permission::create(['name' => 'user-view']);
        Permission::create(['name' => 'user-delete']);
        Permission::create(['name' => 'role-create']);
        Permission::create(['name' => 'role-update']);
        Permission::create(['name' => 'role-delete']);
        Permission::create(['name' => 'role-assign']); // assiging role to a user
        Permission::create(['name' => 'role-remove']); // removing role from a user
        Permission::create(['name' => 'permission-assign']); // assiging permission to a user
        Permission::create(['name' => 'permission-remove']); // removing permission from a user
        Permission::create(['name' => 'customer-create']);
        Permission::create(['name' => 'customer-view']);
        Permission::create(['name' => 'customer-list']);
        Permission::create(['name' => 'customer-update']);
        Permission::create(['name' => 'customer-delete']); // delete the customer perminantly by himself
        Permission::create(['name' => 'customer-ban']); // soft delete the customer by the staff
        Permission::create(['name' => 'order-create']);
        Permission::create(['name' => 'order-update']);
        Permission::create(['name' => 'order-view']);
        Permission::create(['name' => 'order-view-list']);
        Permission::create(['name' => 'order-accept']);
        Permission::create(['name' => 'order-delete']); // cancel the order by both customer and staff
        Permission::create(['name' => 'shipping-agent-create']);
        Permission::create(['name' => 'shipping-agent-update']);
        Permission::create(['name' => 'shipping-agent-view']);
        Permission::create(['name' => 'shipping-agent-view-list']);
        Permission::create(['name' => 'shipping-agent-delete']); // soft delete
        Permission::create(['name' => 'shipping-order']);
        Permission::create(['name' => 'tags-create']);
        Permission::create(['name' => 'tags-update']);
        Permission::create(['name' => 'tags-view']);
        Permission::create(['name' => 'tags-view-list']);
        Permission::create(['name' => 'tags-view-delete']);
        Permission::create(['name' => 'tags-add']); // tagging the items

        $role1 = Role::create(['name' => 'stock']);
        $role1->givePermissionTo('edit articles');
        $role1->givePermissionTo('delete articles');
        
    }
}
