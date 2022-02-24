<?php

namespace App\Controllers;

class HelperFunctionsController
{
    public static function isCurrentPage(string $path, bool $checkSubFolder = true): bool
    {
        $components = explode('/', $_SERVER['REQUEST_URI']);
        if(!$checkSubFolder) {
            if($path === $components[2]) {
                return true;
            }
        }
        
        if($checkSubFolder) {
            $pathComponents = explode('/', $path);
            #Remove $component['last'] if its empty
            if ($components[count($components) - 1] === "") {
                unset($components[count($components) - 1]);
            }

            $uriCount = count($components);
            $pathCount = count($pathComponents);

            if ($components[2] === $pathComponents[0]) {
                #If last element of $pathComponent is empty then return true

                if ($uriCount - $pathCount !== 2) {
                    if ($pathComponents[$pathCount - 1] === "") {
                        return true;
                    } else {
                        return false;
                    }
                }
                if ($uriCount - $pathCount > 2) {
                   return false;
                }
                $checkArr = [];
                for ($i = 0; $i < $pathCount; $i++) {
                    if ($pathComponents[$i] !== $components[$i + 2]) {
                        $checkArr[] = $i;
                    }
                }
                if (empty($checkArr)) {
                    return true;
                }
            }
        }

        return false;
    }

    public static function addClassOnCurrentPage(string $path, $checkSubFolder = true, string $classToAdd = 'active'): string | null
    {
        if(self::isCurrentPage($path, $checkSubFolder)) {
            return $classToAdd;
        }

        return null;
    }

    public static function generateBreadcrumb(array $pages): array
    {
        $breadcrumbs = [
            [
                'title' => 'ড্যাশবোর্ড',
                'url' => APP_URL . '/dashboard',
                'isLast' => false
            ]
        ];
        
        foreach ($pages as $page) {
            $breadcrumbs[] = $page;
        }
        $count = count($breadcrumbs);
        $html = [];
        for ($i = 0; $i < $count; $i++) {
            if ($breadcrumbs[$i]['isLast']) {
                $html[] = "<li class='breadcrumb-item active'>{$breadcrumbs[$i]['title']}</li>";
            } else {
                $html[] = "<li class='breadcrumb-item'><a href='{$breadcrumbs[$i]['url']}'>{$breadcrumbs[$i]['title']}</a></li>";
            }
        }
        return $html;

    }
}
