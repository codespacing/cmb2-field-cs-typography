# cmb2-field-cs-typography
Typography field type for <a href="https://github.com/CMB2/CMB2">CMB2</a>

<hr />

<h2>Example Declaration</h2>


<hr />

<h2>Output array</h2>
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
<?php
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
<ul><li>Initial commit</li></ul>
