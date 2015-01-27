<?php
/**
* Jin Framework
* Diatem
*/

namespace jin\lang;

/** Boite à outils pour les couleurs
*
*  @auteur     Samuel Marchal
*  @version    0.0.1
*  @check      21/10/2014
*/
class ColorTools {

    /**
     * X11 color names and their RGB value
     * @var array
     */
    public static $x11 = array(
        'aliceblue'             => array('red' => 240,  'green' => 248, 'blue' => 255),
        'antiquewhite'          => array('red' => 250,  'green' => 235, 'blue' => 215),
        'aqua'                  => array('red' => 0,    'green' => 255, 'blue' => 255),
        'aquamarine'            => array('red' => 127,  'green' => 255, 'blue' => 212),
        'azure'                 => array('red' => 240,  'green' => 255, 'blue' => 255),
        'beige'                 => array('red' => 245,  'green' => 245, 'blue' => 220),
        'bisque'                => array('red' => 255,  'green' => 228, 'blue' => 196),
        'black'                 => array('red' => 0,    'green' => 0,   'blue' => 0),
        'blanchedalmond'        => array('red' => 255,  'green' => 235, 'blue' => 205),
        'blue'                  => array('red' => 0,    'green' => 0,   'blue' => 255),
        'blueviolet'            => array('red' => 138,  'green' => 43,  'blue' => 226),
        'brown'                 => array('red' => 165,  'green' => 42,  'blue' => 42),
        'burlywood'             => array('red' => 222,  'green' => 184, 'blue' => 135),
        'cadetblue'             => array('red' => 95,   'green' => 158, 'blue' => 160),
        'chartreuse'            => array('red' => 127,  'green' => 255, 'blue' => 0),
        'chocolate'             => array('red' => 210,  'green' => 105, 'blue' => 30),
        'coral'                 => array('red' => 255,  'green' => 127, 'blue' => 80),
        'cornflowerblue'        => array('red' => 100,  'green' => 149, 'blue' => 237),
        'cornsilk'              => array('red' => 255,  'green' => 248, 'blue' => 220),
        'crimson'               => array('red' => 220,  'green' => 20,  'blue' => 60),
        'cyan'                  => array('red' => 0,    'green' => 255, 'blue' => 255),
        'darkblue'              => array('red' => 0,    'green' => 0,   'blue' => 139),
        'darkcyan'              => array('red' => 0,    'green' => 139, 'blue' => 139),
        'darkgoldenrod'         => array('red' => 184,  'green' => 134, 'blue' => 11),
        'darkgray'              => array('red' => 169,  'green' => 169, 'blue' => 169),
        'darkgreen'             => array('red' => 0,    'green' => 100, 'blue' => 0),
        'darkkhaki'             => array('red' => 189,  'green' => 183, 'blue' => 107),
        'darkmagenta'           => array('red' => 139,  'green' => 0,   'blue' => 139),
        'darkolivegreen'        => array('red' => 85,   'green' => 107, 'blue' => 47),
        'darkorange'            => array('red' => 255,  'green' => 140, 'blue' => 0),
        'darkorchid'            => array('red' => 153,  'green' => 50,  'blue' => 204),
        'darkred'               => array('red' => 139,  'green' => 0,   'blue' => 0),
        'darksalmon'            => array('red' => 233,  'green' => 150, 'blue' => 122),
        'darkseagreen'          => array('red' => 143,  'green' => 188, 'blue' => 143),
        'darkslateblue'         => array('red' => 72,   'green' => 61,  'blue' => 139),
        'darkslategray'         => array('red' => 47,   'green' => 79,  'blue' => 79),
        'darkturquoise'         => array('red' => 0,    'green' => 206, 'blue' => 209),
        'darkviolet'            => array('red' => 148,  'green' => 0,   'blue' => 211),
        'deeppink'              => array('red' => 255,  'green' => 20,  'blue' => 147),
        'deepskyblue'           => array('red' => 0,    'green' => 191, 'blue' => 255),
        'dimgray'               => array('red' => 105,  'green' => 105, 'blue' => 105),
        'dodgerblue'            => array('red' => 30,   'green' => 144, 'blue' => 255),
        'firebrick'             => array('red' => 178,  'green' => 34,  'blue' => 34),
        'floralwhite'           => array('red' => 255,  'green' => 250, 'blue' => 240),
        'forestgreen'           => array('red' => 34,   'green' => 139, 'blue' => 34),
        'fuchsia'               => array('red' => 255,  'green' => 0,   'blue' => 255),
        'gainsboro'             => array('red' => 220,  'green' => 220, 'blue' => 220),
        'ghostwhite'            => array('red' => 248,  'green' => 248, 'blue' => 255),
        'gold'                  => array('red' => 255,  'green' => 215, 'blue' => 0),
        'goldenrod'             => array('red' => 218,  'green' => 165, 'blue' => 32),
        'gray'                  => array('red' => 128,  'green' => 128, 'blue' => 128),
        'green'                 => array('red' => 0,    'green' => 128, 'blue' => 0),
        'greenyellow'           => array('red' => 173,  'green' => 255, 'blue' => 47),
        'honeydew'              => array('red' => 240,  'green' => 255, 'blue' => 240),
        'hotpink'               => array('red' => 255,  'green' => 105, 'blue' => 180),
        'indianred'             => array('red' => 205,  'green' => 92,  'blue' => 92),
        'indigo'                => array('red' => 75,   'green' => 0,   'blue' => 130),
        'ivory'                 => array('red' => 255,  'green' => 255, 'blue' => 240),
        'khaki'                 => array('red' => 240,  'green' => 230, 'blue' => 140),
        'lavender'              => array('red' => 230,  'green' => 230, 'blue' => 250),
        'lavenderblush'         => array('red' => 255,  'green' => 240, 'blue' => 245),
        'lawngreen'             => array('red' => 124,  'green' => 252, 'blue' => 0),
        'lemonchiffon'          => array('red' => 255,  'green' => 250, 'blue' => 205),
        'lightblue'             => array('red' => 173,  'green' => 216, 'blue' => 230),
        'lightcoral'            => array('red' => 240,  'green' => 128, 'blue' => 128),
        'lightcyan'             => array('red' => 224,  'green' => 255, 'blue' => 255),
        'lightgoldenrodyellow'  => array('red' => 250,  'green' => 250, 'blue' => 210),
        'lightgreen'            => array('red' => 144,  'green' => 238, 'blue' => 144),
        'lightgrey'             => array('red' => 211,  'green' => 211, 'blue' => 211),
        'lightpink'             => array('red' => 255,  'green' => 182, 'blue' => 193),
        'lightsalmon'           => array('red' => 255,  'green' => 160, 'blue' => 122),
        'lightseagreen'         => array('red' => 32,   'green' => 178, 'blue' => 170),
        'lightskyblue'          => array('red' => 135,  'green' => 206, 'blue' => 250),
        'lightslategray'        => array('red' => 119,  'green' => 136, 'blue' => 153),
        'lightsteelblue'        => array('red' => 176,  'green' => 196, 'blue' => 222),
        'lightyellow'           => array('red' => 255,  'green' => 255, 'blue' => 224),
        'lime'                  => array('red' => 0,    'green' => 255, 'blue' => 0),
        'limegreen'             => array('red' => 50,   'green' => 205, 'blue' => 50),
        'linen'                 => array('red' => 250,  'green' => 240, 'blue' => 230),
        'magenta'               => array('red' => 255,  'green' => 0,   'blue' => 255),
        'maroon'                => array('red' => 128,  'green' => 0,   'blue' => 0),
        'mediumaquamarine'      => array('red' => 102,  'green' => 205, 'blue' => 170),
        'mediumblue'            => array('red' => 0,    'green' => 0,   'blue' => 205),
        'mediumorchid'          => array('red' => 186,  'green' => 85,  'blue' => 211),
        'mediumpurple'          => array('red' => 147,  'green' => 112, 'blue' => 219),
        'mediumseagreen'        => array('red' => 60,   'green' => 179, 'blue' => 113),
        'mediumslateblue'       => array('red' => 123,  'green' => 104, 'blue' => 238),
        'mediumspringgreen'     => array('red' => 0,    'green' => 250, 'blue' => 154),
        'mediumturquoise'       => array('red' => 72,   'green' => 209, 'blue' => 204),
        'mediumvioletred'       => array('red' => 199,  'green' => 21,  'blue' => 133),
        'midnightblue'          => array('red' => 25,   'green' => 25,  'blue' => 112),
        'mintcream'             => array('red' => 245,  'green' => 255, 'blue' => 250),
        'mistyrose'             => array('red' => 255,  'green' => 228, 'blue' => 225),
        'moccasin'              => array('red' => 255,  'green' => 228, 'blue' => 181),
        'navajowhite'           => array('red' => 255,  'green' => 222, 'blue' => 173),
        'navy'                  => array('red' => 0,    'green' => 0,   'blue' => 128),
        'oldlace'               => array('red' => 253,  'green' => 245, 'blue' => 230),
        'olive'                 => array('red' => 128,  'green' => 128, 'blue' => 0),
        'olivedrab'             => array('red' => 107,  'green' => 142, 'blue' => 35),
        'orange'                => array('red' => 255,  'green' => 165, 'blue' => 0),
        'orangered'             => array('red' => 255,  'green' => 69,  'blue' => 0),
        'orchid'                => array('red' => 218,  'green' => 112, 'blue' => 214),
        'palegoldenrod'         => array('red' => 238,  'green' => 232, 'blue' => 170),
        'palegreen'             => array('red' => 152,  'green' => 251, 'blue' => 152),
        'paleturquoise'         => array('red' => 175,  'green' => 238, 'blue' => 238),
        'palevioletred'         => array('red' => 219,  'green' => 112, 'blue' => 147),
        'papayawhip'            => array('red' => 255,  'green' => 239, 'blue' => 213),
        'peachpuff'             => array('red' => 255,  'green' => 218, 'blue' => 185),
        'peru'                  => array('red' => 205,  'green' => 133, 'blue' => 63),
        'pink'                  => array('red' => 255,  'green' => 192, 'blue' => 203),
        'plum'                  => array('red' => 221,  'green' => 160, 'blue' => 221),
        'powderblue'            => array('red' => 176,  'green' => 224, 'blue' => 230),
        'purple'                => array('red' => 128,  'green' => 0,   'blue' => 128),
        'red'                   => array('red' => 255,  'green' => 0,   'blue' => 0),
        'rosybrown'             => array('red' => 188,  'green' => 143, 'blue' => 143),
        'royalblue'             => array('red' => 65,   'green' => 105, 'blue' => 225),
        'saddlebrown'           => array('red' => 139,  'green' => 69,  'blue' => 19),
        'salmon'                => array('red' => 250,  'green' => 128, 'blue' => 114),
        'sandybrown'            => array('red' => 244,  'green' => 164, 'blue' => 96),
        'seagreen'              => array('red' => 46,   'green' => 139, 'blue' => 87),
        'seashell'              => array('red' => 255,  'green' => 245, 'blue' => 238),
        'sienna'                => array('red' => 160,  'green' => 82,  'blue' => 45),
        'silver'                => array('red' => 192,  'green' => 192, 'blue' => 192),
        'skyblue'               => array('red' => 135,  'green' => 206, 'blue' => 235),
        'slateblue'             => array('red' => 106,  'green' => 90,  'blue' => 205),
        'slategray'             => array('red' => 112,  'green' => 128, 'blue' => 144),
        'snow'                  => array('red' => 255,  'green' => 250, 'blue' => 250),
        'springgreen'           => array('red' => 0,    'green' => 255, 'blue' => 127),
        'steelblue'             => array('red' => 70,   'green' => 130, 'blue' => 180),
        'tan'                   => array('red' => 210,  'green' => 180, 'blue' => 140),
        'teal'                  => array('red' => 0,    'green' => 128, 'blue' => 128),
        'thistle'               => array('red' => 216,  'green' => 191, 'blue' => 216),
        'tomato'                => array('red' => 255,  'green' => 99,  'blue' => 71),
        'turquoise'             => array('red' => 64,   'green' => 224, 'blue' => 208),
        'violet'                => array('red' => 238,  'green' => 130, 'blue' => 238),
        'wheat'                 => array('red' => 245,  'green' => 222, 'blue' => 179),
        'white'                 => array('red' => 255,  'green' => 255, 'blue' => 255),
        'whitesmoke'            => array('red' => 245,  'green' => 245, 'blue' => 245),
        'yellow'                => array('red' => 255,  'green' => 255, 'blue' => 0),
        'yellowgreen'           => array('red' => 154,  'green' => 205, 'blue' => 50)
    );

