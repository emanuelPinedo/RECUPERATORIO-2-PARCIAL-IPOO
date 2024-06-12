<?php
/*
 
Adquirir un plan implica un contrato. Los contratos tienen la fecha de inicio, la fecha de vencimiento, el plan, un estado (al día, moroso, suspendido), un costo, si se renueva o no y una referencia al cliente que adquirió el contrato.
*/
class Contrato{
    
    //ATRIBUTOS
    private $fechaInicio;   
    private $fechaVencimiento;
    private $objPlan;
    private $estado;  //al día, moroso, suspendido
    private $costo;
    private $seRennueva;
    private $objCliente;

 //CONSTRUCTOR
    public function __construct($fechaInicio, $fechaVencimiento, $objPlan,$costo,$seRennueva,$objCliente){
    
       $this->fechaInicio = $fechaInicio;
       $this->fechaVencimiento = $fechaVencimiento;
       $this->objPlan = $objPlan;
       $this->estado = 'AL DIA';
       $this->costo = $costo;
       $this->seRennueva = $seRennueva;
       $this->objCliente = $objCliente;
           
     }


     public function getFechaInicio(){
        return $this->fechaInicio;
     }

     public function setFechaInicio($fechaInicio){
         $this->fechaInicio= $fechaInicio;
     }

     public function getFechaVencimiento(){
        return $this->fechaVencimiento;
     }

     public function setFechaVencimiento($fechaVencimiento){
         $this->fechaVencimiento= $fechaVencimiento;
     }


     public function getObjPlan(){
        return $this->objPlan;
     }

     public function setObjPlan($objPlan){
         $this->objPlan= $objPlan;
     }

     public function getEstado(){
        return $this->estado;
     }

     public function setEstado($estado){
         $this->estado= $estado;
     }

     public function getCosto(){
        return $this->costo;
     }

    public function setCosto($costo){
         $this->costo= $costo;
     }

     public function getSeRennueva(){
        return $this->seRennueva;
     }

    public function setSeRennueva($seRennueva){
         $this->seRennueva= $seRennueva;
     }

     public function getObjCliente(){
        return $this->objCliente;
     }

    public function setObjCliente($objCliente){
         $this->objCliente= $objCliente;
     }

    //EJERCICIO 1
    public function diasContratoVencido() {
     $fechaHoy = new DateTime();
     if ($fechaHoy > $this->getFechaVencimiento()) {
          $fechaHoy->diff($this->getFechaVencimiento())->days;//days propiedad del metodo diff
     } else {
         $fechaHoy = 0;
     }
     return $fechaHoy;
     }

     //EJERCICIO 2
     public function actualizarEstadoContrato(){
          $diasVencimiento = $this->diasContratoVencido();
          if($diasVencimiento > 0 && $diasVencimiento <=10){
               $this->setEstado('MOROSO');
          } elseif($diasVencimiento > 10){
               $this->setEstado('SUSPENDIDO');
          } else {
               $this->setEstado('AL DIA');
          }
     }

     //EJERCICIO 5
     public function calcularImporte(){
          $importe = $this->getObjPlan()->getImporte();
          foreach($this->getObjPlan()->getColCanales() as $canales){
               $importe += $canales->getImporte();
               if($this->getEstado() === 'MOROSO' || $this->getEstado() === 'SUSPENDIDO'){
                    $diasDemora = $this->diasContratoVencido();
                    $multa = $importe * 0.10 * $diasDemora;
                    $importe += $multa;
               }
          }
          return $importe;
     }

     public function __toString(){
          //string $cadena
          if ($this->getSeRennueva()) {
               $renueva = "Si renueva";
             } else {
               $renueva = "No renueva";
             }
             $cadena = "Fecha inicio: ".$this->getFechaInicio()->format('Y-m-d')."\n";
             $cadena .= "Fecha Vencimiento: ".$this->getFechaVencimiento()->format('Y-m-d')."\n";
             $cadena .= "Plan: ".$this->getObjPlan()."\n";
             $cadena .= "Estado: ".$this->getEstado()."\n";
             $cadena .= "Costo: ".$this->getCosto()."\n";
             $cadena .= "Se renueva: ".$renueva."\n";
             $cadena .= "Cliente: ".$this->getObjCliente()."\n";
             return $cadena;
     }
}    