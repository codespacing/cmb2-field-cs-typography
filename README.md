# cmb2-field-cs-typography
Typography field type for <a href="https://github.com/CMB2/CMB2">CMB2</a>

<hr />

<h2>Example Declaration</h2>
<pre>
add_action( 'cmb2_admin_init', 'cmb2_cs_typography_metabox' );
function cmb2_cs_typography_metabox() {

	$prefix = 'yourprefix_demo_';

	$cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => __( 'Test Metabox', 'cmb2' ),
		'object_types'  => array( 'page', 'post' ), // Post type
	) );

	$cmb_demo->add_field( array(
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
		),
	) );
	
}
</pre>

<hr />

<h2>Output array</h2>
<pre>
Array
(
    [google_font] => Actor
    [backup_font] => sans-serif
    [font_weight] => bold
    [text_align] => left
    [writing_mode] => horizontal-tb
    [text_orientation] => sideways
    [direction] => ltr
    [text_transform] => capitalize
    [font_style] => normal
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

<hr />

<h2>Example Usage</h2>
<pre>
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
    echo "font-size: " . $h1_style['font_size'] . ";";
    echo "line-height: " . $h1_style['line_height'] . ";";
    echo "letter-spacing: " . $h1_style['letter_spacing'] . ";";
    echo "color: " . $h1_style['color'] . ";";
echo "}";
</pre>

<hr />

<h2>Screenshot</h2>
<img src="https://github.com/codespacing/cmb2-field-cs-typography/blob/master/cmb2-cs-typography.png" />

<h2>Changelog</h2>

<h3>1.0</h3>
<ul><li>Inital commit</li></ul>
