<?php

// Exit if accessed directly

if(!defined('ABSPATH'))
	exit;

if(!class_exists('CS_CMB2_Typography_Field')){

	/**
	 * Class CS_CMB2_Typography_Field */
	 
	class CS_CMB2_Typography_Field {
		
		/**
		 * Current version number */
		 
		const VERSION = '1.0';
				
		private $plugin_path;
		private $plugin_url;
		
		public $typography_options;
		public $typography_fields;
	
		/**
		 * Initialize the plugin by hooking into CMB2
		 *
		 * @since 1.0
		 */
		public function __construct(){
					 
			$this->plugin_path = plugin_dir_path( __FILE__ );
			$this->plugin_url = plugin_dir_url( __FILE__ );
				
			add_filter( 'cmb2_render_cs_typography', array( $this, 'cs_render_typography_field' ), 10, 5 );
				
		}
		
	
		/**
		 * Render field
		 *
		 * @since 1.0
		 */
		public function cs_render_typography_field($field, $field_escaped_value, $field_object_id, $field_object_type, $field_type_object ) {
		
			$field_id = $field->_id();
			$field_title = $field->_name();
			
			/**
			 * Get the field options */
			 
			$field_options = $field->args('options');
			
			/**
			 * Typograpgy fields */
	
			$this->typography_options = wp_parse_args($field_options, array(
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
				'preview' => true,
			));
			
			$this->typography_fields = $this->typography_options['fields'];
			
			/**
			 * Enqueue scripts & styles */
			 
			$this->cs_enqueue_scripts();
			
			?>
			
			<div class="cs-typography-fields-container" data-field-id="<?php echo $field_id; ?>">
			
				<?php
				
				/**
				 * "Google Fonts" family */
				
				$this->cs_build_options_field(array(
					'field_object' => $field_type_object,
					'field_id' => $field_id,
					'field_value' => $field_escaped_value,
					'field_name' => 'google_font',
					'field_label' => '<a href="https://fonts.google.com/" target="_blank">Google font family</a>',
					'field_options' => $this->cs_google_fonts_list(),
					'empty_option' => true,
				)); 
		
				/**
				 * Backup font family */
				
				$this->cs_build_options_field(array(
					'field_object' => $field_type_object,
					'field_id' => $field_id,
					'field_value' => $field_escaped_value,
					'field_name' => 'backup_font',
					'field_label' => 'Backup font family',
					'field_options' => array(
						'auto' => 'auto',
						'serif' => 'serif',
						'sans-serif' => 'sans-serif',
						'monospace' => 'monospace',
						'cursive' => 'cursive',
						'fantasy' => 'fantasy',
						'system-ui' => 'system-ui',
						'justify-all' => 'justify-all',
						'match-parent' => 'match-parent',
						'initial' => 'initial',
						'unset' => 'unset',	
						'none' => 'none',			
					),
					'empty_option' => true,
				)); 
		
				/**
				 * Font weight */
				
				$this->cs_build_options_field(array(
					'field_object' => $field_type_object,
					'field_id' => $field_id,
					'field_value' => $field_escaped_value,
					'field_name' => 'font_weight',
					'field_label' => 'Font weight',
					'field_options' => array(
						'normal' => 'normal',
						'bold' => 'bold',
						'bolder' => 'bolder',
						'lighter' => 'lighter',
						'100' => '100',
						'200' => '200',
						'300' => '300',
						'400' => '400',
						'500' => '500',
						'600' => '600',
						'700' => '700',
						'800' => '800',
						'900' => '900',
						'inherit' => 'inherit',
						'initial' => 'initial',
						'unset' => 'unset',				
					),
					'empty_option' => true,
				)); 
				
				/**
				 * Text align */
				
				$this->cs_build_options_field(array(
					'field_object' => $field_type_object,
					'field_id' => $field_id,
					'field_value' => $field_escaped_value,
					'field_name' => 'text_align',
					'field_label' => 'Text align',
					'field_options' => array(
						'start' => 'start',
						'end' => 'end',
						'left' => 'left',
						'right' => 'right',
						'center' => 'center',
						'justify' => 'justify',
						'justify-all' => 'justify-all',
						'match-parent' => 'match-parent',
						'initial' => 'initial',
						'unset' => 'unset',				
					),
					'empty_option' => true,
				)); 
		
				/**
				 * Writing mode */
				
				$this->cs_build_options_field(array(
					'field_object' => $field_type_object,
					'field_id' => $field_id,
					'field_value' => $field_escaped_value,
					'field_name' => 'writing_mode',
					'field_label' => 'Writing mode',
					'field_options' => array(
						'horizontal-tb' => 'horizontal-tb',
						'vertical-rl' => 'vertical-rl',
						'vertical-lr' => 'vertical-lr',
						'sideways-rl' => 'sideways-rl',
						'sideways-lr' => 'sideways-lr',
						'inherit' => 'inherit',
						'initial' => 'initial',
						'unset' => 'unset',				
					),
					'empty_option' => true,
				)); 
		
				/**
				 * Text orientation */
				
				$this->cs_build_options_field(array(
					'field_object' => $field_type_object,
					'field_id' => $field_id,
					'field_value' => $field_escaped_value,
					'field_name' => 'text_orientation',
					'field_label' => 'Text orientation',
					'field_options' => array(
						'mixed' => 'mixed',
						'upright' => 'upright',
						'sideways' => 'sideways',
						'sideways-right' => 'sideways-right',
						'use-glyph-orientation' => 'use-glyph-orientation',
						'inherit' => 'inherit',
						'initial' => 'initial',
						'unset' => 'unset',				
					),
					'empty_option' => true,
				)); 
				
				/**
				 * Text direction */
				
				$this->cs_build_options_field(array(
					'field_object' => $field_type_object,
					'field_id' => $field_id,
					'field_value' => $field_escaped_value,
					'field_name' => 'direction',
					'field_label' => 'Text direction',
					'field_options' => array(
						'ltr' => 'ltr',
						'rtl' => 'rtl',
						'inherit' => 'inherit',
						'initial' => 'initial',
						'unset' => 'unset',				
					),
					'empty_option' => true,
				)); 
				
				/**
				 * Text transform */
				
				$this->cs_build_options_field(array(
					'field_object' => $field_type_object,
					'field_id' => $field_id,
					'field_value' => $field_escaped_value,
					'field_name' => 'text_transform',
					'field_label' => 'Text transform',
					'field_options' => array(
						'none' => 'none',
						'capitalize' => 'capitalize',
						'uppercase' => 'uppercase',
						'lowercase' => 'lowercase',
						'inherit' => 'inherit',
						'full-width' => 'full-width',
						'full-size-kana' => 'full-size-kana',
						'inherit' => 'inherit',
						'initial' => 'initial',
						'unset' => 'unset',				
					),
					'empty_option' => true,
				)); 
				
				/**
				 * Font style */
				
				$this->cs_build_options_field(array(
					'field_object' => $field_type_object,
					'field_id' => $field_id,
					'field_value' => $field_escaped_value,
					'field_name' => 'font_style',
					'field_label' => 'Font style',
					'field_options' => array(
						'normal' => 'normal',
						'italic' => 'italic',
						'oblique' => 'oblique',
						'inherit' => 'inherit',
						'initial' => 'initial',
						'unset' => 'unset',				
					),
					'empty_option' => true,
				)); 
				
				/**
				 * Font size */
				
				$this->cs_build_unit_field(array(
					'field_object' => $field_type_object,
					'field_id' => $field_id,
					'field_value' => $field_escaped_value,
					'field_name' => 'font_size',
					'field_label' => 'Font size',
					'empty_option' => false,
				));
				
				/**
				 * Line height */
				
				$this->cs_build_unit_field(array(
					'field_object' => $field_type_object,
					'field_id' => $field_id,
					'field_value' => $field_escaped_value,
					'field_name' => 'line_height',
					'field_label' => 'Line height',
					'empty_option' => true,
				));
				
				/**
				 * Letter spacing */
				
				$this->cs_build_unit_field(array(
					'field_object' => $field_type_object,
					'field_id' => $field_id,
					'field_value' => $field_escaped_value,
					'field_name' => 'letter_spacing',
					'field_label' => 'Letter spacing',
				));
				
				/**
				 * Color */
				
				if(in_array('color', $this->typography_fields) && (is_bool($this->typography_fields['color']) && $this->typography_fields['color'])){ ?>
					
					<div class="cs-typography-element">
						 
						<label for="color" class="cs-field-label"><?php _e('Color', 'cs_typography'); ?></label>
				
						<div class="cs-typography-field full-size">
							<?php 
							echo $field_type_object->colorpicker(array(
								'name' => $field_id . '[color]',
								'desc' => '',
								'id' => 'color',
								'value' => isset($field_escaped_value['color']) ? $field_escaped_value['color'] : '',
								'data-field-id' => $field_id,
								'data-css-property' => 'color',
							)); 
							?>
						</div>
						
					</div><?php
					
				}
				
				/**
				 * Preview style */
				 
				if(is_bool($this->typography_options['preview']) && $this->typography_options['preview']){ ?>
				
					<div class="cs-typography-element">
						 
						<label class="cs-field-label"><?php _e('Perview text', 'cs_typography'); ?></label>
					
						<div class="cs-typography-preview" data-field-id="<?php echo $field_id; ?>" style=" <?php echo $this->cs_preview_css($field_escaped_value); ?> ">
							Then came the night of the first falling star.<br />
							0123456789
						</div>
					
					</div><?php
					
				}
				
				?>
			
			</div>
							
			<?php         
	
			if(!empty($field->args('desc')))
				echo '<p class="cmb2-metabox-description">'.$field->args('desc').'</p>';
			
		}
		
		
		/**
		 * This will build the unit filed "font-size", etc... 
		 *
		 * @since 1.0 
		 */	 
		private function cs_build_unit_field($atts = array()){
			
			extract( wp_parse_args( $atts, array(
				'field_object' => '',
				'field_id' => '',
				'field_value' => '',
				'field_name' => '',
				'field_label' => '',
				'empty_option' => false,
			)));
			
			$css_property = str_replace('_', '-', $field_name);
			
			if(!in_array($css_property, $this->typography_fields) || (is_bool($this->typography_fields[$css_property]) && !$this->typography_fields[$css_property]))
				return;
				
			?>
			
			<div class="cs-typography-element half-size">
				 
				<label for="<?php echo $field_id; ?>_value" class="cs-field-label"><?php _e($field_label, 'cs_typography'); ?></label>
				
				<div class="cs-typography-field half-size">
					<?php 
					echo $field_object->input(array(
						'name' => $field_id . '['.$field_name.'_value]',
						'desc' => '',
						'id' => $field_id . '_value',
						'class' => 'cs-typography-text',
						'type' => 'number',
						'pattern' => '\d*',
						'value' => isset($field_value[$field_name.'_value']) ? $field_value[$field_name.'_value'] : '',
						'data-field-id' => $field_id,
						'data-css-property' => str_replace('_', '-', $field_name),
						'data-has-unit' => '1',
					)); 
					?>
				</div>
	
				<div class="cs-typography-field half-size">
					<?php
					echo $field_object->select(array(
						'name' => $field_id . '['.$field_name.'_unit]',
						'desc' => '',
						'id' => $field_id . '_unit',
						'class' => 'cs-typography-select',
						'options' => $this->cs_build_select_options(
							$field_object, 
							array_merge(
								($empty_option) ? array('' => '') : array(),
								array(
									'px' => 'px',
									'em' => 'em',
									'rem' => 'rem',
								)
							), 
							isset($field_value[$field_name.'_unit']) ? $field_value[$field_name.'_unit'] : '' 
						),
						'data-field-id' => $field_id,
						'data-css-property' => str_replace('_', '-', $field_name),	
						'data-is-unit' => '1',				
					));
					?>
				</div>
				
				<?php 
				echo $field_object->input(array(
					'name' => $field_id . '['.$field_name.']',
					'desc' => '',
					'id' => $field_id,
					'type' => 'hidden',
					'value' => isset($field_value[$field_name]) ? $field_value[$field_name] : '',
					'data-field-id' => $field_id,
					'data-css-property' => str_replace('_', '-', $field_name),
				)); 
				?>
	
			</div>
			
			<?php		 
					
		}
		
		
		/**
		 * This will build the select filed "font-family", etc... 
		 *
		 * @since 1.0 
		 */	 
		private function cs_build_options_field($atts = array()){
			
			extract( wp_parse_args( $atts, array(
				'field_object' => '',
				'field_id' => '',
				'field_value' => '',
				'field_name' => '',
				'field_label' => '',
				'field_options' => array(),
				'empty_option' => false,
			)));
			
			$css_property = str_replace('_', '-', $field_name);
			
			if(!in_array($css_property, $this->typography_fields) || (is_bool($this->typography_fields[$css_property]) && !$this->typography_fields[$css_property]))
				return;
				
			?>
			
			<div class="cs-typography-element half-size">
				 
				<label for="<?php echo $field_id; ?>" class="cs-field-label"><?php _e($field_label, 'cs_typography'); ?></label>
	
				<div class="cs-typography-field">
					<?php
					echo $field_object->select(array(
						'name' => $field_id . '['.$field_name.']',
						'desc' => '',
						'id' => $field_id,
						'class' => 'cs-typography-select',
						'options' => $this->cs_build_select_options(
							$field_object, 
							array_merge(
								$empty_option ? array('' => '') : array(),
								is_array($field_options) ? $field_options : array()
							), 
							isset($field_value[$field_name]) ? $field_value[$field_name] : '' 
						),
						'data-field-id' => $field_id,
						'data-css-property' => str_replace('_', '-', $field_name),
					));
					?>
				</div>
	
			</div>
			
			<?php		 
					
		}
		
		
		/**
		 * This will build the select filed options
		 *
		 * @since 1.0 
		 */	 
		private function cs_build_select_options($field_type, $options, $default_value){
			
			$options_HTML = '';
			
			foreach($options as $value => $label){
				$options_HTML .= '<option value="' . $value . '" ' . selected( $default_value, $value, false ) . '>' . $label . '</option>';
			}
			
			return $options_HTML;
			
		}
		
		
		/**
		 * The list of all available Google Fonts 
		 *
		 * @since 1.0 
		 */	 
		public function cs_google_fonts_list(){
			
			return array(
				'ABeeZee' => 'ABeeZee', 'Abel' => 'Abel', 'Abhaya+Libre' => 'Abhaya Libre', 'Abril+Fatface' => 'Abril Fatface', 'Aclonica' => 'Aclonica', 'Acme' => 'Acme', 'Actor' => 'Actor', 'Adamina' => 'Adamina', 'Advent+Pro' => 'Advent Pro', 'Aguafina+Script' => 'Aguafina Script', 'Akronim' => 'Akronim', 
				'Aladin' => 'Aladin', 'Aldrich' => 'Aldrich', 'Alef' => 'Alef', 'Alegreya' => 'Alegreya', 'Alegreya+SC' => 'Alegreya SC', 'Alegreya+Sans' => 'Alegreya Sans', 'Alegreya+Sans+SC' => 'Alegreya Sans SC', 'Alex+Brush' => 'Alex Brush', 'Alfa+Slab+One' => 'Alfa Slab One', 'Alice' => 'Alice', 
				'Alike' => 'Alike', 'Alike+Angular' => 'Alike Angular', 'Allan' => 'Allan', 'Allerta' => 'Allerta', 'Allerta+Stencil' => 'Allerta Stencil', 'Allura' => 'Allura', 'Almendra' => 'Almendra', 'Almendra+Display' => 'Almendra Display', 'Almendra+SC' => 'Almendra SC', 'Amarante' => 'Amarante', 
				'Amaranth' => 'Amaranth', 'Amatic+SC' => 'Amatic SC', 'Amethysta' => 'Amethysta', 'Amiko' => 'Amiko', 'Amiri' => 'Amiri', 'Amita' => 'Amita', 'Anaheim' => 'Anaheim', 'Andada' => 'Andada', 'Andika' => 'Andika', 'Angkor' => 'Angkor', 
				'Annie+Use+Your+Telescope' => 'Annie Use Your Telescope', 'Anonymous+Pro' => 'Anonymous Pro', 'Antic' => 'Antic', 'Antic+Didone' => 'Antic Didone', 'Antic+Slab' => 'Antic Slab', 'Anton' => 'Anton', 'Arapey' => 'Arapey', 'Arbutus' => 'Arbutus', 'Arbutus+Slab' => 'Arbutus Slab', 'Architects+Daughter' => 'Architects Daughter', 
				'Archivo' => 'Archivo', 'Archivo+Black' => 'Archivo Black', 'Archivo+Narrow' => 'Archivo Narrow', 'Aref+Ruqaa' => 'Aref Ruqaa', 'Arima+Madurai' => 'Arima Madurai', 'Arimo' => 'Arimo', 'Arizonia' => 'Arizonia', 'Armata' => 'Armata', 'Arsenal' => 'Arsenal', 'Artifika' => 'Artifika', 
				'Arvo' => 'Arvo', 'Arya' => 'Arya', 'Asap' => 'Asap', 'Asap+Condensed' => 'Asap Condensed', 'Asar' => 'Asar', 'Asset' => 'Asset', 'Assistant' => 'Assistant', 'Astloch' => 'Astloch', 'Asul' => 'Asul', 'Athiti' => 'Athiti', 
				'Atma' => 'Atma', 'Atomic+Age' => 'Atomic Age', 'Aubrey' => 'Aubrey', 'Audiowide' => 'Audiowide', 'Autour+One' => 'Autour One', 'Average' => 'Average', 'Average+Sans' => 'Average Sans', 'Averia+Gruesa+Libre' => 'Averia Gruesa Libre', 'Averia+Libre' => 'Averia Libre', 'Averia+Sans+Libre' => 'Averia Sans Libre', 
				'Averia+Serif+Libre' => 'Averia Serif Libre', 'Bad+Script' => 'Bad Script', 'Bahiana' => 'Bahiana', 'Baloo' => 'Baloo', 'Baloo+Bhai' => 'Baloo Bhai', 'Baloo+Bhaijaan' => 'Baloo Bhaijaan', 'Baloo+Bhaina' => 'Baloo Bhaina', 'Baloo+Chettan' => 'Baloo Chettan', 'Baloo+Da' => 'Baloo Da', 'Baloo+Paaji' => 'Baloo Paaji', 
				'Baloo+Tamma' => 'Baloo Tamma', 'Baloo+Tammudu' => 'Baloo Tammudu', 'Baloo+Thambi' => 'Baloo Thambi', 'Balthazar' => 'Balthazar', 'Bangers' => 'Bangers', 'Barlow' => 'Barlow', 'Barlow+Condensed' => 'Barlow Condensed', 'Barlow+Semi+Condensed' => 'Barlow Semi Condensed', 'Barrio' => 'Barrio', 'Basic' => 'Basic', 
				'Battambang' => 'Battambang', 'Baumans' => 'Baumans', 'Bayon' => 'Bayon', 'Belgrano' => 'Belgrano', 'Bellefair' => 'Bellefair', 'Belleza' => 'Belleza', 'BenchNine' => 'BenchNine', 'Bentham' => 'Bentham', 'Berkshire+Swash' => 'Berkshire Swash', 'Bevan' => 'Bevan', 
				'Bigelow+Rules' => 'Bigelow Rules', 'Bigshot+One' => 'Bigshot One', 'Bilbo' => 'Bilbo', 'Bilbo+Swash+Caps' => 'Bilbo Swash Caps', 'BioRhyme' => 'BioRhyme', 'BioRhyme+Expanded' => 'BioRhyme Expanded', 'Biryani' => 'Biryani', 'Bitter' => 'Bitter', 'Black+Ops+One' => 'Black Ops One', 'Bokor' => 'Bokor', 
				'Bonbon' => 'Bonbon', 'Boogaloo' => 'Boogaloo', 'Bowlby+One' => 'Bowlby One', 'Bowlby+One+SC' => 'Bowlby One SC', 'Brawler' => 'Brawler', 'Bree+Serif' => 'Bree Serif', 'Bubblegum+Sans' => 'Bubblegum Sans', 'Bubbler+One' => 'Bubbler One', 'Buda' => 'Buda', 'Buenard' => 'Buenard', 
				'Bungee' => 'Bungee', 'Bungee+Hairline' => 'Bungee Hairline', 'Bungee+Inline' => 'Bungee Inline', 'Bungee+Outline' => 'Bungee Outline', 'Bungee+Shade' => 'Bungee Shade', 'Butcherman' => 'Butcherman', 'Butterfly+Kids' => 'Butterfly Kids', 'Cabin' => 'Cabin', 'Cabin+Condensed' => 'Cabin Condensed', 'Cabin+Sketch' => 'Cabin Sketch', 
				'Caesar+Dressing' => 'Caesar Dressing', 'Cagliostro' => 'Cagliostro', 'Cairo' => 'Cairo', 'Calligraffitti' => 'Calligraffitti', 'Cambay' => 'Cambay', 'Cambo' => 'Cambo', 'Candal' => 'Candal', 'Cantarell' => 'Cantarell', 'Cantata+One' => 'Cantata One', 'Cantora+One' => 'Cantora One', 
				'Capriola' => 'Capriola', 'Cardo' => 'Cardo', 'Carme' => 'Carme', 'Carrois+Gothic' => 'Carrois Gothic', 'Carrois+Gothic+SC' => 'Carrois Gothic SC', 'Carter+One' => 'Carter One', 'Catamaran' => 'Catamaran', 'Caudex' => 'Caudex', 'Caveat' => 'Caveat', 'Caveat+Brush' => 'Caveat Brush', 
				'Cedarville+Cursive' => 'Cedarville Cursive', 'Ceviche+One' => 'Ceviche One', 'Changa' => 'Changa', 'Changa+One' => 'Changa One', 'Chango' => 'Chango', 'Chathura' => 'Chathura', 'Chau+Philomene+One' => 'Chau Philomene One', 'Chela+One' => 'Chela One', 'Chelsea+Market' => 'Chelsea Market', 'Chenla' => 'Chenla', 
				'Cherry+Cream+Soda' => 'Cherry Cream Soda', 'Cherry+Swash' => 'Cherry Swash', 'Chewy' => 'Chewy', 'Chicle' => 'Chicle', 'Chivo' => 'Chivo', 'Chonburi' => 'Chonburi', 'Cinzel' => 'Cinzel', 'Cinzel+Decorative' => 'Cinzel Decorative', 'Clicker+Script' => 'Clicker Script', 'Coda' => 'Coda', 
				'Coda+Caption' => 'Coda Caption', 'Codystar' => 'Codystar', 'Coiny' => 'Coiny', 'Combo' => 'Combo', 'Comfortaa' => 'Comfortaa', 'Coming+Soon' => 'Coming Soon', 'Concert+One' => 'Concert One', 'Condiment' => 'Condiment', 'Content' => 'Content', 'Contrail+One' => 'Contrail One', 
				'Convergence' => 'Convergence', 'Cookie' => 'Cookie', 'Copse' => 'Copse', 'Corben' => 'Corben', 'Cormorant' => 'Cormorant', 'Cormorant+Garamond' => 'Cormorant Garamond', 'Cormorant+Infant' => 'Cormorant Infant', 'Cormorant+SC' => 'Cormorant SC', 'Cormorant+Unicase' => 'Cormorant Unicase', 'Cormorant+Upright' => 'Cormorant Upright', 
				'Courgette' => 'Courgette', 'Cousine' => 'Cousine', 'Coustard' => 'Coustard', 'Covered+By+Your+Grace' => 'Covered By Your Grace', 'Crafty+Girls' => 'Crafty Girls', 'Creepster' => 'Creepster', 'Crete+Round' => 'Crete Round', 'Crimson+Text' => 'Crimson Text', 'Croissant+One' => 'Croissant One', 'Crushed' => 'Crushed', 
				'Cuprum' => 'Cuprum', 'Cutive' => 'Cutive', 'Cutive+Mono' => 'Cutive Mono', 'Damion' => 'Damion', 'Dancing+Script' => 'Dancing Script', 'Dangrek' => 'Dangrek', 'David+Libre' => 'David Libre', 'Dawning+of+a+New+Day' => 'Dawning of a New Day', 'Days+One' => 'Days One', 'Dekko' => 'Dekko', 
				'Delius' => 'Delius', 'Delius+Swash+Caps' => 'Delius Swash Caps', 'Delius+Unicase' => 'Delius Unicase', 'Della+Respira' => 'Della Respira', 'Denk+One' => 'Denk One', 'Devonshire' => 'Devonshire', 'Dhurjati' => 'Dhurjati', 'Didact+Gothic' => 'Didact Gothic', 'Diplomata' => 'Diplomata', 'Diplomata+SC' => 'Diplomata SC', 
				'Domine' => 'Domine', 'Donegal+One' => 'Donegal One', 'Doppio+One' => 'Doppio One', 'Dorsa' => 'Dorsa', 'Dosis' => 'Dosis', 'Dr+Sugiyama' => 'Dr Sugiyama', 'Duru+Sans' => 'Duru Sans', 'Dynalight' => 'Dynalight', 'EB+Garamond' => 'EB Garamond', 'Eagle+Lake' => 'Eagle Lake', 
				'Eater' => 'Eater', 'Economica' => 'Economica', 'Eczar' => 'Eczar', 'El+Messiri' => 'El Messiri', 'Electrolize' => 'Electrolize', 'Elsie' => 'Elsie', 'Elsie+Swash+Caps' => 'Elsie Swash Caps', 'Emblema+One' => 'Emblema One', 'Emilys+Candy' => 'Emilys Candy', 'Encode+Sans' => 'Encode Sans', 
				'Encode+Sans+Condensed' => 'Encode Sans Condensed', 'Encode+Sans+Expanded' => 'Encode Sans Expanded', 'Encode+Sans+Semi+Condensed' => 'Encode Sans Semi Condensed', 'Encode+Sans+Semi+Expanded' => 'Encode Sans Semi Expanded', 'Engagement' => 'Engagement', 'Englebert' => 'Englebert', 'Enriqueta' => 'Enriqueta', 'Erica+One' => 'Erica One', 'Esteban' => 'Esteban', 'Euphoria+Script' => 'Euphoria Script', 
				'Ewert' => 'Ewert', 'Exo' => 'Exo', 'Exo+2' => 'Exo 2', 'Expletus+Sans' => 'Expletus Sans', 'Fanwood+Text' => 'Fanwood Text', 'Farsan' => 'Farsan', 'Fascinate' => 'Fascinate', 'Fascinate+Inline' => 'Fascinate Inline', 'Faster+One' => 'Faster One', 'Fasthand' => 'Fasthand', 
				'Fauna+One' => 'Fauna One', 'Faustina' => 'Faustina', 'Federant' => 'Federant', 'Federo' => 'Federo', 'Felipa' => 'Felipa', 'Fenix' => 'Fenix', 'Finger+Paint' => 'Finger Paint', 'Fira+Mono' => 'Fira Mono', 'Fira+Sans' => 'Fira Sans', 'Fira+Sans+Condensed' => 'Fira Sans Condensed', 
				'Fira+Sans+Extra+Condensed' => 'Fira Sans Extra Condensed', 'Fjalla+One' => 'Fjalla One', 'Fjord+One' => 'Fjord One', 'Flamenco' => 'Flamenco', 'Flavors' => 'Flavors', 'Fondamento' => 'Fondamento', 'Fontdiner+Swanky' => 'Fontdiner Swanky', 'Forum' => 'Forum', 'Francois+One' => 'Francois One', 'Frank+Ruhl+Libre' => 'Frank Ruhl Libre', 
				'Freckle+Face' => 'Freckle Face', 'Fredericka+the+Great' => 'Fredericka the Great', 'Fredoka+One' => 'Fredoka One', 'Freehand' => 'Freehand', 'Fresca' => 'Fresca', 'Frijole' => 'Frijole', 'Fruktur' => 'Fruktur', 'Fugaz+One' => 'Fugaz One', 'GFS+Didot' => 'GFS Didot', 'GFS+Neohellenic' => 'GFS Neohellenic', 
				'Gabriela' => 'Gabriela', 'Gafata' => 'Gafata', 'Galada' => 'Galada', 'Galdeano' => 'Galdeano', 'Galindo' => 'Galindo', 'Gentium+Basic' => 'Gentium Basic', 'Gentium+Book+Basic' => 'Gentium Book Basic', 'Geo' => 'Geo', 'Geostar' => 'Geostar', 'Geostar+Fill' => 'Geostar Fill', 
				'Germania+One' => 'Germania One', 'Gidugu' => 'Gidugu', 'Gilda+Display' => 'Gilda Display', 'Give+You+Glory' => 'Give You Glory', 'Glass+Antiqua' => 'Glass Antiqua', 'Glegoo' => 'Glegoo', 'Gloria+Hallelujah' => 'Gloria Hallelujah', 'Goblin+One' => 'Goblin One', 'Gochi+Hand' => 'Gochi Hand', 'Gorditas' => 'Gorditas', 
				'Goudy+Bookletter+1911' => 'Goudy Bookletter 1911', 'Graduate' => 'Graduate', 'Grand+Hotel' => 'Grand Hotel', 'Gravitas+One' => 'Gravitas One', 'Great+Vibes' => 'Great Vibes', 'Griffy' => 'Griffy', 'Gruppo' => 'Gruppo', 'Gudea' => 'Gudea', 'Gurajada' => 'Gurajada', 'Habibi' => 'Habibi', 
				'Halant' => 'Halant', 'Hammersmith+One' => 'Hammersmith One', 'Hanalei' => 'Hanalei', 'Hanalei+Fill' => 'Hanalei Fill', 'Handlee' => 'Handlee', 'Hanuman' => 'Hanuman', 'Happy+Monkey' => 'Happy Monkey', 'Harmattan' => 'Harmattan', 'Headland+One' => 'Headland One', 'Heebo' => 'Heebo', 
				'Henny+Penny' => 'Henny Penny', 'Herr+Von+Muellerhoff' => 'Herr Von Muellerhoff', 'Hind' => 'Hind', 'Hind+Guntur' => 'Hind Guntur', 'Hind+Madurai' => 'Hind Madurai', 'Hind+Siliguri' => 'Hind Siliguri', 'Hind+Vadodara' => 'Hind Vadodara', 'Holtwood+One+SC' => 'Holtwood One SC', 'Homemade+Apple' => 'Homemade Apple', 'Homenaje' => 'Homenaje', 
				'IM+Fell+DW+Pica' => 'IM Fell DW Pica', 'IM+Fell+DW+Pica+SC' => 'IM Fell DW Pica SC', 'IM+Fell+Double+Pica' => 'IM Fell Double Pica', 'IM+Fell+Double+Pica+SC' => 'IM Fell Double Pica SC', 'IM+Fell+English' => 'IM Fell English', 'IM+Fell+English+SC' => 'IM Fell English SC', 'IM+Fell+French+Canon' => 'IM Fell French Canon', 'IM+Fell+French+Canon+SC' => 'IM Fell French Canon SC', 'IM+Fell+Great+Primer' => 'IM Fell Great Primer', 'IM+Fell+Great+Primer+SC' => 'IM Fell Great Primer SC', 
				'Iceberg' => 'Iceberg', 'Iceland' => 'Iceland', 'Imprima' => 'Imprima', 'Inconsolata' => 'Inconsolata', 'Inder' => 'Inder', 'Indie+Flower' => 'Indie Flower', 'Inika' => 'Inika', 'Inknut+Antiqua' => 'Inknut Antiqua', 'Irish+Grover' => 'Irish Grover', 'Istok+Web' => 'Istok Web', 
				'Italiana' => 'Italiana', 'Italianno' => 'Italianno', 'Itim' => 'Itim', 'Jacques+Francois' => 'Jacques Francois', 'Jacques+Francois+Shadow' => 'Jacques Francois Shadow', 'Jaldi' => 'Jaldi', 'Jim+Nightshade' => 'Jim Nightshade', 'Jockey+One' => 'Jockey One', 'Jolly+Lodger' => 'Jolly Lodger', 'Jomhuria' => 'Jomhuria', 
				'Josefin+Sans' => 'Josefin Sans', 'Josefin+Slab' => 'Josefin Slab', 'Joti+One' => 'Joti One', 'Judson' => 'Judson', 'Julee' => 'Julee', 'Julius+Sans+One' => 'Julius Sans One', 'Junge' => 'Junge', 'Jura' => 'Jura', 'Just+Another+Hand' => 'Just Another Hand', 'Just+Me+Again+Down+Here' => 'Just Me Again Down Here', 
				'Kadwa' => 'Kadwa', 'Kalam' => 'Kalam', 'Kameron' => 'Kameron', 'Kanit' => 'Kanit', 'Kantumruy' => 'Kantumruy', 'Karla' => 'Karla', 'Karma' => 'Karma', 'Katibeh' => 'Katibeh', 'Kaushan+Script' => 'Kaushan Script', 'Kavivanar' => 'Kavivanar', 
				'Kavoon' => 'Kavoon', 'Kdam+Thmor' => 'Kdam Thmor', 'Keania+One' => 'Keania One', 'Kelly+Slab' => 'Kelly Slab', 'Kenia' => 'Kenia', 'Khand' => 'Khand', 'Khmer' => 'Khmer', 'Khula' => 'Khula', 'Kite+One' => 'Kite One', 'Knewave' => 'Knewave', 
				'Kotta+One' => 'Kotta One', 'Koulen' => 'Koulen', 'Kranky' => 'Kranky', 'Kreon' => 'Kreon', 'Kristi' => 'Kristi', 'Krona+One' => 'Krona One', 'Kumar+One' => 'Kumar One', 'Kumar+One+Outline' => 'Kumar One Outline', 'Kurale' => 'Kurale', 'La+Belle+Aurore' => 'La Belle Aurore', 
				'Laila' => 'Laila', 'Lakki+Reddy' => 'Lakki Reddy', 'Lalezar' => 'Lalezar', 'Lancelot' => 'Lancelot', 'Lateef' => 'Lateef', 'Lato' => 'Lato', 'League+Script' => 'League Script', 'Leckerli+One' => 'Leckerli One', 'Ledger' => 'Ledger', 'Lekton' => 'Lekton', 
				'Lemon' => 'Lemon', 'Lemonada' => 'Lemonada', 'Libre+Barcode+128' => 'Libre Barcode 128', 'Libre+Barcode+128+Text' => 'Libre Barcode 128 Text', 'Libre+Barcode+39' => 'Libre Barcode 39', 'Libre+Barcode+39+Extended' => 'Libre Barcode 39 Extended', 'Libre+Barcode+39+Extended+Text' => 'Libre Barcode 39 Extended Text', 'Libre+Barcode+39+Text' => 'Libre Barcode 39 Text', 'Libre+Baskerville' => 'Libre Baskerville', 'Libre+Franklin' => 'Libre Franklin', 
				'Life+Savers' => 'Life Savers', 'Lilita+One' => 'Lilita One', 'Lily+Script+One' => 'Lily Script One', 'Limelight' => 'Limelight', 'Linden+Hill' => 'Linden Hill', 'Lobster' => 'Lobster', 'Lobster+Two' => 'Lobster Two', 'Londrina+Outline' => 'Londrina Outline', 'Londrina+Shadow' => 'Londrina Shadow', 'Londrina+Sketch' => 'Londrina Sketch', 
				'Londrina+Solid' => 'Londrina Solid', 'Lora' => 'Lora', 'Love+Ya+Like+A+Sister' => 'Love Ya Like A Sister', 'Loved+by+the+King' => 'Loved by the King', 'Lovers+Quarrel' => 'Lovers Quarrel', 'Luckiest+Guy' => 'Luckiest Guy', 'Lusitana' => 'Lusitana', 'Lustria' => 'Lustria', 'Macondo' => 'Macondo', 'Macondo+Swash+Caps' => 'Macondo Swash Caps', 
				'Mada' => 'Mada', 'Magra' => 'Magra', 'Maiden+Orange' => 'Maiden Orange', 'Maitree' => 'Maitree', 'Mako' => 'Mako', 'Mallanna' => 'Mallanna', 'Mandali' => 'Mandali', 'Manuale' => 'Manuale', 'Marcellus' => 'Marcellus', 'Marcellus+SC' => 'Marcellus SC', 
				'Marck+Script' => 'Marck Script', 'Margarine' => 'Margarine', 'Marko+One' => 'Marko One', 'Marmelad' => 'Marmelad', 'Martel' => 'Martel', 'Martel+Sans' => 'Martel Sans', 'Marvel' => 'Marvel', 'Mate' => 'Mate', 'Mate+SC' => 'Mate SC', 'Maven+Pro' => 'Maven Pro', 
				'McLaren' => 'McLaren', 'Meddon' => 'Meddon', 'MedievalSharp' => 'MedievalSharp', 'Medula+One' => 'Medula One', 'Meera+Inimai' => 'Meera Inimai', 'Megrim' => 'Megrim', 'Meie+Script' => 'Meie Script', 'Merienda' => 'Merienda', 'Merienda+One' => 'Merienda One', 'Merriweather' => 'Merriweather', 
				'Merriweather+Sans' => 'Merriweather Sans', 'Metal' => 'Metal', 'Metal+Mania' => 'Metal Mania', 'Metamorphous' => 'Metamorphous', 'Metrophobic' => 'Metrophobic', 'Michroma' => 'Michroma', 'Milonga' => 'Milonga', 'Miltonian' => 'Miltonian', 'Miltonian+Tattoo' => 'Miltonian Tattoo', 'Mina' => 'Mina', 
				'Miniver' => 'Miniver', 'Miriam+Libre' => 'Miriam Libre', 'Mirza' => 'Mirza', 'Miss+Fajardose' => 'Miss Fajardose', 'Mitr' => 'Mitr', 'Modak' => 'Modak', 'Modern+Antiqua' => 'Modern Antiqua', 'Mogra' => 'Mogra', 'Molengo' => 'Molengo', 'Molle' => 'Molle', 
				'Monda' => 'Monda', 'Monofett' => 'Monofett', 'Monoton' => 'Monoton', 'Monsieur+La+Doulaise' => 'Monsieur La Doulaise', 'Montaga' => 'Montaga', 'Montez' => 'Montez', 'Montserrat' => 'Montserrat', 'Montserrat+Alternates' => 'Montserrat Alternates', 'Montserrat+Subrayada' => 'Montserrat Subrayada', 'Moul' => 'Moul', 
				'Moulpali' => 'Moulpali', 'Mountains+of+Christmas' => 'Mountains of Christmas', 'Mouse+Memoirs' => 'Mouse Memoirs', 'Mr+Bedfort' => 'Mr Bedfort', 'Mr+Dafoe' => 'Mr Dafoe', 'Mr+De+Haviland' => 'Mr De Haviland', 'Mrs+Saint+Delafield' => 'Mrs Saint Delafield', 'Mrs+Sheppards' => 'Mrs Sheppards', 'Mukta' => 'Mukta', 'Mukta+Mahee' => 'Mukta Mahee', 
				'Mukta+Malar' => 'Mukta Malar', 'Mukta+Vaani' => 'Mukta Vaani', 'Muli' => 'Muli', 'Mystery+Quest' => 'Mystery Quest', 'NTR' => 'NTR', 'Nanum+Brush+Script' => 'Nanum Brush Script', 'Nanum+Gothic' => 'Nanum Gothic', 'Nanum+Gothic+Coding' => 'Nanum Gothic Coding', 'Nanum+Myeongjo' => 'Nanum Myeongjo', 'Nanum+Pen+Script' => 'Nanum Pen Script', 
				'Neucha' => 'Neucha', 'Neuton' => 'Neuton', 'New+Rocker' => 'New Rocker', 'News+Cycle' => 'News Cycle', 'Niconne' => 'Niconne', 'Nixie+One' => 'Nixie One', 'Nobile' => 'Nobile', 'Nokora' => 'Nokora', 'Norican' => 'Norican', 'Nosifer' => 'Nosifer', 
				'Nothing+You+Could+Do' => 'Nothing You Could Do', 'Noticia+Text' => 'Noticia Text', 'Noto+Sans' => 'Noto Sans', 'Noto+Serif' => 'Noto Serif', 'Nova+Cut' => 'Nova Cut', 'Nova+Flat' => 'Nova Flat', 'Nova+Mono' => 'Nova Mono', 'Nova+Oval' => 'Nova Oval', 'Nova+Round' => 'Nova Round', 'Nova+Script' => 'Nova Script', 
				'Nova+Slim' => 'Nova Slim', 'Nova+Square' => 'Nova Square', 'Numans' => 'Numans', 'Nunito' => 'Nunito', 'Nunito+Sans' => 'Nunito Sans', 'Odor+Mean+Chey' => 'Odor Mean Chey', 'Offside' => 'Offside', 'Old+Standard+TT' => 'Old Standard TT', 'Oldenburg' => 'Oldenburg', 'Oleo+Script' => 'Oleo Script', 
				'Oleo+Script+Swash+Caps' => 'Oleo Script Swash Caps', 'Open+Sans' => 'Open Sans', 'Open+Sans+Condensed' => 'Open Sans Condensed', 'Oranienbaum' => 'Oranienbaum', 'Orbitron' => 'Orbitron', 'Oregano' => 'Oregano', 'Orienta' => 'Orienta', 'Original+Surfer' => 'Original Surfer', 'Oswald' => 'Oswald', 'Over+the+Rainbow' => 'Over the Rainbow', 
				'Overlock' => 'Overlock', 'Overlock+SC' => 'Overlock SC', 'Overpass' => 'Overpass', 'Overpass+Mono' => 'Overpass Mono', 'Ovo' => 'Ovo', 'Oxygen' => 'Oxygen', 'Oxygen+Mono' => 'Oxygen Mono', 'PT+Mono' => 'PT Mono', 'PT+Sans' => 'PT Sans', 'PT+Sans+Caption' => 'PT Sans Caption', 
				'PT+Sans+Narrow' => 'PT Sans Narrow', 'PT+Serif' => 'PT Serif', 'PT+Serif+Caption' => 'PT Serif Caption', 'Pacifico' => 'Pacifico', 'Padauk' => 'Padauk', 'Palanquin' => 'Palanquin', 'Palanquin+Dark' => 'Palanquin Dark', 'Pangolin' => 'Pangolin', 'Paprika' => 'Paprika', 'Parisienne' => 'Parisienne', 
				'Passero+One' => 'Passero One', 'Passion+One' => 'Passion One', 'Pathway+Gothic+One' => 'Pathway Gothic One', 'Patrick+Hand' => 'Patrick Hand', 'Patrick+Hand+SC' => 'Patrick Hand SC', 'Pattaya' => 'Pattaya', 'Patua+One' => 'Patua One', 'Pavanam' => 'Pavanam', 'Paytone+One' => 'Paytone One', 'Peddana' => 'Peddana', 
				'Peralta' => 'Peralta', 'Permanent+Marker' => 'Permanent Marker', 'Petit+Formal+Script' => 'Petit Formal Script', 'Petrona' => 'Petrona', 'Philosopher' => 'Philosopher', 'Piedra' => 'Piedra', 'Pinyon+Script' => 'Pinyon Script', 'Pirata+One' => 'Pirata One', 'Plaster' => 'Plaster', 'Play' => 'Play', 
				'Playball' => 'Playball', 'Playfair+Display' => 'Playfair Display', 'Playfair+Display+SC' => 'Playfair Display SC', 'Podkova' => 'Podkova', 'Poiret+One' => 'Poiret One', 'Poller+One' => 'Poller One', 'Poly' => 'Poly', 'Pompiere' => 'Pompiere', 'Pontano+Sans' => 'Pontano Sans', 'Poppins' => 'Poppins', 
				'Port+Lligat+Sans' => 'Port Lligat Sans', 'Port+Lligat+Slab' => 'Port Lligat Slab', 'Pragati+Narrow' => 'Pragati Narrow', 'Prata' => 'Prata', 'Preahvihear' => 'Preahvihear', 'Press+Start+2P' => 'Press Start 2P', 'Pridi' => 'Pridi', 'Princess+Sofia' => 'Princess Sofia', 'Prociono' => 'Prociono', 'Prompt' => 'Prompt', 
				'Prosto+One' => 'Prosto One', 'Proza+Libre' => 'Proza Libre', 'Puritan' => 'Puritan', 'Purple+Purse' => 'Purple Purse', 'Quando' => 'Quando', 'Quantico' => 'Quantico', 'Quattrocento' => 'Quattrocento', 'Quattrocento+Sans' => 'Quattrocento Sans', 'Questrial' => 'Questrial', 'Quicksand' => 'Quicksand', 
				'Quintessential' => 'Quintessential', 'Qwigley' => 'Qwigley', 'Racing+Sans+One' => 'Racing Sans One', 'Radley' => 'Radley', 'Rajdhani' => 'Rajdhani', 'Rakkas' => 'Rakkas', 'Raleway' => 'Raleway', 'Raleway+Dots' => 'Raleway Dots', 'Ramabhadra' => 'Ramabhadra', 'Ramaraja' => 'Ramaraja', 
				'Rambla' => 'Rambla', 'Rammetto+One' => 'Rammetto One', 'Ranchers' => 'Ranchers', 'Rancho' => 'Rancho', 'Ranga' => 'Ranga', 'Rasa' => 'Rasa', 'Rationale' => 'Rationale', 'Ravi+Prakash' => 'Ravi Prakash', 'Redressed' => 'Redressed', 'Reem+Kufi' => 'Reem Kufi', 
				'Reenie+Beanie' => 'Reenie Beanie', 'Revalia' => 'Revalia', 'Rhodium+Libre' => 'Rhodium Libre', 'Ribeye' => 'Ribeye', 'Ribeye+Marrow' => 'Ribeye Marrow', 'Righteous' => 'Righteous', 'Risque' => 'Risque', 'Roboto' => 'Roboto', 'Roboto+Condensed' => 'Roboto Condensed', 'Roboto+Mono' => 'Roboto Mono', 
				'Roboto+Slab' => 'Roboto Slab', 'Rochester' => 'Rochester', 'Rock+Salt' => 'Rock Salt', 'Rokkitt' => 'Rokkitt', 'Romanesco' => 'Romanesco', 'Ropa+Sans' => 'Ropa Sans', 'Rosario' => 'Rosario', 'Rosarivo' => 'Rosarivo', 'Rouge+Script' => 'Rouge Script', 'Rozha+One' => 'Rozha One', 
				'Rubik' => 'Rubik', 'Rubik+Mono+One' => 'Rubik Mono One', 'Ruda' => 'Ruda', 'Rufina' => 'Rufina', 'Ruge+Boogie' => 'Ruge Boogie', 'Ruluko' => 'Ruluko', 'Rum+Raisin' => 'Rum Raisin', 'Ruslan+Display' => 'Ruslan Display', 'Russo+One' => 'Russo One', 'Ruthie' => 'Ruthie', 
				'Rye' => 'Rye', 'Sacramento' => 'Sacramento', 'Sahitya' => 'Sahitya', 'Sail' => 'Sail', 'Saira' => 'Saira', 'Saira+Condensed' => 'Saira Condensed', 'Saira+Extra+Condensed' => 'Saira Extra Condensed', 'Saira+Semi+Condensed' => 'Saira Semi Condensed', 'Salsa' => 'Salsa', 'Sanchez' => 'Sanchez', 
				'Sancreek' => 'Sancreek', 'Sansita' => 'Sansita', 'Sarala' => 'Sarala', 'Sarina' => 'Sarina', 'Sarpanch' => 'Sarpanch', 'Satisfy' => 'Satisfy', 'Scada' => 'Scada', 'Scheherazade' => 'Scheherazade', 'Schoolbell' => 'Schoolbell', 'Scope+One' => 'Scope One', 
				'Seaweed+Script' => 'Seaweed Script', 'Secular+One' => 'Secular One', 'Sedgwick+Ave' => 'Sedgwick Ave', 'Sedgwick+Ave+Display' => 'Sedgwick Ave Display', 'Sevillana' => 'Sevillana', 'Seymour+One' => 'Seymour One', 'Shadows+Into+Light' => 'Shadows Into Light', 'Shadows+Into+Light+Two' => 'Shadows Into Light Two', 'Shanti' => 'Shanti', 'Share' => 'Share', 
				'Share+Tech' => 'Share Tech', 'Share+Tech+Mono' => 'Share Tech Mono', 'Shojumaru' => 'Shojumaru', 'Short+Stack' => 'Short Stack', 'Shrikhand' => 'Shrikhand', 'Siemreap' => 'Siemreap', 'Sigmar+One' => 'Sigmar One', 'Signika' => 'Signika', 'Signika+Negative' => 'Signika Negative', 'Simonetta' => 'Simonetta', 
				'Sintony' => 'Sintony', 'Sirin+Stencil' => 'Sirin Stencil', 'Six+Caps' => 'Six Caps', 'Skranji' => 'Skranji', 'Slabo+13px' => 'Slabo 13px', 'Slabo+27px' => 'Slabo 27px', 'Slackey' => 'Slackey', 'Smokum' => 'Smokum', 'Smythe' => 'Smythe', 'Sniglet' => 'Sniglet', 
				'Snippet' => 'Snippet', 'Snowburst+One' => 'Snowburst One', 'Sofadi+One' => 'Sofadi One', 'Sofia' => 'Sofia', 'Sonsie+One' => 'Sonsie One', 'Sorts+Mill+Goudy' => 'Sorts Mill Goudy', 'Source+Code+Pro' => 'Source Code Pro', 'Source+Sans+Pro' => 'Source Sans Pro', 'Source+Serif+Pro' => 'Source Serif Pro', 'Space+Mono' => 'Space Mono', 
				'Special+Elite' => 'Special Elite', 'Spectral' => 'Spectral', 'Spectral+SC' => 'Spectral SC', 'Spicy+Rice' => 'Spicy Rice', 'Spinnaker' => 'Spinnaker', 'Spirax' => 'Spirax', 'Squada+One' => 'Squada One', 'Sree+Krushnadevaraya' => 'Sree Krushnadevaraya', 'Sriracha' => 'Sriracha', 'Stalemate' => 'Stalemate', 
				'Stalinist+One' => 'Stalinist One', 'Stardos+Stencil' => 'Stardos Stencil', 'Stint+Ultra+Condensed' => 'Stint Ultra Condensed', 'Stint+Ultra+Expanded' => 'Stint Ultra Expanded', 'Stoke' => 'Stoke', 'Strait' => 'Strait', 'Sue+Ellen+Francisco' => 'Sue Ellen Francisco', 'Suez+One' => 'Suez One', 'Sumana' => 'Sumana', 'Sunshiney' => 'Sunshiney', 
				'Supermercado+One' => 'Supermercado One', 'Sura' => 'Sura', 'Suranna' => 'Suranna', 'Suravaram' => 'Suravaram', 'Suwannaphum' => 'Suwannaphum', 'Swanky+and+Moo+Moo' => 'Swanky and Moo Moo', 'Syncopate' => 'Syncopate', 'Tangerine' => 'Tangerine', 'Taprom' => 'Taprom', 'Tauri' => 'Tauri', 
				'Taviraj' => 'Taviraj', 'Teko' => 'Teko', 'Telex' => 'Telex', 'Tenali+Ramakrishna' => 'Tenali Ramakrishna', 'Tenor+Sans' => 'Tenor Sans', 'Text+Me+One' => 'Text Me One', 'The+Girl+Next+Door' => 'The Girl Next Door', 'Tienne' => 'Tienne', 'Tillana' => 'Tillana', 'Timmana' => 'Timmana', 
				'Tinos' => 'Tinos', 'Titan+One' => 'Titan One', 'Titillium+Web' => 'Titillium Web', 'Trade+Winds' => 'Trade Winds', 'Trirong' => 'Trirong', 'Trocchi' => 'Trocchi', 'Trochut' => 'Trochut', 'Trykker' => 'Trykker', 'Tulpen+One' => 'Tulpen One', 'Ubuntu' => 'Ubuntu', 
				'Ubuntu+Condensed' => 'Ubuntu Condensed', 'Ubuntu+Mono' => 'Ubuntu Mono', 'Ultra' => 'Ultra', 'Uncial+Antiqua' => 'Uncial Antiqua', 'Underdog' => 'Underdog', 'Unica+One' => 'Unica One', 'UnifrakturCook' => 'UnifrakturCook', 'UnifrakturMaguntia' => 'UnifrakturMaguntia', 'Unkempt' => 'Unkempt', 'Unlock' => 'Unlock', 
				'Unna' => 'Unna', 'VT323' => 'VT323', 'Vampiro+One' => 'Vampiro One', 'Varela' => 'Varela', 'Varela+Round' => 'Varela Round', 'Vast+Shadow' => 'Vast Shadow', 'Vesper+Libre' => 'Vesper Libre', 'Vibur' => 'Vibur', 'Vidaloka' => 'Vidaloka', 'Viga' => 'Viga', 
				'Voces' => 'Voces', 'Volkhov' => 'Volkhov', 'Vollkorn' => 'Vollkorn', 'Vollkorn+SC' => 'Vollkorn SC', 'Voltaire' => 'Voltaire', 'Waiting+for+the+Sunrise' => 'Waiting for the Sunrise', 'Wallpoet' => 'Wallpoet', 'Walter+Turncoat' => 'Walter Turncoat', 'Warnes' => 'Warnes', 'Wellfleet' => 'Wellfleet', 
				'Wendy+One' => 'Wendy One', 'Wire+One' => 'Wire One', 'Work+Sans' => 'Work Sans', 'Yanone+Kaffeesatz' => 'Yanone Kaffeesatz', 'Yantramanav' => 'Yantramanav', 'Yatra+One' => 'Yatra One', 'Yellowtail' => 'Yellowtail', 'Yeseva+One' => 'Yeseva One', 'Yesteryear' => 'Yesteryear', 'Yrsa' => 'Yrsa', 
				'Zeyada' => 'Zeyada', 'Zilla+Slab' => 'Zilla Slab', 'Zilla+Slab+Highlight' => 'Zilla Slab Highlight', 		
			);
				
		}
		

		/**
		 * This will create the preview css 
		 *
		 * @since 1.0
		 */
		public function cs_preview_css($field_value){
			
			$preview_css = '';
			
			if(is_array($field_value)){

				if(isset($field_value['backup_font']) && !empty($field_value['backup_font'])){
					$preview_css .= 'font-family:' . $field_value['backup_font'] . ';';
				}
				
				foreach($field_value as $css_property => $css_value){

					if(!empty($css_value) 
						&& strpos($css_property, '_value') === false
						&& strpos($css_property, '_unit') === false
						&& !in_array($css_property, array('google_font', 'backup_font'))){
						
						$preview_css .= str_replace('_', '-', $css_property) . ':' . $css_value . ';';
						
					}
					
				}
				
				if(!empty($form_title_css))
					$preview_css .= '.cspmas_form_title{' . $form_title_css . '}';
				
			}
			
			return $preview_css;
						
		}
			
	
		/**
		 * Enqueue scripts and styles
		 *
		 * @since 1.0
		 */
		public function cs_enqueue_scripts(){
			
			/**
			 * CSS */
								
			wp_enqueue_style('cs-typography-style', $this->plugin_url.'/css/style.css', array(), self::VERSION);
			
			/**
			 * JS */
								
			wp_enqueue_script('cs-typography-script', $this->plugin_url.'/js/script.js', array('jquery'), self::VERSION);
			
		}
		
	}
	
	$CS_CMB2_typography_Field = new CS_CMB2_typography_Field();
	
}
		
