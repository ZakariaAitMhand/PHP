<?php
class graph
{
    function graph()
    {
         $this->data = array();
         $this->x_labels = array();
         $this->y_max = 20;
         $this->y_steps = 5;
         $this->title = '';
         $this->title_size = 30;
         
         $this->x_legend = '';
         $this->x_legend_size = 20;
         $this->x_legend_colour = '0x000000';
         $this->x_tick_size = -1;
         
         $this->x_label_style_size = -1;
         $this->x_label_style_colour = '0x000000';
         
         $this->y_legend = '';
         $this->y_legend_size = 20;
         $this->y_legend_colour = '0x000000';
         
         $this->lines = array();
         $this->line_default = '&line=3,0x87421F&'. "\r\n";
         
         $this->bg_colour = '0xFFFFFF';
    }

    function set_data( $a )
    {
    	if( count( $this->data ) == 0 )
        	$this->data[] = '&values='.implode(',',$a).'&'."\r\n";
        else
        	$this->data[] = '&values_'. (count( $this->data )+1) .'='.implode(',',$a).'&'."\r\n";
    }
    
    function set_x_labels( $a )
    {
        $this->x_labels = $a;
    }
    
    function set_x_label_style( $size, $colour='' )
    {
        $this->x_label_style_size = $size;
        if( strlen( $colour ) > 0 )
                $this->x_label_style_colour = $colour;
    }
    
    function set_y_max( $max )
    {

        $this->y_max = intval( $max );
    }
    
    function y_label_steps( $val )
    {
         $this->y_steps = intval( $val );
    }
    
    function title( $title, $size=-1, $colour='' )
    {
        $this->title = $title;
        if( $size > 0 )
                $this->title_size = $size;
        if( strlen( $colour ) > 0 )
                $this->title_colour = $colour;
    }
    
    function set_x_legend( $text, $size=-1, $colour='' )
    {
         $this->x_legend = $text;
         if( $size > -1 )
                $this->x_legend_size = $size;
                
         if( strlen( $colour )>0 )
                $this->x_legend_colour = $colour;
    }
    
    function set_x_tick_size( $size )
    {
        if( $size > 0 )
                $this->x_tick_size = $size;
    }
    
    function set_y_legend( $text, $size=-1, $colour='' )
    {
         $this->y_legend = $text;
         if( $size > -1 )
                $this->y_legend_size = $size;

         if( strlen( $colour )>0 )
                $this->y_legend_colour = $colour;
    }
    
    function line( $width, $colour='', $text='', $size=-1, $circles=-1 )
    {
    	$tmp = '&line';
    	
    	if( count( $this->lines ) > 0 )
        	$tmp .= '_'. (count( $this->lines )+1);
        	
    	$tmp .= '=';
    	
        if( $width > 0 )
        {
                $tmp .= $width;
                $tmp .= ','. $colour;
        }
                
        if( strlen( $text ) > 0 )
        {
                $tmp .= ','. $text;
                $tmp .= ','. $size;
        }
        
        if( $circles > 0 )
                $tmp .= ','. $circles;
        
        $tmp .= "&\r\n";;
        
        $this->lines[] = $tmp;
    }

    function line_dot( $width, $dot_size, $colour, $text, $font_size )
    {
    	$tmp = '&line_dot';
    	
    	if( count( $this->lines ) > 0 )
        	$tmp .= '_'. (count( $this->lines )+1);
        	
    	$tmp .= "=$width,$colour,$text,$font_size,$dot_size&\r\n";
        
        $this->lines[] = $tmp;
    }

    function line_hollow( $width, $dot_size, $colour, $text, $font_size )
    {
    	$tmp = '&line_hollow';
    	
    	if( count( $this->lines ) > 0 )
        	$tmp .= '_'. (count( $this->lines )+1);
        	
    	$tmp .= "=$width,$colour,$text,$font_size,$dot_size&\r\n";
        
        $this->lines[] = $tmp;
    }


    function bar( $alpha, $colour='', $text='', $size=-1 )
    {
    	$tmp = '&bar';
    	
    	if( count( $this->lines ) > 0 )
        	$tmp .= '_'. (count( $this->lines )+1);
        	
    	$tmp .= '=';
        $tmp .= $alpha .','. $colour .','. $text .','. $size;
        $tmp .= "&\r\n";;
        
        $this->lines[] = $tmp;
    }

    function bar_filled( $alpha, $colour, $colour_outline, $text='', $size=-1 )
    {
    	$tmp = '&filled_bar';
    	
    	if( count( $this->lines ) > 0 )
        	$tmp .= '_'. (count( $this->lines )+1);
        	
    	$tmp .= "=$alpha,$colour,$colour_outline,$text,$size&\r\n";
        
        $this->lines[] = $tmp;
    }

    function render()
    {
        //$tmp = "&padding=70,5,50,40&\r\n";
        
        if( strlen( $this->title ) > 0 )
        {
                $tmp .= '&title='. $this->title .',';
                $tmp .= $this->title_size .',';
                $tmp .= $this->title_colour .'&';
                $tmp .= "\r\n";
        }
        
        if( strlen( $this->x_legend ) > 0 )
        {
                $tmp .= '&x_legend='. $this->x_legend .',';
                $tmp .= $this->x_legend_size .',';
                $tmp .= $this->x_legend_colour ."&\r\n";
        }
        
        if( $this->x_label_style_size > 0 )
        {
                $tmp .= '&x_label_style='. $this->x_label_style_size;
                $tmp .= ','.$this->x_label_style_colour;
                $tmp .= "&\r\n";
        }
        
        if( $this->x_tick_size > 0 )
                $tmp .= "&x_ticks=". $this->x_tick_size ."&\r\n";
        
        if( strlen( $this->y_legend ) > 0 )
        {
                $tmp .= '&y_legend='. $this->y_legend .',';
                $tmp .= $this->y_legend_size .',';
                $tmp .= $this->y_legend_colour ."&\r\n";
        }
        $tmp .= "&y_label_size=15&\r\n";
        $tmp .= '&y_ticks=5,10,'. $this->y_steps .'&'."\r\n";
        
		if( count( $this->lines ) == 0 )
		{
			$tmp .= $this->line_default;	
		}
		else
		{
			foreach( $this->lines as $line )
				$tmp .= $line;	
		}

		foreach( $this->data as $data )
				$tmp .= $data;
        
        if( count( $this->x_labels ) > 0 )
                $tmp .= '&x_labels='.implode(',',$this->x_labels).'&'."\r\n";
                
        $tmp .= '&y_max='. $this->y_max .'&'."\r\n";
        
        if( strlen( $this->bg_colour ) > 0 )
        	$tmp .= '&bg_colour='. $this->bg_colour .'&'."\r\n";
        

        return $tmp;
    }
}
?>
