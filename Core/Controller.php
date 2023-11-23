<?php

namespace Core;

class Controller
{
    static $_render;
    protected function render($view, $scope = [])
    {
        extract($scope);
        $f = implode(DIRECTORY_SEPARATOR, [dirname(__DIR__), 'src', 'View', str_replace('Controller', '', basename(get_class($this))), $view]) . '.php';
        if (file_exists($f)) {
            ob_start();

            $file_content = file_get_contents($f);

            $file_content = preg_replace('/\{\{\s*(.+?)\s*\}\}/', '<?= htmlentities  ($1?:\'\') ?>', $file_content);
            $file_content = preg_replace('/@foreach\s*\((.+?)\)/', '<?php foreach ($1): ?>', $file_content);
            $file_content = str_replace('@endforeach', '<?php endforeach; ?>', $file_content);
            $file_content = preg_replace('/@if\s*\((.+)\)/', '<?php if ($1): ?>', $file_content);
            $file_content = preg_replace('/@elseif\s*\((.+)\)/', '<?php elseif ($1): ?>', $file_content);
            $file_content = str_replace('@else', '<?php else: ?>', $file_content);
            $file_content = str_replace('@endif', '<?php endif; ?>', $file_content);
            $file_content = preg_replace('/@isset\s*\((.+)\)/', '<?php if (isset($1): ?>', $file_content);
            $file_content = str_replace('@endifset', '<?php endif; ?>', $file_content);
            $file_content = preg_replace('/@empty\s*\((.+)\)/', '<?php if (empty($1): ?>', $file_content);
            $file_content = str_replace('@endempty', '<?php endif; ?>', $file_content);


            eval('?>' . $file_content);

            $view = ob_get_clean();
            ob_start();
            include(implode(DIRECTORY_SEPARATOR, [dirname(__DIR__), 'src', 'View', 'index']) . '.php');
            self::$_render = ob_get_clean();
        } else {
            echo "Le fichier $f n'existe pas.";
        }
    }
}
