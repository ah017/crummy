<?php namespace Wibleh\Crummy;

class Crummy
{
	public static $crumbs = array();
	
	public static function text($text = '', $attributes = array())
	{
		static::$crumbs[] = array(
			'url' => false,
			'text' => $text,
			'attributes' => $attributes,
		);
	}
	
	public static function link($url = '', $text = '', $attributes = array())
	{
		static::$crumbs[] = array(
			'url' => $url, 
			'text' => $text, 
			'attributes' => $attributes
		);
	}
	
	public static function count()
	{
		return count(static::$crumbs);
	}
	
	public static function display()
	{
		if (!count(static::$crumbs)) return "";
		
		ob_start();
		
		echo '<ul class="breadcrumb">';
		
		$i = 0;
		$count = count(static::$crumbs);
		
		foreach (static::$crumbs as $crumb_index => $crumb) {
			$li_class = array();
			if ($crumb_index == 0) $li_class[] = "first";
			if ($crumb_index == ($count-1)) $li_class[] = "last";
			$li_class[] = $crumb['url'] ? "crumb-link" : "crumb-text";
			$c = "<li" . (count($li_class) ? ' class="'.implode(" ", $li_class).'"' : '') . ">";
			$div = ($i++ < ($count-1)) ? ' <span class="divider">'.e($divider).'</span>' : '';
			if (!empty($crumb['url'])) {
				$c .= '<a href="' . $crumb['url'] . '"';
				foreach ($crumb['attributes'] as $k => $v) {
					$c .= ' ' . e($k) . '="' . e($v) . '"';
				}
				$c .= ">".e($crumb['text'])."</a>";
			}
			else {
				$c .= '<span';
				foreach ($crumb['attributes'] as $k => $v) {
					$c .= ' ' . e($k) . '="' . e($v) . '"';
				}
				$c .= ">" . e($crumb['text']) . "</span>";
			}
			$c .= $div;
			$c .= '</li>';
			
			echo $c;
		}
		
		echo '</ul>';
		
		return ob_get_clean();
	}
	
	public static function remove($count=1)
	{
		while (count(static::$crumbs)  &&  $count) {
			array_pop(static::$crumbs);
			$count--;
		}
	}
	
	public static function flatten($count=1)
	{
		static::$crumbs = array_values(static::$crumbs);
		
		if (!count(static::$crumbs)) return;
		
		$pos = count(static::$crumbs) - $count;
		
		while ($pos < count(static::$crumbs)) {
			static::$crumbs[$pos]['url'] = NULL;
			$pos++;
		}
	}
}





