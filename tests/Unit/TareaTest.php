<?php

namespace Tests\Unit;

use App\Models\Tarea;
use App\Models\User;
use Tests\TestCase;

class TareaTest extends TestCase
{
    public function test_tarea_tiene_usuario_asociado()
    {
        $usuario = User::factory()->make();
        $tarea = Tarea::make(['user_id' => $usuario->id]);

        $tarea->setRelation('user', $usuario);

        $this->assertInstanceOf(User::class, $tarea->user);
    }

    public function test_tarea_es_incompleta_por_defecto()
    {
        $tarea = Tarea::make();
        $this->assertNull($tarea->completada);
    }
}