    /**
     * Change a color format to hexadecimal
     * @param  mixed $color Color
     * @return array        An 6-hexadecimal color prefixed by an hash
     */
    public static function toHex($color) {
        // Check it it's a RGB color
        if(is_array($color)) {
            if((count($color) == 3 && array_keys($color) === range(0, 2))
                || (count($color) == 4 && array_keys($color) === range(0, 3))) {
                $red = $color[0];
                $green = $color[1];
                $blue = $color[2];
            } else {
                $red = $color['red'] ?: ($color['r'] ?: 0);
                $green = $color['green'] ?: ($color['g'] ?: 0);
                $blue = $color['blue'] ?: ($color['b'] ?: 0);
            }
            return '#'
                .substr('00' . dechex($red), -2)
                .substr('00' . dechex($green), -2)
                .substr('00' . dechex($blue), -2);
        }
        if(is_string($color)) {
            $color = strtolower($color);

            // Check if it's a X11 color
            if(array_key_exists($color, self::$x11) !== false) {
                return self::toHex(self::$x11[$color]);
            }

            // Check if it's an 3-hexadecimal color
            if(preg_match('/^#[\da-f]{3}$/i', $color)) {
                $color = preg_replace('/([\da-f])/i', '$1$1', $color);
            }
            if(preg_match('/^#[\da-f]{6}$/i', $color)) {
                return $color;
            }
        }

        return '#000000';
    }

