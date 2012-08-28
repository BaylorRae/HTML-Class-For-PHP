This class is designed to work like jQuery when creating and working with html elements. Look at `html.class.php` to see a list of all the available methods.

## A few examples

```php
<?php 
		
	// Get the class
	include 'html.class.php';
	
	// Create a div and set an attribute
	$div = new html('div', array(
		'class' => 'text field'
		));
		
	// Create a label and input
	$label = new html('label', array(
		'for' => 'title',
		'text' => 'Title'
		));
		
	$input = new html('input', array(
		'id' => 'title',
		'name' => 'title',
		'value' => 'My Awesome Site'
		));
		
	// Append the label and the input
	$div->append($label, $input);
	
	// Or chain the methods
	$div->append($label)
		->append($input);
		
	// Or append the elements to the div
	$label->appendTo($div);
	$input->appendTo($div);
	
	// Or clone the div before appending stuff
	// This was designed for loops
	$tmp_div = $div->_clone()->append($label, $input);
	
	// Put the div on the page,
	// and destory the temporary div
	echo $tmp_div;
	unset($tmp_div);
	
	
	// Whoops, we forgot to add our heading
	$heading = new html('h3', array(
		'text' => 'Title Field',
		'class' => 'field-heading'
		));
	
	// Ah, that's better
	$div->prepend($heading);
	
	// Or
	$heading->prependTo($div);
	
	// Put the div on the page
	echo $div;
?>
```	