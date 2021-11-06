<?php

/**
 * This file is part of Milk framework
 *
 * Author: ttitt <378797263@qq.com>
 * 
 * © Milk framework
 */

namespace Milk;

/**
 * Template Compile
 */
class Compile
{

    protected static $template;
    protected static $runtime;
    protected static $content;

    protected static $pattern = [];
    protected static $replacement = [];

    protected static $value = [];

    public static function initialization()
    {
        self::$content = file_get_contents(static::$template);

        // select
        //{$var}
        self::$pattern[] = "/\{\\$([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)\}/";
        //{$var['var']}
        self::$pattern[] = "/\{\\$(\w*[a-zA-Z0-9_]).*\[\'(\w*[a-zA-Z0-9])\'\]\}/";
        //{$var[var]}
        self::$pattern[] = "/\{\\$(\w*[a-zA-Z0-9_]).*\[(\w*[a-zA-Z0-9])\]\}/";
        //{foreach $b}或者{loop $b}
        self::$pattern[] = "/\{(loop|foreach) \\$([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)\}/i";
        //{[K|V]}
        self::$pattern[] = "/\{([K|V])\}/";
        //{/foreach}或者{\loop}或者{\if}
        self::$pattern[] = "/\{\/(loop|foreach|if)}/i";
        //{if (condition)}
        self::$pattern[] = "/\{if (.* ?)\}/i";
        //{(else if | elseif)}
        self::$pattern[] = "/\{(else if|elseif) (.* ?)\}/i";
        //{else}
        self::$pattern[] = "/\{else\}/i";
        //{#...# 或者 *...#，注释}
        self::$pattern[] = "/\{(\#|\*)(.* ?)(\#|\*)\}/";

        // replace
        self::$replacement[] = "<?php echo self::\$value['\\1']; ?>";
        self::$replacement[] = "<?php echo self::\$value['\\1']['\\2']; ?>";
        self::$replacement[] = "<?php echo self::\$value['\\1'][\\2]; ?>";
        self::$replacement[] = "<?php foreach ((array)self::\$value['\\2'] as \$K => \$V) { ?>";
        self::$replacement[] = "<?php echo \$\\1; ?>";
        self::$replacement[] = "<?php } ?>";
        self::$replacement[] = "<?php if (\\1) { ?>";
        self::$replacement[] = "<?php }else if (\\2) { ?>";
        self::$replacement[] = "<?php }else{ ?>";
        self::$replacement[] = "";
    }

    public static function build()
    {
        self::initialization();
        self::$content = preg_replace(self::$pattern, self::$replacement, self::$content);
        file_put_contents(self::$runtime, self::$content);
    }
}
