<?php
class ContratoViaWeb extends Contrato {
    private $descuento;

    public function __construct($fechaInicio, $fechaVencimiento, $objPlan, $costo, $seRennueva, $objCliente, $descuento = 10){
        parent::__construct($fechaInicio, $fechaVencimiento, $objPlan, $costo, $seRennueva, $objCliente);
        $this->descuento = $descuento;
    }

	public function getDescuento() {
		return $this->descuento;
	}

	public function setDescuento($desc) {
		$this->descuento = $desc;
	}

    public function diasContratoVencido(){
        $vencido = parent::diasContratoVencido();
        return $vencido;
    }

    public function actualizarEstadoContrato(){
        $estado = parent::actualizarEstadoContrato();
        return $estado;
    }

    //EJERCICIO 5
    public function calcularImporte() {
        $importe = parent::calcularImporte();
        return $importe * (1 - $this->getDescuento() / 100);
    }

    //EJERCICIO 4
    public function __toString(){
        $msj = parent::__toString();
        $msj .= "\nDescuento: " . $this->getDescuento();
        return $msj;
    }

}