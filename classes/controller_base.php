<?php
Abstract Class Controller_Base 
{
  protected $_registry;
  protected $_baseTemplate = null;
  protected $_session = null;

  function __construct($registry) 
  {
    if(!$this->_session){
      $this->_session = session_start();
    }
    $this->_registry = $registry;
    $this->_baseTemplate = $this->_registry->get('template');
  }


  abstract function index();

  protected function _initTemplate($title, $description)
  {

    $parentTemplate = $this->_baseTemplate;
    $parentTemplate->set('title', $title);
    $parentTemplate->set('description', $description);
    return clone $this->_registry->get('template');
  }

  protected function _renderLayout($template, $usePhp = false)
  {
    $parentTemplate = $this->_baseTemplate;

    if($usePhp){
      $html = $template->toHtmlWithPhp();
    } else {
      $html = $template->toHtml();
    }
    $parentTemplate->set('content', $template->toHtmlWithPhp());

  }
}