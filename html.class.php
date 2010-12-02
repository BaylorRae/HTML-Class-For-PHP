<?php

/**
 * A class that makes building
 * html elements easy, and is used
 * similar to jQuery
 *
 * @package default
 * @author Baylor Rae'
 */
class html {
  
  private $tag;
  private $self_closing = false;
  private $attrs = array();
  private $self_closing_list = array('input', 'img', 'hr', 'br', 'meta', 'link');
  
  /**
   * Create an html element
   * 
   * If you leave $self_closing blank it will
   * determine whether or not to auto close
   *
   * @param string $tag - The tag's name div, input, form
   * @param array $attrs - Attributes class, id
   * @param boolean $self_closing
   * @author Baylor Rae'
   */
  function __construct($tag, $attrs = array(), $self_closing = null) {
    $this->tag = $tag;
    
    // force this tag to self close?
    if( is_null($self_closing)  )
      $this->self_closing = in_array($tag, $this->self_closing_list);
    else
      $this->self_closing = $self_closing;
      
    // Make sure text is set
    $attrs['text'] = (empty($attrs['text'])) ? '' : $attrs['text'];
    
    $this->attrs = $attrs;
  }
    
  /**
   * Build the html element
   * 
   * @see $this->build()
   * @return void
   * @author Baylor Rae'
   */
  public function __toString() {
    return $this->build();
  }
  
  /**
   * Add an attribute to the element
   * or multiple attributes if the first param is an array
   *
   * @param mixed $attr 
   * @param string $value 
   * @return void
   * @author Baylor Rae'
   */
  public function attr($attr, $value = null) {
    if( is_array($attr) )
      $this->attrs = array_merge($this->attrs, $attr);
    else
      $this->attrs = array_merge($this->attrs, array($attr => $value));
  }
  
  /**
   * Creates the html element's opening and closing tags
   * as well as the attributes.
   *
   * @return void
   * @author Baylor Rae'
   */
  public function build() {
    
    // Start the tag
    $output = '<' . $this->tag;

    // Add the attributes
    foreach( $this->attrs as $attr => $value ) {
      if( $attr == 'text' )
        continue;
      
      if( is_integer($attr) )
        $attr = $value;
      $output .= ' ' . $attr . '="' . $value . '"';
    }
        
    // Close the tag
    if( $this->self_closing )
      $output .= ' />';
    else
      $output .= '>' . $this->attrs['text'] . '</' . $this->tag . '>';
    
    return $output;    
  }
  
  /**
   * Clone the current element
   * to prevent effecting the original
   *
   * @return new html object
   * @author Baylor Rae'
   */
  public function _clone() {
    return new html($this->tag, $this->attrs, $this->self_closing);
  }
  
  /**
   * Check if the object being used
   * in the methods below, is part of the html class
   *
   * @package default
   * @author Baylor Rae'
   */
  private function check_class($obj) {
    return (@get_class($obj) == __class__);
  }
  
  /**
   * Append an element to the current
   * or for multiple use each element
    * as a parameter
   *
   * @return $this (for chaining)
   * @author Baylor Rae'
   */
  public function append() {
    $elems = func_get_args();
    
    foreach( $elems as $obj ) {
      if( !$this->check_class($obj) )
        continue;
        
      $this->attrs['text'] .= $obj->build();
    }
        
    return $this;
  }
  
  /**
   * Prepend an element to the current
   * or for multiple use each element
   * as a parameter
   *
   * @return $this (for chaining)
   * @author Baylor Rae'
   */
  public function prepend() {
    $elems = func_get_args();
    
    $elems = array_reverse($elems);
    
    foreach( $elems as $obj ) {
      if( !$this->check_class($obj) )
        continue;
        
      $this->attrs['text'] = $obj->build() . $this->attrs['text'];
    }
    
    return $this;
  }
  
  /**
   * Append this element onto another
   *
   * @param object $obj 
   * @return void
   * @author Baylor Rae'
   */
  public function appendTo($obj) {
    if( !$this->check_class($obj) )
      return false;
      
    $obj->attrs['text'] .= $this->build();
  }
  
  /**
   * Prepend this element onto another
   *
   * @param object $obj 
   * @return void
   * @author Baylor Rae'
   */
  public function prependTo($obj) {
    if( !$this->check_class($obj) )
      return false;
      
    $obj->attrs['text'] = $this->build() . $obj->attrs['text'];
  }
}
