<?php

namespace App\Constants;

class PermissionRolesConstants
{
    // SuperAdmin
    public const SUPERADM = Permission::PERMISSIONS;

    // Admin
    public const ADMIN = [
        Permission::PERFIL_USUARIO,
        Permission::EVENTOS,
    ];

    // Participante
    public const Participante = [
        Permission::INSCRICOES,
    ];
}
