<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CerrarCajaMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $ventasTotales;
    public $utilidades;
    public $fecha_hora_cierre;

    public function __construct($ventasTotales, $utilidades, $fecha_hora_cierre)
    {
        $this->ventasTotales = $ventasTotales;
        $this->utilidades = $utilidades;
        $this->fecha_hora_cierre = $fecha_hora_cierre;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.cerrar');
    }
}
