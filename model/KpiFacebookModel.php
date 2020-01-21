<?php
/*require_once("Database.php");
class KpiFacebookModel{

    public $kpisFacebook;
    //contendra toda la informacion sobre los kpi que se desee procesar
    public $entityAllInfoKpi;
    public $infokpishares;
    public $infokpiReactions;
    public $infokpiComments;
    public $infokpiVideosViews;
    public $infokpiLinkClicks;
    public $infokpiReach;
    public $infokpiReachPaid;
    public $infokpiReachOrganic;
    public $infokpiInteractions;
    public $infokpiInvestment;
    public $infokpiInteractionIndex;
    public $infokpiInterAlcanceIndex;
    public $infokpiInteractionInvestmentIndex;
    public $infokpiInterAlcanceInvestmentIndex;
    //kpi Principal
    public $infokpiPrincipal;
    public $InfokpiPrincipalIndex;
    public $infokpiPrincipalInvestmentIndex;
    public $infoCostokpiPrincipalByAction;

    public function __construct(){
        $this->infokpishares=array();
        $this->infokpiReactions=array();
        $this->infokpiComments=array();
        $this->infokpiVideosViews=array();
        $this->infokpiLinkClicks=array();
        $this->infokpiReach=array();
        $this->infokpiReachPaid=array();
        $this->infokpiReachOrganic=array();
        $this->infokpiInteractions=array();
        $this->infokpiInvestment=array();
        $this->infokpiInteractionIndex=array();
        $this->infokpiInterAlcanceIndex=array();
        $this->infokpiInteractionInvestmentIndex=array();
        $this->infokpiInterAlcanceInvestmentIndex=array();
        //kpi Principal
        $this->infokpiPrincipal=array();
        $this->InfokpiPrincipalIndex=array();
        $this->infokpiPrincipalInvestmentIndex=array();
        $this->infoCostokpiPrincipalByAction=array();
    }

    public function setKPIsFacebook(){
        $con = Database::getInstance();
		$sql = "SELECT * FROM ssg_kpi  WHERE grupo='ssg_facebook'";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $this->kpis = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function setEntityInfo($array_info){
        $this->entityAllInfoKpi=$array_info;
    }

    public function setInfoAllKpis(){
        $this->setInfokpiShares();
        $this->setInfokpiReactions();
        $this->setInfokpiComments();
        $this->setInfokpiVideosViews();
        $this->setInfokpiLinkClicks();
        $this->setInfokpiReach();
        $this->setInfokpiReachPaid();
        $this->setInfokpiReachOrganic();
        $this->setInfokpiInteractions();
        $this->setInfokpiInvestment();
        $this->setInfokpiInteractionIndex();
        $this->setInfokpiInterAlcanceIndex();
        $this->setInfokpiInteractionInvestmentIndex();
        $this->setInfokpiInterAlcanceInvestmentIndex();
    }
   
    public function setInfokpiShares(){
        foreach($this->entityAllInfoKpi as $value){
            $this->infokpiShares[]=intval($value["shares"]);
        }
    }
    public function setInfokpiReactions(){
        foreach($this->entityAllInfoKpi as $value){
            $this->infokpiReactions[]=intval($value["reactions"]);
        }
    }
    public function setInfokpiComments(){
        foreach($this->entityAllInfoKpi as $value){
            $this->infokpiComments[]=intval($value["comments"]);
        }
    }
    public function setInfokpiVideosViews(){
        foreach($this->entityAllInfoKpi as $value){
            $this->infokpiVideosViews[]=intval($value["post_video_views_unique"]);
        }
    }
    public function setInfokpiLinkClicks(){
        foreach($this->entityAllInfoKpi as $value){
            $this->infokpiLinkClicks[]=intval($value["link_clicks"]);
        }
    }
    public function setInfokpiReach(){
        foreach($this->entityAllInfoKpi as $value){
            $this->infokpiReach[]=intval($value["reach"]);
        }
    }
    public function setInfokpiReachPaid(){
        foreach($this->entityAllInfoKpi as $value){
            $this->infokpiReachPaid[]=intval($value["reach_paid"]);
        }
    }
    public function setInfokpiReachOrganic(){
        foreach($this->entityAllInfoKpi as $value){
            $this->infokpiReachOrganic[]=intval($value["reach_organic"]);
        }
    }
    public function setInfokpiInteractions(){
        foreach($this->entityAllInfoKpi as $value){
            $this->infokpiInteractions[]=intval($value["link_clicks"]+$value["shares"]+$value["reactions"]+$value["comments"]+$value["post_video_views_unique"]);
        }
    }
    public function setInfokpiInvestment($factor=1){
        //el factor se usará en caso de agragar impuestos u otros valores propios de ciertas compañias
        foreach($this->entityAllInfoKpi as $value){
            $this->infokpiInvestment[]=floatval($value["ad_spend"])*$factor;
        }
    }
    public function setInfokpiInteractionIndex(){
        foreach($this->entityAllInfoKpi as $value){
            $this->infokpiInteractionIndex[]=floatval($value["indice_interaccion"]);
        }
    }
    public function setInfokpiInterAlcanceIndex(){
        foreach($this->entityAllInfoKpi as $value){
            $this->infokpiInterAlcanceIndex[]=floatval($value["indice_interalcance"]);
        }
    }
    public function setInfokpiInteractionInvestmentIndex(){
        foreach($this->infokpiInvestment as $key => $investment){
            if($investment!=0 || $investment!=null){
                $this->infokpiInteractionInvestmentIndex[]=floatval($this->infokpiInteractionIndex[$key]/$investment)*100;
            }else{
                $this->infokpiInteractionInvestmentIndex[]=0;
            }
        }
    }
    public function setInfokpiInterAlcanceInvestmentIndex(){
        foreach($this->infokpiInvestment as $key => $investment){
            if($investment!=0 || $investment!=null){
                $this->infokpiInterAlcanceInvestmentIndex[]=floatval($this->infokpiInterAlcanceIndex[$key]/$investment)*100;
            }else{
                $this->infokpiInterAlcanceInvestmentIndex[]=0;
            }
        }
    }

    //kpi Principal

    public function setInfokpiPrincipal(array $infoKpiPrincipal){
        $this->infokpiPrincipal=$infoKpiPrincipal;
    }
    public function setInfokpiPrincipalIndex(){
        //aun falta la info a dividir
    }
    public function setInfokpiPrincipalInvestmentIndex(){
        foreach($this->infokpiInvestment as $key => $investment){
            if($investment!=0 || $investment!=null){
                $this->infokpiPrincipalInvestmentIndex[]=floatval($this->InfokpiPrincipalIndex[$key]/$investment)*100;
            }else{
                $this->infokpiPrincipalInvestmentIndex[]=0;
            }
        }
    }
    public function setInfoCostokpiPrincipalByAction(){
        foreach($this->infokpiInvestment as $key => $investment){
            if($investment!=0 || $investment!=null){
                $this->infoCostokpiPrincipalByAction[]=floatval($investment/$this->infokpiPrincipal[$key]);
            }else{
                $this->infoCostokpiPrincipalByAction[]=0;
            }
        }
    }
}
?>