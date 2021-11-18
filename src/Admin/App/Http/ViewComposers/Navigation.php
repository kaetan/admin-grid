<?php

namespace App\Http\ViewComposers;

use App\Entity\Rbac\Resource;
use App\Helpers\Routes;
use App\Models\User;
use App\Services\Permission\PermissionManager;
use App\Models\Permission\Permission;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class Navigation
{
    public function __construct(private PermissionManager $permissionManager)
    {
    }

    /**
     * Боковое меню
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $items = [
            [
                'title' => 'Пользователи',
                'icon' => 'fa-user',
                'name' => 'users',
                'resource' => Resource::USERS,
            ],
        ];

        /** @var User $user */
        $user = Auth::user();

        foreach ($items as $key => $menuItem) {
            if (isset($menuItem['children'])) {
                foreach ($menuItem['children'] as $keyChild => $child) {
                    if (!$this->permissionManager->can($child['resource'], Permission::ACTION_READ, $user))
                        unset($items[$key]['children'][$keyChild]);
                }

                if (count($items[$key]['children']) === 0) unset($items[$key]);
                continue;
            }

            if (!$this->permissionManager->can($menuItem['resource'], Permission::ACTION_READ, $user))
                unset($items[$key]);
        }

        foreach ($items as &$item) {
            $this->addLinks($item);
        }

        foreach ($items as &$item) {
            $this->addActive($item);
        }
        $view->with('menuItems', $items);
    }


    private function addActive(&$item)
    {
        if (Routes::isCurrentRoute($item['name'], $item['params'] ?? [])) {
            $item['active'] = true;
        }
        $children = $item['children'] ?? [];

        if (!empty($children)) {
            $this->activateRouteGroup($item);
        }
        foreach ($children as &$child) {
            $this->addActive($child);
        }
        $item['children'] = $children;
    }

    private function activateRouteGroup(&$route)
    {
        $currentRouteName = Route::currentRouteName();

        foreach ($route['children'] ?? [] as $child) {
            if (Str::startsWith($currentRouteName, $child['name'])) {
                $route['active'] = true;
            }
        }
    }

    private function addLinks(&$item)
    {
        if (!$item['name']) {
            $item['href'] = 'javascript:;';
        } else {
            $params = !empty($item['params']) ? array_filter($item['params'], function($item) {
                return $item;
            }) : [];
            $item['href'] = route($item['name'], $params);
        }

        $children = $item['children'] ?? [];

        foreach ($children as &$child) {
            $this->addLinks($child);
        }

        $item['children'] = $children;
    }
}
