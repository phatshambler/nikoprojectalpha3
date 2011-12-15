<?php
	require_once("PHP/defaultAct.php");

	class StatsAdminAction extends DefaultAct {
		public $errorCode;
		public $content;
		public $contentAtel;
		public $criteres;
		public $ateliers;
		
		public function __construct() {
			parent::__construct(DefaultAct::$VISIBILITY_PUBLIC);
		}
		
		protected function executeAction() {
			
			$this->content = array();
			$this->contentAtel = array();
			
			$this->criteres = UserDAO::getCriteres();
			
			$this->ateliers = UserDAO::getAteliersSortedTitre("");
			
			foreach($this->criteres as $value){
				array_push($this->content, UserDAO::getStats($value["NOCRITERE"]));
			}
			
			foreach($this->ateliers as $value){
				array_push($this->contentAtel, UserDAO::getStatsAtel($value["NOATEL"]));
			}
		
		}
		
	}