# cmb2-field-cs-typography
Typography field type for <a href="https://github.com/CMB2/CMB2">CMB2</a>

## Example declaration

```php
$your_cmb_matabox->add_field(array(
	'id' => $prefix . 'cs_typography',			
	'name' => __( 'Typography', 'cmb2' ),
	'desc' => __( 'Field description', 'cmb2' ),
	'type' => 'cs_typography',
	'options' => array(
		'fields' => array(
			'google-font' => true,
			'backup-font' => true,
			'font-weight' => true,
			'text-align' => true,
			'writing-mode' => true,
			'text-orientation' => true,
			'direction' => true,
			'text-transform' => true,
			'font-style' => true,
			'font-size' => true,
			'line-height' => true,
			'letter-spacing' => true,
			'color' => true,
		),
		'preview' => true, // Show/Hide the "preview text" area
		'toggle' => true, // Display all typography fields inside collapsible area
	),
));
```

## Return values

<pre>
Array
(
    [google_font] => Alegreya+Sans+SC
    [backup_font] => sans-serif
    [font_weight] => bold
    [text_align] => left
    [writing_mode] => horizontal-tb
    [text_orientation] => sideways
    [direction] => ltr
    [text_transform] => capitalize
    [font_style] => normal
    [text_decoration_line] => underline
    [text_decoration_style] => wavy
    [text_decoration_color] => #00070c
    [font_size_value] => 20
    [font_size_unit] => px
    [font_size] => 20px
    [line_height_value] => 2
    [line_height_unit] => em
    [line_height] => 2em
    [letter_spacing_value] => 1
    [letter_spacing_unit] => px
    [letter_spacing] => 1px
    [color] => #00070c
)
</pre>

## Example 1

```php
$h1_style = get_post_meta( get_the_ID(), 'your_field_id' );

echo "h1{";
    echo "font-family: '" . $h1_style['google_font'] . "', ". $h1_style['backup_font'] . ";";
    echo "font-weight: " . $h1_style['font_weight'] . ";";
    echo "text-align: " . $h1_style['text_align'] . ";";
    echo "writing-mode: " . $h1_style['writing_mode'] . ";";
    echo "text-orientation: " . $h1_style['text_orientation'] . ";";
    echo "direction: " . $h1_style['direction'] . ";";
    echo "text-transform: " . $h1_style['text_transform'] . ";";
    echo "font-style: " . $h1_style['font_style'] . ";";
    echo "text-decoration-line: " . $h1_style['text_decoration_line'] . ";";
    echo "text-decoration-style: " . $h1_style['text_decoration_style'] . ";";
    echo "text-decoration-color: " . $h1_style['text_decoration_color'] . ";";    
    echo "font-size: " . $h1_style['font_size'] . ";";
    echo "line-height: " . $h1_style['line_height'] . ";";
    echo "letter-spacing: " . $h1_style['letter_spacing'] . ";";
    echo "color: " . $h1_style['color'] . ";";
echo "}";
```

## Example 2 (Enqueue the google fonts used by all typography fileds)

```php
/**
 * This will enqueue the google fonts used by all typography fileds
 */
function prefix_enqueue_google_fonts(){
	
	$h1_typography = get_post_meta($post_id, 'h1_typography', true);
	$h2_typography = get_post_meta($post_id, 'h2_typography', true);
	$h3_typography = get_post_meta($post_id, 'h3_typography', true);
	
	$typography_elements = array(
		$h1_typography,
		$h2_typography,
		$h3_typography,
	);
	
	if(is_array($typography_elements) && count($typography_elements) > 0){
		
		$all_fonts = array();
		
		foreach($typography_elements as $element){
					
			if(isset($element['google_font']) && !empty($element['google_font'])){
				$all_fonts[] = $element['google_font'];
			}
		
		}
		
		if(count($all_fonts) > 0)
			wp_enqueue_style('prefix_typography_fonts', '//fonts.googleapis.com/css?family=' . implode('|', $all_fonts));

	}
	
}
add_action('wp_enqueue_scripts', 'prefix_enqueue_google_fonts');
```

## Example 3 (Build & Enqueue the typography style of an element)

```php
/**
 * This will build the typography style of an element
 */
function prefix_element_typography_style($element_typography, $element){
	
	if(empty($element))
		return;
	
	$typography_style = '';
	
	if(is_array($element_typography) && count($element_typography) > 0){
	
		$element_style = '';
		$font_family = array();
		
		/**
		 * Font family */
				
		if(isset($element_typography['google_font']) && !empty($element_typography['google_font'])){
			$font_family[] = "'". str_replace('+', ' ', $element_typography['google_font']) ."'";
		}

		if(isset($element_typography['backup_font']) && !empty($element_typography['backup_font'])){
			$font_family[] = $element_typography['backup_font'];
		}
			
		if(count($font_family) > 0)
			$element_style .= 'font-family:' . implode(', ', $font_family) . ';';
		
		/**
		 * Other CSS properties */
		 
		foreach($element_typography as $css_property => $css_value){

			if(!empty($css_value) 
				&& strpos($css_property, '_value') === false
				&& strpos($css_property, '_unit') === false
				&& !in_array($css_property, array('google_font', 'backup_font'))){
				
				$element_style .= str_replace('_', '-', $css_property) . ':' . $css_value . ';';
				
			}
			
		}
		
		if(!empty($element_style))
			$typography_style = $element . '{' . $element_style . '}';
		
	}
	
	return $typography_style;
	
}

/**
 * Enqueue all custom typography styles
 */
function prefix_custom_typography(){
	
	$custom_css = '';
	
	$h1_typography = get_post_meta($post_id, 'h1_typography', true);
	$h2_typography = get_post_meta($post_id, 'h2_typography', true);
	$p_typography = get_post_meta($post_id, 'p_typography', true);
	
	$custom_css .= prefix_element_typography_style($h1_typography, 'h1');
	$custom_css .= prefix_element_typography_style($h1_typography, 'h2');
	$custom_css .= prefix_element_typography_style($p_typography, 'p.my_class');
	
	wp_add_inline_style('custom-style', $custom_css);

}
add_action('wp_enqueue_scripts', 'prefix_custom_typography');
```

## Screenshot

<img src="https://github.com/codespacing/cmb2-field-cs-typography/blob/master/cmb2-cs-typography.png" />

## Changelog

<h3>1.1</h3>
<ul>
	<li>Added support for "text decoration line" property</li>
	<li>Added support for "text decoration style" property</li>
	<li>Added support for "text decoration color" property</li>
	<li>Added possibility to display all typography fields inside a collapsible area (toggle => true)</li>
</ul>

<h3>1.0</h3>
<ul><li>Initial commit</li></ul>