    /**
     * Change a color format to RGB
     * @param  mixed $color Color
     * @return array        An [red, green, blue] associative array
     */
    public static function toRGB($color) {
        $color = self::toRGBA($color);
        unset($color['alpha']);
        return $color;
    }

    /**
     * Change a color format to RGBA
     * @param  mixed $color Color
     * @return array        An [red, green, blue, alpha] associative array
     */
    public static function toRGBA($color) {
        // Check it it's already a RGB color
        if(is_array($color)) {
            if(count($color) == 3 && array_keys($color) === range(0, 2)) {
                return array(
                    'red' => $color[0],
                    'green' => $color[1],
                    'blue' => $color[2],
                    'alpha' => 1
                );
            }
            if(count($color) == 4 && array_keys($color) === range(0, 3)) {
                return array(
                    'red' => $color[0],
                    'green' => $color[1],
                    'blue' => $color[2],
                    'alpha' => $color[3]
                );
            }
            return array(
                'red' => isset($color['red'])
                    ? $color['red']
                    : (isset($color['r']) ? $color['r'] : 0),
                'green' => isset($color['green'])
                    ? $color['green']
                    : (isset($color['g']) ? $color['g'] : 0),
                'blue' => isset($color['blue'])
                    ? $color['blue']
                    : (isset($color['b']) ? $color['b'] : 0),
                'alpha' => isset($color['alpha'])
                    ? $color['alpha']
                    : 1
            );
        }
        if(is_string($color)) {
            $color = strtolower($color);

            // Check if it's a X11 color
            if(array_key_exists($color, self::$x11) !== false) {
                $color = self::$x11[$color];
                $color['alpha'] = 1;
                return $color;
            }

            // Check if it's an hexadecimal color
            if(preg_match('/^#[\da-f]{3}$/i', $color)) {
                $color = preg_replace('/([\da-f])/i', '$1$1', $color);
            }
            if(preg_match('/^#[\da-f]{6}$/i', $color)) {
                list($red, $green, $blue) = sscanf($color, "#%02x%02x%02x");
                return array(
                    'red' => $red,
                    'green' => $green,
                    'blue' => $blue,
                    'alpha' => 1
                );
            }
        }

        return array('red' => 0, 'green' => 0, 'blue' => 0, 'alpha' => 1);
    }

