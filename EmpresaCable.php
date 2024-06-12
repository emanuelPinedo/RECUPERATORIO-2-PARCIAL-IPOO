<?php
//EJERCICIO 6
class EmpresaCable{
    private $colPlanes;
    private $colContratosRealizados;

    public function __construct($colPlanes, $colContratosRealizados){
        $this->colPlanes = $colPlanes;
        $this->colContratosRealizados = $colContratosRealizados;
    }

    public function getColPlanes(){
        return $this->colPlanes;
    }

    public function setColPlanes($colPlanes){
        $this->colPlanes = $colPlanes;
    }

    public function getColContratosRealizados(){
        return $this->colContratosRealizados;
    }

    public function setColContratosRealizados($colContratosRealizados){
        $this->colContratosRealizados = $colContratosRealizados;
    }

    //EJERCICIO A
    public function incorporarPlan($objPlan){
        $colecPlanes = $this->getColPlanes();
        $plan = false;
        foreach ($colecPlanes as $planActual) {
           if ($objPlan->getIncluyeMG() === $planActual->getIncluyeMG() && $objPlan->getColCanales() === $planActual->getColCanales()){
            $plan = true;
           } 
        }
        if (!$plan) {
            $colePlanes[] = $objPlan;
           $this->setColPlanes($colePlanes);
        }
    }
    
    //EJERCICIO B
    public function incorporarContrato($objPlan, $objCliente, $fechaInicio, $fechaVencimiento, $contratoWeb) {
        $importe = $objPlan->getImporte();
    
        if ($contratoWeb) {
            $contrato = new ContratoViaWeb($fechaInicio, $fechaVencimiento, $objPlan, $importe, true, $objCliente);
        } else {
            $contrato = new Contrato($fechaInicio, $fechaVencimiento, $objPlan, $importe, true, $objCliente);
        }
    
        $colContratos = $this->getColContratosRealizados();
        $colContratos[] = $contrato;
        $this->setColContratosRealizados($colContratos);
    
        return $contrato;
    }

    //EJERCICIO C
    public function retornarImporteContratos($codPlan){
        $importe = 0;
        foreach($this->getColContratosRealizados() as $contratos){
            if($contratos->getObjPlan()->getCodigo() === $codPlan){
                $importe += $contratos->getCosto();
            }
        }
        return $importe;
    }

    //EJERCICIO D
    public function pagarContrato($contrato){
        $contrato->actualizarEstadoContrato();
        $importe =  $contrato->calcularImporte();
        return $importe;
    }

    public function darArrays(){
        $planes = "Planes: \n";
        foreach ($this->getColPlanes() as $plan) {
            $planes .= $plan . "\n";
        }

        $contratos = "Contratos: \n";
        foreach ($this->getColContratosRealizados() as $contrato) {
            $contratos .= $contrato . "\n";
        }
        return $planes . $contratos;
    }

    public function __toString(){
        return $this->darArrays();
    }

}

?>