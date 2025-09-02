<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TestSeeder extends Seeder
{
    public function run()
    {
        $this->db->query("INSERT INTO `establishments` (`id`, `uuid`, `slug`, `name`, `description`, `active`, `created_at`, `updated_at`, `deleted_at`) VALUES (NULL, '389d5a9e-820d-11f0-9352-ae27833fd805', 'estabelecimento-teste', 'Estabelecimento Teste', 'Essa é uma breve descrição do Estabelecimento Teste', '1', '2025-08-26 01:41:20.000000', '2025-08-26 01:41:20.000000', NULL);");
        $this->db->query("INSERT INTO `menus` (`id`, `uuid`, `establishment_id`, `name`, `active`, `created_at`, `updated_at`, `deleted_at`) VALUES (NULL, '947bffdc-820d-11f0-9352-ae27833fd805', '1', 'Cardápio Teste', '1', '2025-08-26 01:44:59.000000', '2025-08-26 01:44:59.000000', NULL);");
        $this->db->query("INSERT INTO `users` (`id`, `uuid`, `establishment_id`, `name`, `email`, `password`, `role`, `remember_token`, `active`, `created_at`, `updated_at`, `deleted_at`) VALUES (NULL, 'ce6fb63e-820d-11f0-9352-ae27833fd805', '1', 'Usuário Teste', 'usuario@teste.com', '$2y$10\$RmtOSmIDo3AWTP3szW18tO0qpir95WdYgYDuAAHNt9hL18.z4wRp6', 'admin', NULL, '1', '2025-08-26 01:45:52.000000', '2025-08-26 01:45:52.000000', NULL);");
    }
}