    /**
     * Change a color format to the HTML rgb() one
     * @param  mixed $color Color
     * @return string       rgb(red, green, blue)
     */
    public static function toHTMLRGB($color) {
        $color = self::toRGB($color);
        return 'rgb('.$color['red'].', '.$color['green'].', '.$color['blue'].')';
    }

    /**
     * Change a color format to the HTML rgb() one
     * @param  mixed $color Color
     * @return string       rgba(red, green, blue, alpha)
     */
    public static function toHTMLRGBA($color) {
        $color = self::toRGBA($color);
        return 'rgba('.$color['red'].', '.$color['green'].', '.$color['blue'].', '.$color['alpha'].')';
    }

    /**
     * Return the dominant color for an image
     * @param  string   $src        Image path/url
     * @param  integer $granularity Search's granularity
     * @return mixed                An [red, green, blue] associative array
     */
    public static function imageDominant($src, $granularity = 1) {
        $granularity = max(1, abs((int)$granularity));
        $channels = array(
            'red' => 0,
            'green' => 0,
            'blue' => 0
        );
        $size = @getimagesize($src);
        if($size === false) {
            user_error("Unable to get image size data: ".$src);
            return false;
        }
        $img = @imagecreatefromstring(@file_get_contents($src));

        if(!$img) {
            user_error("Unable to open image file: ".$src);
            return false;
        }
        for($x = 0; $x < $size[0]; $x += $granularity) {
            for($y = 0; $y < $size[1]; $y += $granularity) {
                $thisColor = imagecolorat($img, $x, $y);
                $rgb = imagecolorsforindex($img, $thisColor);
                $channels['red'] += $rgb['red'];
                $channels['green'] += $rgb['green'];
                $channels['blue'] += $rgb['blue'];
            }
        }
        $nbPixels = ceil($size[0] / $granularity) * ceil($size[1] / $granularity);
        $channels['red'] = round($channels['red'] / $nbPixels);
        $channels['green'] = round($channels['green'] / $nbPixels);
        $channels['blue'] = round($channels['blue'] / $nbPixels);
        return $channels;
    }

    /**
     * Return a visible color over another one (eg. #ffffee is not visible over #fff)
     * @param  mixed   $color     Background color
     * @param  boolean $greyscale Should output color be grey?
     * @return mixed              An [red, green, blue] associative array
     */
    public static function visibleOver($color, $greyscale = false) {
        $color = self::toRGBA($color);
        if($greyscale) {
            $median = 255 - ($color['red'] + $color['green'] + $color['blue']) / 3;
            return array(
                'red' => $median,
                'green' => $median,
                'blue' => $median
            );
        }
        return array(
            'red' => 255 - $color['red'],
            'green' => 255 - $color['green'],
            'blue' => 255 - $color['blue']
        );
    }

}