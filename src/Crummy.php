<?php namespace Wibleh\Crummy;

/**
 * Class Crummy
 * @package Wibleh\Crummy
 */
class Crummy
{
    /**
     * The container for the breadcrumbs.
     * @var array
     */
    public $crumbs = array();

    /**
     * Add a text item to the breadcrumbs.
     *
     * @param string $text
     * @param array $attributes
     */
    public function text($text = '', $attributes = array())
    {
        $this->crumbs[] = array(
            'url' => false,
            'text' => $text,
            'attributes' => $attributes,
        );
    }

    /**
     * Add a link to the breadcrumbs.
     *
     * @param string $url
     * @param string $text
     * @param array $attributes
     */
    public function link($url = '', $text = '', $attributes = array())
    {
        $this->crumbs[] = array(
            'url' => $url,
            'text' => $text,
            'attributes' => $attributes
        );
    }

    /**
     * Count the number of crumbs in the breadcrumbs trail.
     *
     * @return int
     */
    public function count()
    {
        return count($this->crumbs);
    }

    /**
     * Return HTML in Twitter Bootstrap 3 compatible format.
     *
     * @return string
     */
    public function display()
    {
        if (!$this->count()) return "";

        ob_start();

        echo '<ul class="breadcrumb">';

        $count = $this->count();

        $this->crumbs = array_values($this->crumbs);

        foreach ($this->crumbs as $crumb_index => $crumb) {
            $li_class = array();
            if ($crumb_index == 0) $li_class[] = "first";
            if ($crumb_index == ($count - 1)) $li_class[] = "last";
            $li_class[] = $crumb['url'] ? "crumb-link" : "crumb-text";
            $c = "<li" . (count($li_class) ? ' class="' . implode(" ", $li_class) . '"' : '') . ">";
            if (!empty($crumb['url'])) {
                $c .= '<a href="' . $crumb['url'] . '"';
                foreach ($crumb['attributes'] as $k => $v) {
                    $c .= ' ' . e($k) . '="' . e($v) . '"';
                }
                $c .= ">" . e($crumb['text']) . "</a>";
            } else {
                $c .= '<span';
                foreach ($crumb['attributes'] as $k => $v) {
                    $c .= ' ' . e($k) . '="' . e($v) . '"';
                }
                $c .= ">" . e($crumb['text']) . "</span>";
            }
            $c .= '</li>';

            echo $c;
        }

        echo '</ul>';

        return ob_get_clean();
    }

    /**
     * Remove one or more crumbs from the end of the breadcrumbs.
     *
     * @param int $count
     */
    public function remove($count = 1)
    {
        while ($this->count() && $count) {
            array_pop($this->crumbs);
            $count--;
        }
    }

    /**
     * Convert one or more crumbs from the end of the trail, from links into text.
     *
     * @param int $count
     */
    public function flatten($count = 1)
    {
        if (!$this->count()) return;

        $this->crumbs = array_values($this->crumbs);

        $pos = $this->count() - $count;

        while ($pos < $this->count()) {
            $this->crumbs[$pos]['url'] = NULL;
            $pos++;
        }
    }
}





