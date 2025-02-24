<?php

namespace App\Constants;

class Permission
{

    public const PERFIL_USUARIO_VIEW = 'Visualizar Perfil de Usuário';
    public const PERFIL_USUARIO_EDIT = 'Editar Perfil de Usuário';
    public const PERFIL_USUARIO_EDIT_PASSWORD = 'Editar Senha de Usuário';

    public const EVENTOS_VIEW = 'Visualizar Eventos';
    public const EVENTOS_EDIT = 'Editar Eventos';
    public const EVENTOS_DELETE = 'Deletar Eventos';
    public const EVENTOS_CREATE = 'Criar Eventos';
    public const EVENTOS_INSCRICOES = 'Inscrições Eventos';
    public const EVENTOS = [
        self::EVENTOS_VIEW,
        self::EVENTOS_EDIT,
        self::EVENTOS_DELETE,
        self::EVENTOS_CREATE,
        self::EVENTOS_INSCRICOES,
    ];
    public const INSCRICOES_VIEW = 'Visualizar Inscrições';
    public const INSCRICOES_EDIT = 'Editar Inscrições';
    public const INSCRICOES_DELETE = 'Deletar Inscrições';
    public const INSCRICOES_CREATE = 'Criar Inscrições';
    public const INSCRICOES = [
        self::INSCRICOES_VIEW,
        self::INSCRICOES_EDIT,
        self::INSCRICOES_DELETE,
        self::INSCRICOES_CREATE,
    ];
    public const PERFIL_USUARIO = [
        self::PERFIL_USUARIO_VIEW,
        self::PERFIL_USUARIO_EDIT,
        self::PERFIL_USUARIO_EDIT_PASSWORD,
    ];
    public const PERMISSIONS = [
        'Gerenciar Perfil de Usuário' => self::PERFIL_USUARIO,
    ];

    public const SUPER_MIGRAR_DADOS = 'Super usuário migrar dados';

    public const SUPERPERMISSIONS = [
        'Gerenciamento de Banco de Dados' => self::SUPER_MIGRAR_DADOS,
    ];
}
