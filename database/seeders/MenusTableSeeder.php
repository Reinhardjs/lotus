<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class MenusTableSeeder extends Seeder
{
    private $menuId = null;
    private $dropdownId = array();
    private $dropdown = false;
    private $sequence = 1;
    private $joinData = array();
    private $adminRole = null;
    private $userRole = null;
    private $subFolder = '';

    public function join($roles, $menusId)
    {
        $roles = explode(',', $roles);
        foreach ($roles as $role) {
            array_push($this->joinData, array('role_name' => $role, 'menus_id' => $menusId));
        }
    }

    /*
        Function assigns menu elements to roles
        Must by use on end of this seeder
    */
    public function joinAllByTransaction()
    {
        DB::beginTransaction();
        foreach ($this->joinData as $data) {
            DB::table('menu_role')->insert([
                'role_name' => $data['role_name'],
                'menus_id' => $data['menus_id'],
            ]);
        }
        DB::commit();
    }

    public function insertLink($roles, $name, $href, $icon = null)
    {
        $href = $this->subFolder . $href;
        if ($this->dropdown === false) {
            DB::table('menus')->insert([
                'slug' => 'link',
                'name' => $name,
                'icon' => $icon,
                'href' => $href,
                'menu_id' => $this->menuId,
                'sequence' => $this->sequence
            ]);
        } else {
            DB::table('menus')->insert([
                'slug' => 'link',
                'name' => $name,
                'icon' => $icon,
                'href' => $href,
                'menu_id' => $this->menuId,
                'parent_id' => $this->dropdownId[count($this->dropdownId) - 1],
                'sequence' => $this->sequence
            ]);
        }
        $this->sequence++;
        $lastId = DB::getPdo()->lastInsertId();
        $this->join($roles, $lastId);
        $permission = Permission::where('name', '=', $name)->get();
        if (empty($permission)) {
            $permission = Permission::create(['name' => 'visit ' . $name]);
        }
        $roles = explode(',', $roles);
        if (in_array('user', $roles)) {
            $this->userRole->givePermissionTo($permission);
        }
        if (in_array('admin', $roles)) {
            $this->adminRole->givePermissionTo($permission);
        }
        return $lastId;
    }

    public function insertTitle($roles, $name)
    {
        DB::table('menus')->insert([
            'slug' => 'title',
            'name' => $name,
            'menu_id' => $this->menuId,
            'sequence' => $this->sequence
        ]);
        $this->sequence++;
        $lastId = DB::getPdo()->lastInsertId();
        $this->join($roles, $lastId);
        return $lastId;
    }

    public function beginDropdown($roles, $name, $icon = '')
    {
        if (count($this->dropdownId)) {
            $parentId = $this->dropdownId[count($this->dropdownId) - 1];
        } else {
            $parentId = null;
        }
        DB::table('menus')->insert([
            'slug' => 'dropdown',
            'name' => $name,
            'icon' => $icon,
            'menu_id' => $this->menuId,
            'sequence' => $this->sequence,
            'parent_id' => $parentId
        ]);
        $lastId = DB::getPdo()->lastInsertId();
        array_push($this->dropdownId, $lastId);
        $this->dropdown = true;
        $this->sequence++;
        $this->join($roles, $lastId);
        return $lastId;
    }

    public function endDropdown()
    {
        $this->dropdown = false;
        array_pop($this->dropdownId);
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Get roles */
        $this->adminRole = Role::where('name', '=', 'admin')->first();
        $this->userRole = Role::where('name', '=', 'user')->first();
        /* Create Sidebar menu */
        DB::table('menulist')->insert([
            'name' => 'sidebar menu'
        ]);
        $this->menuId = DB::getPdo()->lastInsertId();  //set menuId
        $this->insertLink('guest,user,admin,role1,role3,role4,role5', 'Dashboard', '/', 'cil-speedometer');

        // $this->beginDropdown('admin', 'Settings', 'cil-calculator');
        //     $this->insertLink('admin', 'Notes',                   '/notes');
        //     $this->insertLink('admin', 'Users',                   '/users');
        //     $this->insertLink('admin', 'Edit menu',               '/menu/menu');
        //     $this->insertLink('admin', 'Edit menu elements',      '/menu/element');
        //     $this->insertLink('admin', 'Edit roles',              '/roles');
        //     $this->insertLink('admin', 'Media',                   '/media');
        //     $this->insertLink('admin', 'BREAD',                   '/bread');
        //     $this->insertLink('admin', 'Email',                   '/mail');
        // $this->endDropdown();

        $this->insertLink('guest', 'Login', '/login', 'cil-account-logout');
        $this->insertLink('guest', 'Register', '/register', 'cil-account-logout');

        $this->insertTitle('admin', 'Seksi Penindakan dan Penyidikan');

        $this->beginDropdown('role1,admin', 'Intelijen', 'cil-pencil');
        $this->insertLink('role1,admin', 'Profil pengguna jasa', '/intelijen/profil_pengguna_jasa');
        $this->insertLink('role1,admin', 'Data impor dan ekspor', '/submenu');
        $this->insertLink('role1,admin', 'Peta kerawanan BKC ilegal', '/intelijen/peta_kerawanan_bkc_ilegal');
        $this->insertLink('role1,admin', 'Peta kerawanan lundup laut', '/submenu');
        $this->insertLink('role1,admin', 'Data pelabuhan dan bandara', '/submenu');
        $this->endDropdown();

        $this->beginDropdown('role1,admin', 'Penindakan', 'cil-pencil');
        $this->insertLink('role1,admin', 'Penindakan BKC ilegal', '/submenu');
        $this->insertLink('role1,admin', 'Pemeriksaan kapal', '/submenu');
        $this->insertLink('role1,admin', 'Patroli', '/submenu');
        $this->insertLink('role1,admin', 'Sarana operasi', '/submenu');
        $this->insertLink('role1,admin', 'Penyegelan', '/submenu');
        $this->endDropdown();

        $this->beginDropdown('role1,admin', 'Penyidikan', 'cil-pencil');
        $this->insertLink('role1,admin', 'Perkembangan penyidikan', '/submenu');
        $this->insertLink('role1,admin', 'Tindak lanjut penindakan', '/submenu');
        $this->insertLink('role1,admin', 'Pengelolaan BHP', '/submenu');
        $this->endDropdown();

        $this->beginDropdown('role1,admin', 'Narkotika', 'cil-pencil');
        $this->insertLink('role1,admin', 'Peta kerawanan (landing spot)', '/submenu');
        $this->insertLink('role1,admin', 'Data PJT', '/submenu');
        $this->insertLink('role1,admin', 'Kapal nelayan', '/submenu');
        $this->endDropdown();

        $this->insertTitle('role2,admin', 'Seksi Kepatuhan Internal dan Penyuluhan');
        $this->beginDropdown('role2,admin', 'Kinerja', 'cil-pencil');
        $this->insertLink('role2,admin', 'Dashboard', '/kinerja/dashboard');
        $this->insertLink('role2,admin', 'Indikator Kerja Utama', '/kinerja/indikator_kerja_utama');
        $this->insertLink('role2,admin', 'Analisis IKU', '/kinerja/analisis_iku');
        $this->endDropDown();


        $this->insertTitle('admin', 'Seksi Perbendaharaan');

        $this->beginDropdown('role3,admin', 'Manifes', 'cil-pencil');
        $this->insertLink('role3,admin', 'Inward Manifes', '/submenu');
        $this->insertLink('role3,admin', 'Outward Manifes', '/submenu');
        $this->endDropdown();

        $this->beginDropdown('role3,admin', 'Penerimaan', 'cil-pencil');
        $this->insertLink('role3,admin', 'Realisasi Penerimaan Bea Masuk', '/submenu');
        $this->insertLink('role3,admin', 'Realisasi Penerimaan Bea Keluar', '/submenu');
        $this->endDropdown();

        $this->insertTitle('admin', 'Seksi Pelayanan Kepabeanan dan Cukai dan Dukungan Teknis');
        $this->insertLink('role4,admin', 'BMN', '/menu');

        $this->insertTitle('admin', 'Subbagian umum');
        $this->insertLink('role5,admin', 'Aset', '/menu');


        /* Create top menu */
        DB::table('menulist')->insert([
            'name' => 'top menu'
        ]);
        $this->menuId = DB::getPdo()->lastInsertId();  //set menuId
        $this->beginDropdown('guest,user,admin', 'Pages');
        $id = $this->insertLink('guest,user,admin', 'Dashboard',    '/');
        $id = $this->insertLink('user,admin', 'Notes',              '/notes');
        $id = $this->insertLink('admin', 'Users',                   '/users');
        $this->endDropdown();
        $id = $this->beginDropdown('admin', 'Settings');

        $id = $this->insertLink('admin', 'Edit menu',               '/menu/menu');
        $id = $this->insertLink('admin', 'Edit menu elements',      '/menu/element');
        $id = $this->insertLink('admin', 'Edit roles',              '/roles');
        $id = $this->insertLink('admin', 'Media',                   '/media');
        $id = $this->insertLink('admin', 'BREAD',                   '/bread');
        $this->endDropdown();

        $this->joinAllByTransaction(); ///   <===== Must by use on end of this seeder
    }
}
